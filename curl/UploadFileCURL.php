<?php

class UploadFileCURL {

    private static $name_file;

    /**
     * 
     * @param type $post
     */
    public static function getParamsPostUrl($post) {
        $query = urldecode($post);
        $query_parts = explode('&', $query);

        $params = array();
        foreach ($query_parts as $param) {
            $item = explode('=', $param);
            $params[$item[0]] = $item[1];
        }
        return $params;
    }

    /**
     * Enter description here...
     *
     * @param String $destino
     * @param GLOBAL $file
     * @return $_FILES
     */
    public static function upload($destino, $file, $nome = null) {

        ini_set('post_max_size', '8M');
        ini_set('upload_max_filesize', '8M');

        $arquivoTmp = $file["tmp_name"];

        $file = $file["name"];

        $file = @ereg_replace("[����]", "A", $file);
        $file = @ereg_replace("[����]", "a", $file);
        $file = @ereg_replace("[���]", "E", $file);
        $file = @ereg_replace("[���]", "e", $file);
        $file = @ereg_replace("[���]", "I", $file);
        $file = @ereg_replace("[���]", "i", $file);
        $file = @ereg_replace("[����]", "O", $file);
        $file = @ereg_replace("[�����]", "o", $file);
        $file = @ereg_replace("[���]", "U", $file);
        $file = @ereg_replace("[���]", "u", $file);
        $file = @str_replace("�", "C", $file);
        $file = @str_replace("�", "c", $file);
        $file = @str_replace("-", "", $file);
        $file = @str_replace("'", "", $file);
        $file = @str_replace('"', '', $file);
        $file = @str_replace('_', '', $file);

        if (!empty($nome)) {
            $nomeArquivo = $nome;
            $arquivo = $destino . $nome;
        } else {
            $nomeArquivo = date('Ymd') . time() . str_replace(" ", "", $file);
            $arquivo = $destino . date('Ymd') . time() . str_replace(" ", "", $file);
        }

        if (!move_uploaded_file($arquivoTmp, $arquivo)) {
            $retorno = false;
        } else {
            $retorno = true;
        }

        self::$name_file = $nomeArquivo;

        return $retorno;
    }

    /**
     * 
     * @return type
     */
    public static function getNameFile() {
        return self::$name_file;
    }

    /**
     * 
     * @param type $url
     * @param type $mode
     * @param type $recursive
     */
    public static function CreatePathPermission($url) {
        
        if (!is_dir($url)) {
            mkdir($url, 0777, true);
        }
        chmod($url, 0777);
    }

}

?>