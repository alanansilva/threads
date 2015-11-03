<?php
header('Content-type: application/json;  charset=iso-8859-1', true);
require_once '../../lib/php/conn.php';

require_once '../../models/Imagem.php';
$data = new Imagem();
require_once '../../models/Menu.php';
$menu = new Menu();


foreach ($_REQUEST as $key => $value)
    $_REQUEST[$key] = utf8_decode($value);


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
    if ($data->delete($_REQUEST['id']))
        echo json_encode(array('success' => 1));
    else
        echo json_encode(array('success' => 0));
}
