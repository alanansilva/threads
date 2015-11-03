<?php

class Util {

    /**
     * Funчуp que gera numeros sequencias
     *
     * @param String $cnt
     * @param string $faixa
     * @return sequencia
     */
    public function numSequencial($cnt = 0, $faixa) {
        if ($cnt == 0) {
            $cnt = 1;
        } else {
            $cnt = $cnt + 1;
        }

        if (strlen($cnt) <= strlen($faixa)) {
            $sub = strlen($faixa) - strlen($cnt);

            for ($i = 0; $i < $sub; $i++) {
                $faixa2 = $faixa2 . "0";
            }
        }

        return $faixa2 . $cnt;
    }

    /**
     * 
     * Enter tipo do arquivo
     * @param String $ext
     */
    public function getImagemFile($ext) {

        if ($ext == "docx" || $ext == "doc") {
            $nome = "doc";
        } elseif ($ext == "xlsx" || $ext == "xls") {
            $nome = "xls";
        } elseif ($ext == "3gp" || $ext == "mp4" || $ext == "wmv" || $ext == "avi") {
            $nome = "video";
        } elseif ($ext == "tar" || $ext == "rar" || $ext == "zip") {
            $nome = "zip";
        } elseif ($ext == "html" || $ext == "htm" || $ext == "php" || $ext == "asp") {
            $nome = "html";
        } else {
            $nome = "default";
        }

        $img = '../../images/files/' . $nome . '.png';

        $txt = '<img src="' . $img . '" title="' . $obj['tipo'] . '" height="16px" width="16px" />&nbsp';

        return $txt;
    }

    /**
     * 
     * @param type $url
     * @param type $params
     * @return type
     * 
     * $params = array(
     * "name" => "Ravishanker Kusuma",
     * "age" => "32",
     * "location" => "India"
     * );
     *
     * echo httpPost("http://hayageek.com/examples/php/curl-examples/post.php",$params);
     *   http://hayageek.com/php-curl-post-get/
     */
    public function httpPost($url, $params) {
        $postData = '';
        //create name value pairs seperated by &
        foreach ($params as $k => $v) {
            $postData .= $k . '=' . $v . '&';
        }
        rtrim($postData, '&');

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $output = curl_exec($ch);

        curl_close($ch);
        return $output;
    }

    /**
     * 
     * @param type $celular
     * @param type $msg
     */
    public function sendSMS($celular, $msg) {
        /**
         * SMS
         */
        $url = 'http://painel.hotmobile.com.br/SendAPI/Send.aspx?';
        $params = [
            'usr' => 'diego@focomultimidia.com',
            'pwd' => '010203',
            'number' => implode(',', $celular),
            'sender' => '7130132022',
            'msg' => $msg,
            'flash' => null,
            'AlphaSize' => '16',
        ];
        file_get_contents($url.  http_build_query($params));
    }

}

?>