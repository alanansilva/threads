<?php
 error_reporting(E_ALL);
 ini_set('display_errors', 1);


/**
 * Imagens
 */
$options = array(
    'post_data' => $_POST,
    'system' => 'sisturismo_novo',
    'path' => 'images/equipe/cliente_2/',
    'path_img_larger' => 'images/equipe/cliente_2/grandes/',
    'path_img_thumb' => 'images/equipe/cliente_2/thumbs/',
    'thumb_width' => 600,
    'thumb_heigth' => 400
);

/**
 * ARQUIVOS comuns
$options = array(
    'post_data' => $_POST,
    'system' => 'sisturismo_novo',
    'path' => 'documentos/equipe/cliente_2/',
    'path_img_larger' => null,
    'path_img_thumb' => null,
    'thumb_width' => null,
    'thumb_heigth' => null
);
 * 
 */

define('URL_POST_FILE_REMOTE', 'http://74.63.255.164/curl/');
$result = PostFileCURL::setPostFileCURL($_FILES['file'], $options);

echo '<pre>';
print_r($result);
echo '</pre>';


echo '<img src="' . URL_POST_FILE_REMOTE . $result->file[0]->img_thumb . '">';
echo '<br>';
echo $result->file[0]->img_larger;
echo '<br>';
echo $result->file[0]->img_thumb;
echo '<br>';
echo '<img src="' . URL_POST_FILE_REMOTE . $result->file[0]->img_larger . '">';
?>