<?php

class PostFileCURL {

    /**
     * 
     * @param array $remote_file
     * @param array $options
     */
    public static function setPostFileCURL(array $remote_file, array $options) {

//        $url = "http://" . $_SERVER['HTTP_HOST'] . "/curl/remote_upload.php";
        $url = "http://3heads/projeto_3heads/curl/remote_upload.php";
//        $url = "https://motor-reserva.com.br/curl/remote_upload.php";
//        $url = "http://74.63.255.164/curl/remote_upload.php";

        $ch = curl_init($url);

        $data = array();
        $params = array();

        foreach ($remote_file['name'] as $key => $value) {
            $file = array(
                'name' => $value,
                'type' => $remote_file['type'][$key],
                'tmp_name' => $remote_file['tmp_name'][$key],
                'error' => $remote_file['error'][$key],
                'size' => $remote_file['size'][$key]
            );

            $cfile = new CURLFile($file['tmp_name'], $file['type'], $file['name']);
            $data['file[' . $key . ']'] = $cfile;
        }

        $post_data = $options['post_data'];
        unset($options['post_data']);
        $params = $options;


        if (!empty($post_data)) {
            foreach ($post_data as $key => $value) {
                if (is_array($value)) {
                    $params[$key] = json_encode($value);
                } else {
                    $params[$key] = $value;
                }
            }
        }

        $data['data'] = http_build_query($params);

        $headers = array("Content-Type:multipart/form-data");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
//        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        $file_contents = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($file_contents);
    }

}

?>
