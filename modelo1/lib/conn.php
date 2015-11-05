<?php
session_start();

require_once 'ConexaoPDO.php';

require_once 'Collection.php';

require_once 'DBSql.php';
require_once 'DataHora.php';
require_once 'String.php';
require_once 'UtilCombo.php';
require_once 'Paginacao.php';
require_once 'PaginacaoLink.php';

$_REQUEST = UtilString::clear_data($_REQUEST);

//ConexaoPDO::setParameters('mysql:host=mysql.hostinger.com;dbname=u792106740_thr', 'u792106740_thr', 'Q=PN&+fP3K');
ConexaoPDO::setParameters('mysql:host=localhost;dbname=3heads', 'root', 'root');

$GLOBALS['objDb'] = ConexaoPDO::getInstance();

define('PESSOA_ID', $_SESSION['dados']['pessoa']['id']);
?>