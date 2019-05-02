<?php
    $arquivo = 'ver2.txt';
    $fp = fopen($arquivo, 'a+');
    $texto = 'cwmenug /r:PHPCAD01 D' . $_GET['id'] . ' /d:c:\uso\arq /c:c:\cobolware\cil';
    fwrite($fp, $texto);
    fclose($fp);
    exec('cwmenug /r:PHPCAD01 ' . $_GET['iouser'] . $_GET['id'] . ' /d:c:\uso\arq /c:c:\cobolware\cil');
    header('Location: ler.php');
?>