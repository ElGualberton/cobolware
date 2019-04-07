       IDENTIFICATION DIVISION.
       PROGRAM-ID.    PHPCAD02.
       AUTHOR.        ElGualberton.
       DATE-WRITTEN.  06/04/2019.
       SECURITY.      *************************************************
                      *                                               *
                      *  Gerador do Json com todos os dados           *
                      *                                               *
                      *************************************************
       ENVIRONMENT DIVISION.
       CONFIGURATION SECTION.
      *SPECIAL-NAMES. DECIMAL-POINT IS COMMA.
       INPUT-OUTPUT SECTION.
       FILE-CONTROL.

           SELECT json ASSIGN TO "\xampp\htdocs\cobolware\FileName.json"
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
           05 fs-json                     pic  x(002) value spaces.
           05 lb-json                     pic  x(040) value
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

       PROCEDURE DIVISION.
       000-INICIO.

           perform 090-INICIO-JSON thru 090-99-FIM
           OPEN INPUT FileName
           MOVE 0 TO REGISTROS
           PERFORM TEST AFTER UNTIL FS-FileName > "09"
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
           PERFORM 110-FINALIZA-JSON thru 110-99-FIM.

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
                 '"CODIGO":   ' '"' FileName-CODIGO    '",'
                 '"DESCRICAO":' '"' FileName-DESCRICAO '",'
                 '"PRECO":    ' '"' MASC-VALOR         '",'
                 '"TIPO":     ' '"' FileName-TIPO      '",'
                 '"OPCOES":   ' '"' FileName-OPCOES    '"}'
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

       900-FILE-STATUS.
           OPEN OUTPUT json.
           INITIALIZE linha-json.
           String "FileStatus "
                   FS-FileName
                   delimited by size INTO linha-json.
           WRITE linha-json.
           close json.
           close FileName.
       900-99-FIM.
           goback.

       END PROGRAM PHPCAD02.
