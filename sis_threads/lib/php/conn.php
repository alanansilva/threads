<?php
session_start();
define('PATH', $_SERVER['REQUEST_URI']);

if (strpos(PATH, 'sistema.php')) {
	$path = 'lib/php/';
}else {
	$path = '';
}

require_once $path . 'ConexaoPDO.php';
require_once $path . 'Collection.php';
require_once $path . 'DBSql.php';
require_once $path . 'DataHora.php';
require_once $path . 'String.php';
require_once $path . 'UtilCombo.php';
require_once $path . 'Paginacao.php';
require_once $path . 'PaginacaoLink.php';
require_once $path . 'PostFileCURL.php';

$_REQUEST = UtilString::clear_data($_REQUEST);

ConexaoPDO::setParameters('mysql:host=localhost;dbname=3heads', 'root', 'root');
$GLOBALS['objDb'] = ConexaoPDO::getInstance();

define('PESSOA_ID', $_SESSION['dados']['pessoa']['id']);
?>
