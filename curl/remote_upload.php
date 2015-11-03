<?php

header("Content-type: application/json;  charset=iso-8859-1", true);
error_reporting(E_ERROR);
ini_set('display_errors', 1);

require_once './UploadFileCURL.php';
require_once './SimpleImage.php';

//print_r($_FILES['file']);
//print_r(urldecode($_POST['data']));

$params = UploadFileCURL::getParamsPostUrl($_POST['data']);
$remote_file = $_FILES['file'];

if (!empty($params['path_img_thumb']) && !empty($params['path_img_larger'])) {
    $path_img_larger = $params['system'] . '/' . $params['path_img_larger'];
    UploadFileCURL::CreatePathPermission($path_img_larger);

    $path_img_thumb = $params['system'] . '/' . $params['path_img_thumb'];
    UploadFileCURL::CreatePathPermission($path_img_thumb);
} elseif (!empty($params['path'])) {
    $path = $params['system'] . '/' . $params['path'];
    UploadFileCURL::CreatePathPermission($path);
}

foreach ($remote_file['name'] as $key => $value) {
    $file = array(
        'name' => $value,
        'type' => $remote_file['type'][$key],
        'tmp_name' => $remote_file['tmp_name'][$key],
        'error' => $remote_file['error'][$key],
        'size' => $remote_file['size'][$key]
    );

    if ($remote_file['type'][$key] == 'image/jpeg' || $remote_file['type'][$key] == 'image/png') {
        UploadFileCURL::upload($path_img_larger, $file);

        $img_larger = $path_img_larger . UploadFileCURL::getNameFile();
        $img_thumb = $path_img_thumb . UploadFileCURL::getNameFile();

        $params['file'][] = array(
            'img_larger' => $img_larger,
            'img_thumb' => $img_thumb,
        );

        if (!empty($params['thumb_width']) && !empty($params['thumb_heigth'])) {
            $simpleImage = new SimpleImage();

            $simpleImage->load($img_larger);
            $simpleImage->resize($params['thumb_width'], $params['thumb_heigth']);
            $simpleImage->save($img_thumb);
        }
    } else {
        UploadFileCURL::upload($path, $file);

        $file_path = $path . UploadFileCURL::getNameFile();

        $params['file'][] = array(
            'file_path' => $file_path,
        );
    }
}

echo json_encode($params);
?>
