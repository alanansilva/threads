<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../../models/Imagem.php';
$data = new Imagem();
require_once '../../models/Menu.php';
$menu = new Menu();

require_once '../../lib/php/upload.php';

require_once '../../lib/php/UploadFiles.php';

//Parametros da imagem

$menu_nome = $_REQUEST['menu_nome'];
$menu_id   = $_REQUEST['menu_id'];
$relacionamento_id   = $_REQUEST['relacionamento_id'];
$relacionamento_nome = $_REQUEST['relacionamento_nome'];
$width_img    = $_REQUEST['width_img'];
$height_img   = $_REQUEST['height_img'];
$width_thumb  = $_REQUEST['width_thumb'];
$height_thumb = $_REQUEST['height_thumb'];
$caminho  = $_REQUEST['caminho'];
$caminho2 = $_REQUEST['caminho2'];

if (empty($menu_id))
    define('MENU_ID', $menu_id);

$paramImg = "menu_id=" . $menu_id . "&menu_nome=" . $menu_nome . "&relacionamento_id=" . $relacionamento_id;
$paramImg.= "&relacionamento_nome=" . $relacionamento_nome . "&width_img=" . $width_img . "&height_img=" . $height_img;
$paramImg.="&width_thumb=" . $width_thumb . "&height_thumb=" . $height_thumb . "&caminho=" . $caminho . "&caminho2=" . $caminho2;

$link = 'app.php?app=' . $app;
?>