<?php

/** Nome do Cliente **/
define('cli_nome','Bombom');

/** o nome do banco de dados **/
//define('DB_NAME', 'salvum');
define('DB_NAME', 'escola');

/** Usuario do banco de dados **/
define('DB_USER','sistema');
//define('DB_USER','root');

/** Senha do banco de dados **/
define('DB_PASSWORD','arcoiris');
//define('DB_PASSWORD','');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** caminho absoluto para a pasta do sistema **/
if ( !defined('ABSPATH') )
	//define('ABSPATH', dirname(__FILE__) . '/');
	define('ABSPATH', dirname(__FILE__));
	
/** caminho no server para o sistema **/
if ( !defined('BASEURL') )
//	define('BASEURL', 'http://35.238.214.110/');
  	define('BASEURL', 'localhost/cobolware/');

/** caminho do arquivo de banco de dados **/
if ( !defined('DBAPI') )
	define('DBAPI', ABSPATH . '\inc\database.php');

/** caminhos dos templates de header e footer **/
define('HEADER_TEMPLATE', ABSPATH . '\view\cabeca.php');
define('FOOTER_TEMPLATE', ABSPATH . '\view\rodape.php');
//define('USUARIO_INVALIDO', BASEURL . 'errologin.php');

global $sistema;
$sistema = 'inicio';

global $celwhats;
$celwhats = '5511999999999';

global $email_user;
$email_user = 'usuario@email';

global $empresa;
$empresa = 'Colégio Salvum';

/** Funcoes Comuns do Sistema **/
define('FUNCOES', ABSPATH . 'inc/funcoes.php');
?>
