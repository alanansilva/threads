<?php
header("Content-type: application/json;  charset=iso-8859-1", true);
require_once '../../lib/php/conn.php';

require_once '../../models/Perfil.php';
require_once '../../models/Menu.php';
require_once '../../models/Pessoa.php';
require_once '../../lib/php/Carrinho.php';


$data = new Perfil();
$menu = new Menu();
$pessoa = new Pessoa();
$carrinho = new Carrinho('carrinhoPerfilItem');

foreach ($_REQUEST as $key => $value)
    $_REQUEST[$key] = utf8_decode($value);


if ($_REQUEST['acao'] == 1 && $_REQUEST['operacao'] == 2) {
    if ($data->add())
        echo json_encode(array('success' => 1));
    else
        echo json_encode(array('success' => 0));
}elseif ($_REQUEST['acao'] == 2 && $_REQUEST['operacao'] == 2) {
    if ($data->edit())
        echo json_encode(array('success' => 1));
    else
        echo json_encode(array('success' => 0));
}elseif ($_REQUEST['acao'] == 3 && $_REQUEST['operacao'] == 2) {
    if ($data->delete())
        echo json_encode(array('success' => 1));
    else
        echo json_encode(array('success' => 0));
}


