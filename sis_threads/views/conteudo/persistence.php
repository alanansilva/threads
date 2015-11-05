<?php
header('Content-type: application/json;  charset=iso-8859-1', true);
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require_once '../../lib/php/conn.php';

require_once '../../models/Conteudo.php';
$data = new Conteudo();

require_once '../../models/ConteudoCategoria.php';
$conteudoCategoria = new ConteudoCategoria();

require_once '../../models/Imagem.php';
$imagem = new Imagem();

require_once '../../models/IconeBootstrap.php';
$iconeBootstrap = new IconeBootstrap();

require_once '../../lib/php/UploadFiles.php';

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
