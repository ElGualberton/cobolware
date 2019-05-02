<?php
    $descricao = str_replace('"', '', $_GET['descricao']);
    $descricao = str_replace(' ', '§', $descricao);
    $arquivo = 'ver.txt';
    $fp = fopen($arquivo, 'a+');
    $texto = 'cwmenug /r:PHPCAD01 ' . $_GET['iouser'] . $_GET['id'] . '¢' . $descricao . '¢' . $_GET['valor'] . '¢' . $_GET['tipo'] . '¢' . $_GET['importado'] . '¢' . $_GET['garantia'] . '¢' . $_GET['duravel'] . ' /d:c:\uso\arq /c:c:\cobolware\cil';
    fwrite($fp, $texto);
    exec('cwmenug /r:PHPCAD01 ' . $_GET['iouser'] . $_GET['id'] . '¢' . $descricao . '¢' . $_GET['valor'] . '¢' . $_GET['tipo'] . '¢' . $_GET['importado'] . '¢' . $_GET['garantia'] . '¢' . $_GET['duravel'] . ' /d:c:\uso\arq /c:c:\cobolware\cil');
    if($_GET['id'] != 00000){
        header('Location: manutencao.php?id=' . $_GET['id'] . '&tipo=A');
    } else {
        if(!getenv('codreg') && getenv('codreg')!=00000){
            header('Location: manutencao.php?id=' . getenv('codreg') . '&tipo=A');
        }  else {
            header('Location: inicio.php');
        }
    }

    $url = 'FileName.json';
    $content = file_get_contents($url);
    $json = json_decode($content, true);
    fwrite($fp, var_dump($json));
    foreach($json['data']['FileName'] as $item) {
        fwrite($fp, $item['CODIGO']);
        //print ;
        //print $item['weatherDesc'][0]['value'];
        //print ' - ';
        //print '<br>';
    }
    fclose($fp);

?>