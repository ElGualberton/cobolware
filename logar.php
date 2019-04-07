<?php
    require_once 'config.php';
    header('location:inicio.php');
    /*
    echo 'logar.1<br>';
    session_start();
    $usuario_email = addslashes(utf8_encode($_POST['usuario_email'])) ?? null;
    $usuario_senha  = addslashes(utf8_encode($_POST['usuario_senha'])) ?? null;
    if ($usuario_email && $usuario_senha){
        $db = open_database();
        $sqlConsultaUsuario = "SELECT * FROM TB_USUARIO WHERE USR_EMAIL =  trim('$usuario_email') and USR_SENHA = trim('$usuario_senha')";
		//$myfile = fopen("logar.txt","w") or die("Sem chance parceiro!");
		//fwrite($myfile,$sqlConsultaUsuario);
		//fclose($myfile);
        //    echo $sqlConsultaUsuario;
        $resultadoConsultaUsuario = $db->query($sqlConsultaUsuario);
        echo $sqlConsultaUsuario;
        echo 'logar.2<br>';
        echo $resultadoConsultaUsuario->num_rows;
        echo 'logar.3<br>';
        if($resultadoConsultaUsuario->num_rows == 1){
            $retornoUsuario = $resultadoConsultaUsuario->fetch_assoc();
            echo $retornoUsuario['email'];
            if(trim($retornoUsuario['email']) == trim($usuario_email)){
               $_SESSION['USR_NIVEL'] = $retornoUsuario['USR_NIVEL'];
               $_SESSION['USR_EMAIL'] = $retornoUsuario['USR_EMAIL'];
               $_SESSION['USR_SENHA'] = $retornoUsuario['USR_SENHA'];
               $_SESSION['USR_CLASSIFICACAO'] = $retornoUsuario['USR_CLASSIFICACAO'];
               header('location:inicio.php');
            }           
        } else {
            //$_SESSION['message'] = 'E-mail não encontrado, entre em contato x1 ' + $usuario_email;
            echo"<script language='javascript' type='text/javascript'>
                    alert('E-mail não encontrado ou senha incorreta, por favor, entre em contato.');
                    window.location.href='index.php';
                </script>";
            //clearstatcache();
            //$usuario_email = null;
            //$usuario_senha = null;
            //$_POST['usuario_email'] = null;
            //$_POST['usuario_senha'] = null;
            die();
            //header('location:index.php');
        }
    } else {
        echo"<script language='javascript' type='text/javascript'>
        alert('E-mail ou senha inválidos, por favor, tente novamente. :) ');
        window.location.href='login.php';
        </script>";
    }
    */
?>