       IDENTIFICATION DIVISION.
       PROGRAM-ID.    PHPCAD01.
       AUTHOR.        ElGualberton.
       DATE-WRITTEN.  06/04/2019.
       SECURITY.      *************************************************
                      *                                               *
                      *  Manutencao dos dados do indexado             *
                      *                                               *
                      *************************************************
       ENVIRONMENT DIVISION.
       CONFIGURATION SECTION.
      *SPECIAL-NAMES. DECIMAL-POINT IS COMMA.
       INPUT-OUTPUT SECTION.
       FILE-CONTROL.

           SELECT json ASSIGN   TO lb-json
                  ORGANIZATION  IS LINE SEQUENTIAL
                  ACCESS MODE   IS SEQUENTIAL
                  FILE STATUS   IS fs-json.

           SELECT FileName ASSIGN TO DISK
                  ORGANIZATION  IS INDEXED
                  ACCESS MODE   IS DYNAMIC
                  RECORD  KEY   IS FileName-CHAVE
                  ALTERNATE RECORD KEY IS FileName-DESCRICAO
                                          WITH DUPLICATES
                  LOCK MODE     IS AUTOMATIC
                  FILE STATUS   IS FS-FileName.

       DATA DIVISION.
       FILE SECTION.

       FD  json.
       01  linha-json                     pic x(1000).

       FD  FileName
           LABEL RECORD IS STANDARD
           VALUE OF FILE-ID IS LB-FileName.

       01  FileName-REG.
           05 FileName-CHAVE.
              10 FileName-CODIGO          PIC  9(005).
           05 FileName-DESCRICAO          PIC  X(030).
           05 FileName-PRECO              PIC  9(008)V99.
           05 redefines FileName-PRECO.
              10 FileName-PRECO-CHEIO     PIC  9(008).
              10 FileName-PRECO-CENTAVOS  PIC  9(002).
           05 FileName-TIPO               PIC  9(001).
              88 FileName-PECA                         VALUE 1.
              88 FileName-ACABADO                      VALUE 2.
              88 FileName-MATERIAL                     VALUE 3.
           05 FileName-OPCOES.
              10 FileName-IMPORTADO       PIC  9(001).
              10 FileName-GARANTIA        PIC  9(001).
              10 FileName-DURAVEL         PIC  9(001).

       WORKING-STORAGE SECTION.

       01  WS-REG.
           05 WS-CHAVE.
              10 WS-CODIGO          PIC  X(005).
           05 WS-DESCRICAO          PIC  X(030).
           05 WS-PRECO              PIC  x(011).
           05 REDEFINES WS-PRECO.
              10 WS-PRECO-CHEIO     PIC  9(008).
              10 WS-PRECO-SEPARADOR PIC  X(001).
              10 WS-PRECO-CENTAVOS  PIC  9(002).
           05 WS-TIPO               PIC  X(001).
              88 WS-PECA                 VALUE "1".
              88 WS-ACABADO              VALUE "2".
              88 WS-MATERIAL             VALUE "3".
           05 WS-OPCOES.
              10 WS-IMPORTADO       PIC  X(001).
              10 WS-GARANTIA        PIC  X(001).
              10 WS-DURAVEL         PIC  X(001).

       01  AREAS-DE-TRABALHO-1.
           05 NM-CODIGO                   PIC  9(005) VALUE ZEROS.
           05 fs-json                     pic  x(002) value spaces.
           05 lb-json                     pic  x(050) value
              "\xampp\htdocs\cobolware\FileName.json".
           05 marcador                    pic  x(002) value spaces.
           05 WS-RETORNO-TELA             PIC  X(078).
           05 MASC-VALOR                  PIC  ZZZZZZZ9.99
            BLANK WHEN ZEROS.
           05 MASC-VALOR2                 PIC  99999999.99
            BLANK WHEN ZEROS.
           05 REGISTRO-VALOR              PIC  X(100) VALUE SPACES.
           05 REGISTROS                   PIC  9(006) VALUE 0.
           05 FS-FileName                 PIC  X(002) VALUE "00".
           05 LB-FileName                 PIC  X(050) VALUE "FileName".
           05 sys-sets.
              10 filler                   pic  x(011) value
                                                     "set codreg=".
              10 sys-codreg               pic  9(005) value zeros.
           05 return-code-ws              pic s9(8) comp-5.
           05 filler                      redefines return-code-ws.
               10 filler                  pic xx.
               10 high-order-byte         pic s9 comp-5.
               10 low-order-byte          pic s9 comp-5.


       LINKAGE SECTION.

       01  LINKAGEM-CAMPOS.
           05  USER-IO                    PIC  X(001).
               88 OPEN-FILE                    VALUE "O" "o".
               88 CLOSE-FILE                   VALUE "C" "c".
               88 BEGIN-FILE                   VALUE "B" "b".
               88 END-FILE                     VALUE "E" "e".
               88 AT-END                       VALUE "*".
               88 READ-NEXT                    VALUE "N" "n".
               88 READ-PREVIOUS                VALUE "P" "p".
               88 NOT-LESS                     VALUE ">".
               88 NOT-GREATER                  VALUE "<".
               88 EDIT-KEY                     VALUE "$".
               88 READ-REG                     VALUE "A" "a".
               88 WRITE-REG                    VALUE "W" "w".
               88 REWRITE-REG                  VALUE "R" "r".
               88 DELETE-REG                   VALUE "D" "d".
           05  AREA-LINK                  PIC  X(100).
       01  ORDER-MODE                     PIC  9(001).
           88 ORDER-BY-LEFT                    VALUE 1.
           88 ORDER-BY-RIGHT                   VALUE 2.
       01  LEFT-ITEM.
           05 LIST-CODIGO                 PIC  9(005).
           05 FILLER                      PIC  X(075).
       01  RIGHT-ITEM.
           05 LIST-DESCRICAO              PIC  X(030).
           05 FILLER                      PIC  X(050).
       01  HEIGHT                         PIC  9(002).
       01  BOXFILESELECT-EDIT             PIC  9(003). COPY CWEDIT.
       01  BOXFILESELECT-OPTION           PIC  X(076).

      *PROCEDURE DIVISION USING USER-IO
      *                         AREA-LINK
      *                         ORDER-MODE
      *                         LEFT-ITEM
      *                         RIGHT-ITEM
      *                         HEIGHT
      *                         BOXFILESELECT-EDIT
      *                         BOXFILESELECT-OPTION.
      *
       PROCEDURE DIVISION USING LINKAGEM-CAMPOS.
       000-INICIO.

           EVALUATE TRUE
                WHEN READ-REG
                     if area-link(1:5) = 00000
                        perform 400-listar-zero     thru 400-99-fim
                     else
                        PERFORM 300-TRATA-AREA-LINK THRU 300-99-FIM
                     end-if
                WHEN WRITE-REG
                    PERFORM 300-TRATA-AREA-LINK THRU 300-99-FIM
                WHEN REWRITE-REG
                    PERFORM 300-TRATA-AREA-LINK THRU 300-99-FIM
                WHEN DELETE-REG
                    PERFORM 300-TRATA-AREA-LINK THRU 300-99-FIM
               WHEN EDIT-KEY
                    CONTINUE *> Tecla de funÃ§Ã£o em BOXFILESELECT-EDIT
                             *> Item posicionado em BOXFILESELECT-OPTION
               WHEN OPEN-FILE
                    perform 090-INICIO-JSON thru 090-99-FIM
                    OPEN INPUT FileName
                    MOVE 0 TO REGISTROS
                    PERFORM TEST AFTER UNTIL FS-FileName > "09"
                                          OR REGISTROS = HEIGHT
                            READ FileName NEXT RECORD
                                          IGNORE LOCK
                            IF   FS-FileName < "10"
                                 ADD 1 TO REGISTROS
                                 PERFORM 100-DEVOLVE-REGISTRO THRU
                                         100-99-FIM
                            END-IF
                    END-PERFORM
                    IF   REGISTROS = 0
                         MOVE 1 TO REGISTROS
                    END-IF
                    IF   REGISTROS < HEIGHT
                         MOVE REGISTROS TO HEIGHT
                    END-IF
                    PERFORM 110-FINALIZA-JSON thru 110-99-FIM
               WHEN CLOSE-FILE
                    CLOSE FileName
               WHEN BEGIN-FILE
                    INITIALIZE FileName-REG
                    EVALUATE TRUE
                        WHEN ORDER-BY-RIGHT
                             START FileName KEY NOT < FileName-DESCRICAO
                        WHEN OTHER
                             START FileName KEY NOT < FileName-CHAVE
                    END-EVALUATE
               WHEN END-FILE
                    MOVE HIGH-VALUE TO FileName-REG
                    EVALUATE TRUE
                        WHEN ORDER-BY-RIGHT
                             START FileName KEY NOT > FileName-DESCRICAO
                        WHEN OTHER
                             START FileName KEY NOT > FileName-CHAVE
                    END-EVALUATE
               WHEN READ-NEXT
                    OPEN INPUT FileName
                    initialize FileName-reg
                    if AREA-LINK(1:5) is numeric
                       move AREA-LINK(1:5) to FileName-CODIGO
                       add  1              to FileName-CODIGO
                       start FileName key is not less FileName-CHAVE
                    end-if
                    READ FileName NEXT RECORD
                                  IGNORE LOCK
                    IF   FS-FileName > "09"
                         SET AT-END TO TRUE
                    ELSE
                         perform 090-INICIO-JSON thru 090-99-FIM
                         MOVE 1 TO REGISTROS
                         PERFORM 100-DEVOLVE-REGISTRO THRU 100-99-FIM
                         PERFORM 110-FINALIZA-JSON thru 110-99-FIM
                    END-IF
                    CLOSE FileName
               WHEN READ-PREVIOUS
                    OPEN INPUT FileName
                    initialize FileName-reg
                    if AREA-LINK(1:5) is numeric
                       move AREA-LINK(1:5) to FileName-CODIGO
      *                subtract 1        from FileName-CODIGO
                       start FileName key is less FileName-CHAVE
                    end-if
                    READ FileName PREVIOUS RECORD
                                  IGNORE LOCK
                    IF   FS-FileName > "09"
                         SET AT-END TO TRUE
                    ELSE
                         perform 090-INICIO-JSON thru 090-99-FIM
                         MOVE 1 TO REGISTROS
                         PERFORM 100-DEVOLVE-REGISTRO THRU 100-99-FIM
                         PERFORM 110-FINALIZA-JSON thru 110-99-FIM
                    END-IF
                    CLOSE FileName
               WHEN NOT-LESS
                    EVALUATE TRUE
                        WHEN ORDER-BY-RIGHT
                             MOVE LIST-DESCRICAO TO FileName-DESCRICAO
                             START FileName KEY NOT < FileName-DESCRICAO
                                   INVALID KEY
                                           SET AT-END TO TRUE
                             END-START
                        WHEN OTHER
                             MOVE LIST-CODIGO TO FileName-CODIGO
                             START FileName KEY NOT < FileName-CHAVE
                                   INVALID KEY
                                           SET AT-END TO TRUE
                             END-START
                    END-EVALUATE
               WHEN NOT-GREATER
                    EVALUATE TRUE
                        WHEN ORDER-BY-RIGHT
                             MOVE LIST-DESCRICAO TO FileName-DESCRICAO
                             START FileName KEY NOT > FileName-DESCRICAO
                                   INVALID KEY
                                           SET AT-END TO TRUE
                             END-START
                        WHEN OTHER
                             MOVE LIST-CODIGO TO FileName-CODIGO
                             START FileName KEY NOT > FileName-CHAVE
                                   INVALID KEY
                                           SET AT-END TO TRUE
                              END-START
                    END-EVALUATE
           END-EVALUATE.
       000-99-FIM.
           STOP RUN.

       090-INICIO-JSON.
           INITIALIZE linha-json.
           move '{ "FileName": [' to linha-json
           EXEC COBOLware UTF8 FILE lb-json
                UTF-8
                RECORD linha-json
           END-EXEC.
       090-99-FIM. EXIT.

       100-DEVOLVE-REGISTRO.
           initialize linha-json.
           if REGISTROS > 1
              move ',{' to marcador
           else
              move '{'  to marcador
           end-if.

           INSPECT FileName-REG REPLACING ALL "'" BY "!".

           MOVE FileName-PRECO TO MASC-VALOR
           STRING marcador
                 '"CODIGO":'    '"' FileName-CODIGO    '",'
                 '"DESCRICAO":' '"' FileName-DESCRICAO '",'
                 '"PRECO":'     '"' MASC-VALOR         '",'
                 '"TIPO":'      '"' FileName-TIPO      '",'
                 '"IMPORTADO":' '"' FileName-IMPORTADO '",'
                 '"GARANTIA":'  '"' FileName-GARANTIA  '",'
                 '"DURAVEL":'   '"' FileName-DURAVEL   '"}'
           DELIMITED BY SIZE INTO linha-json.
           EXEC COBOLware UTF8 FILE lb-json
                UTF-8
                RECORD linha-json
           END-EXEC.
       100-99-FIM. EXIT.

       110-FINALIZA-JSON.
           INITIALIZE linha-json.
           MOVE ']}' to linha-json.
           EXEC COBOLware UTF8 FILE lb-json
                UTF-8
                RECORD linha-json
           END-EXEC
           MOVE 'FileName.json' TO WS-RETORNO-TELA.
           EXEC COBOLware UTF8 FILE lb-json
                CLOSE
           END-EXEC.
       110-99-FIM. EXIT.

       300-TRATA-AREA-LINK.
           if READ-REG
              close FileName open input FileName
           else
              close FileName open i-o FileName
           end-if
           if FS-FileName > "09"
              PERFORM 900-FILE-STATUS THRU 900-99-FIM
           end-if.
           unstring AREA-LINK DELIMITED BY "¢" INTO
                                       WS-CODIGO
                                       WS-DESCRICAO
                                       WS-PRECO
                                       WS-TIPO
                                       WS-IMPORTADO
                                       WS-GARANTIA
                                       WS-DURAVEL.
           inspect ws-descricao replacing all "§" by " ".
           IF WS-CODIGO IS NUMERIC
              INITIALIZE FileName-REG

              EVALUATE TRUE
                 WHEN READ-REG
                      MOVE WS-CODIGO TO FileName-CODIGO
                      PERFORM TEST AFTER UNTIL FS-FileName NOT = "9D"
                         READ FileName ignore lock
                      END-perform
                 WHEN WRITE-REG
                      initialize FileName-reg
                      move 99999 to FileName-CODIGO
                      start FileName key is less FileName-CHAVE
                      READ FileName PREVIOUS RECORD IGNORE LOCK
                      IF FS-FileName < "10"
                         move FileName-CODIGO TO NM-CODIGO
                         ADD  1               TO NM-CODIGO
                         MOVE NM-CODIGO       TO WS-CODIGO
                         perform 310-TRATAR-AREA-LINK thru 310-99-fim
                         write FileName-REG
                         initialize sys-codreg
                         move FileName-CODIGO to sys-codreg
                         display "XCODCLI" UPON ENVIRONMENT-NAME
                         display WS-CODIGO UPON ENVIRONMENT-VALUE
                         CALL "SYSTEM" USING     sys-sets
                                       returning return-code-ws
                      end-if
                 WHEN REWRITE-REG
                      MOVE WS-CODIGO TO FileName-CODIGO
                      PERFORM TEST AFTER UNTIL FS-FileName NOT = "9D"
                         READ FileName ignore lock
                      END-perform
                      perform 310-TRATAR-AREA-LINK thru 310-99-fim
                      rewrite FileName-REG
                 WHEN DELETE-REG
                      MOVE WS-CODIGO TO FileName-CODIGO
                      PERFORM TEST AFTER UNTIL FS-FileName NOT = "9D"
                         READ FileName ignore lock
                      END-perform
                      IF FS-FileName < "10"
                         DELETE FileName Record
                      END-IF
              END-EVALUATE
              if FS-FileName > "09"
                 PERFORM 900-FILE-STATUS THRU 900-99-FIM
              else
                 if not DELETE-REG
                    perform 090-INICIO-JSON      thru 090-99-FIM
                    PERFORM 100-DEVOLVE-REGISTRO THRU 100-99-FIM
                    PERFORM 110-FINALIZA-JSON    thru 110-99-FIM
                 END-IF
              end-if
           END-IF.
           close FileName.
       300-99-FIM. EXIT.

       310-TRATAR-AREA-LINK.
           move WS-CODIGO           to FileName-CODIGO
           move WS-DESCRICAO        to FileName-DESCRICAO
           move WS-PRECO-CHEIO      to FileName-PRECO-CHEIO
           move WS-PRECO-CENTAVOS   to FileName-PRECO-CENTAVOS
           move WS-TIPO             to FileName-TIPO
           move WS-IMPORTADO        to FileName-IMPORTADO
           move WS-GARANTIA         to FileName-GARANTIA
           move WS-DURAVEL          to FileName-DURAVEL.
       310-99-FIM. EXIT.

       400-listar-zero.
           initialize FileName-reg
           perform 090-INICIO-JSON      thru 090-99-FIM
           PERFORM 100-DEVOLVE-REGISTRO THRU 100-99-FIM
           PERFORM 110-FINALIZA-JSON    thru 110-99-FIM.
       400-99-FIM. EXIT.

       900-FILE-STATUS.
           initialize FileName-reg
           if FS-FileName = "23"
              move "Registro não encontrado." to FileName-DESCRICAO
           else
              String "FileStatus "
                      FS-FileName
                      delimited by size INTO FileName-DESCRICAO
           end-if.
           perform 090-INICIO-JSON      thru 090-99-FIM
           PERFORM 100-DEVOLVE-REGISTRO THRU 100-99-FIM
           PERFORM 110-FINALIZA-JSON    thru 110-99-FIM
           close FileName.
           go 000-99-FIM.
       900-99-FIM. EXIT.

       END PROGRAM PHPCAD01.
