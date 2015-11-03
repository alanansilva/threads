<?php
header('Content-type: application/json;  charset=iso-8859-1', true);
require_once '../../lib/php/conn.php';

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require_once '../../models/Banner.php';
$data = new Banner();

require_once '../../models/BannerCategoria.php';
$bannerCategoria = new BannerCategoria();

require_once '../../models/Imagem.php';
$imagem = new Imagem();

foreach ($_REQUEST as $key => $value){
     if (!is_array($value)) {
        $_REQUEST[$key] = utf8_decode($value);
    } elseif (is_array($value)) {
        foreach ($value as $key2 => $value2) {
            $_REQUEST[$key][$key2] = utf8_decode($value2);
        }
    }
}

if ($_REQUEST['acao'] == 1 && $_REQUEST['operacao'] == 2) {
    if ($data->add())
        echo json_encode(array('success' => 1));
    else
        echo json_encode(array('success' => 0));
} elseif ($_REQUEST['acao'] == 2 && $_REQUEST['operacao'] == 2) {
    if ($data->edit())
        echo json_encode(array('success' => 1));
    else
        echo json_encode(array('success' => 0));
} elseif ($_REQUEST['acao'] == 3 && $_REQUEST['operacao'] == 2) {
    if ($data->delete())
        echo json_encode(array('success' => 1));
    else
        echo json_encode(array('success' => 0));
}
