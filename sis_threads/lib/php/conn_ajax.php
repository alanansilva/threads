<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
define('PESSOA_ID', $_SESSION['dados']['pessoa']['id']);
define('PATH', $_SERVER['REQUEST_URI']);

if (strpos(PATH, 'sistema.php') || strpos(PATH, 'sistema.jsp')) {
	$path = '';
}else {
	$path = '../../';
}

require_once($path . "FrameWork/FrameWork.php");
require_once($path . "config/defaultInc.php");

$_REQUEST = UtilString::clear_data($_REQUEST);


$GLOBALS["conn"]->_Conectar();
$GLOBALS['objDb'] = $GLOBALS["conn"]->ObjDb;

require_once '../../lib/php/UploadFiles.php';
require_once '../../models/imagem.php';
require_once '../../models/AuditoriaLogQuery.php';
require_once 'PostFileCURL.php';
?>
