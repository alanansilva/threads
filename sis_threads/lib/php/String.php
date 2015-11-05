<?php

class UtilString {

    public static function insereStringNumero($_numero) {
        if ($_numero != "") {
            return " $_numero ";
        } else {
            return " null ";
        }
    }

    public static function insereData($data, $tipo) {
        $dt = explode("/", $data);
        if ($tipo == "") {
            $dta = $dt[2] . "-" . $dt[1] . "-" . $dt[0] . " " . date("H:i:s");
        } else {
            $dta = $dt[2] . "-" . $dt[1] . "-" . $dt[0] . " 00:00:00";
        }
        return $dta;
    }

    public static function insereStringHora($_hora) {
        if ($_hora != "") {
            return " '$_hora' ";
        } else {
            return " null ";
        }
    }

    public static function retornaValorPorExtenso($valor = 0) {
        $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
        $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões", "quatrilhões");

        $c = array("", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
        $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa");
        $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove");
        $u = array("", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");

        $z = 0;
        $rt = "";
        $valor = number_format($valor, 2, ".", ".");
        $inteiro = explode(".", $valor);
        for ($i = 0; $i < count($inteiro); $i++) {
            for ($ii = strlen($inteiro[$i]); $ii < 3; $ii++) {
                $inteiro[$i] = "0" . $inteiro[$i];
            }
        }

        // $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
        $fim = count($inteiro) - ($inteiro[count($inteiro) - 1] > 0 ? 1 : 2);

        for ($i = 0; $i < count($inteiro); $i++) {
            $valor = $inteiro[$i];
            $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
            $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
            $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

            $r = $rc . (($rc && ($rd || $ru)) ? " e " : "") . $rd . (($rd && $ru) ? " e " : "") . $ru;
            $t = count($inteiro) - 1 - $i;
            $r .= $r ? " " . ($valor > 1 ? $plural[$t] : $singular[$t]) : "";

            if ($valor == "000") {
                $z++;
            } elseif ($z > 0) {
                $z--;
            }
            if (($t == 1) && ($z > 0) && ($inteiro[0] > 0)) {
                $r .= (($z > 1) ? " de " : "") . $plural[$t];
            }
            if ($r) {
                $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
            }
        }

        return($rt ? $rt : "zero");
    }

    /**
     * FORMATA O VALOR NO PADRÃO PARA INSERIR NO BANCO
     * @param DOUBLE $valor
     * @return $valor
     */
    public static function formataValor($valor, $tipo = 1, $moeda = 1) {
        if ($tipo == 1) {
            return str_replace(",", ".", str_replace(".", "", $valor));
        } elseif ($tipo == 2) {
            return number_format($valor, 2, ',', '.');
        } elseif ($tipo == 3) {
            if (empty($moeda)) {
                $moeda = 1;
            }
            $simbolo = array(
                1 => 'R$'
            );
            return $simbolo[$moeda] . ' ' . number_format($valor, 2, ',', '.');
        }
    }

    /**
     * 
     * RETORNA UM ÍCONE SE PARA VERDADEIRO OU FALSO
     * @param booleam/int $tipo
     * @param string $titleTrue
     * @param string $titleFalse
     */
    public static function getFlagAfirmacao($tipo, $titleTrue = 'Sim', $titleFalse = 'Não') {
        /* if (($tipo == 1) || ($tipo)) {
          $img = '../../images/drop-yes.gif';
          $title = $titleTrue;
          } elseif (($tipo == 0) || (!$tipo)) {
          $img = '../../images/delete.gif';
          $title = $titleFalse;
          }
          return '<img src="' . $img . '" title="' . $title . '"/>';
         */
        if (($tipo == 1) || ($tipo === true) || ($tipo == 'S')) {
            $classe = 'glyphicon glyphicon-ok';
            $title = $titleTrue;
            $estiloNovo = 'style="color: #5cb85c;"';
        } elseif (($tipo == 0) || (!$tipo) || ($tipo == 'N')) {
            $classe = 'glyphicon glyphicon-remove';
            $title = $titleFalse;
            $estiloNovo = 'style="color: #d9534f;"';
        }
        return '<span class="' . $classe . '" title="' . $title . '"' . $estiloNovo . '></span>';
    }

    /**
     * Funçãp que gera numeros sequencias
     *
     * @param String $cnt
     * @param string $faixa
     * @return sequencia
     */
    public static function getNumSequencial($cnt, $faixa = '000000000') {
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
    public static function getImagemFile($ext) {

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

    public static function getConvertCharset($str) {
        $charset = mb_detect_encoding($str, 'UTF-8, ISO-8859-1');

        if ($charset == "UTF-8") {
            return iconv("UTF-8", "ISO-8859-1//TRANSLIT", $str);
        } elseif ($charset == "ISO-8859-1") {
            return iconv("ISO-8859-1", "UTF-8//TRANSLIT", $str);
        }
    }

    /**
     * Cria recursivamente ou não um caminha de diretórios pré-definidos e dar permissão
     * @param string $url
     * @param int $mode
     * @param bool $recursive
     */
    public static function CreatePathPermission($url, $mode = 0777, $recursive = true) {
        if ($recursive)
            @mkdir($url, 0774, true);
        else
            @mkdir($url, 0774);

        @chmod($url, $mode);
    }

    public static function searchString($string, $busca) {
        if ($busca == "")
            return 1;

        $vi = split("%", $busca);
        $offset = 0;
        for ($n = 0; $n < count($vi); $n++) {
            if ($vi[$n] == "") {
                if ($vi[0] == "") {
                    $tieneini = 1;
                }
            } else {
                $newoff = strpos($string, $vi[$n], $offset);
                if ($newoff !== false) {
                    if (!$tieneini) {
                        if ($offset != $newoff) {
                            return false;
                        }
                    }
                    if ($n == count($vi) - 1) {
                        if ($vi[$n] != substr($string, strlen($string) - strlen($vi[$n]), strlen($vi[$n]))) {
                            return false;
                        }
                    } else {
                        $offset = $newoff + strlen($vi[$n]);
                    }
                } else {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Retorna um editor (FckEditor)
     * @param string $value
     * @param string $nomeEditor
     * @param string $url
     */
    public static function getFckEditor($value = null, $nomeEditor = 'descricao', $url = '../../lib/php/editorFckEditor.php') {

        if (!empty($value))
            $descricao = $value;

        require_once $url;
    }

    /**
     * Retorna a distancia em Km com base no google Maps
     * @param   type $origem
     * @param   type $destino
     * @param   type $mode
     * @param   type $sensor
     * @return  type String
     */
    public static function getCalculaDistanciaGoogleMaps($origem, $destino, $mode = 'car', $sensor = 'false') {

        $url = 'http://maps.googleapis.com/maps/api/distancematrix/xml?origins=' . $origem . '&destinations=' . $destino . '&mode=' . $mode . '&sensor=' . $sensor . '';
        $dados = file_get_contents($url);
        $p = xml_parser_create();
        xml_parse_into_struct($p, $dados, $vals, $index);
        xml_parser_free($p);

        return $distancia_tempo = array('distancia' => $vals[21]['value'], 'tempo' => $vals[14]['value']);
    }

    /**
     * Retorna a strig reduzida.
     * @param int $limite
     * @param string $var
     * @return string $var
     */
    public static function getStringReduzida($limite, $var) {
        if (strlen($var) > $limite)
            return substr($var, 0, $limite) . '...';
        else
            return $var;
    }

    public static function calculaCambio($valor, $moeda = 1, $cambio = null) {

        if ($moeda == 1) {
            return $valor;
        } elseif ($moeda == 2) {
            $resultado = $valor / $cambio;
            return $resultado;
        } elseif ($moeda == 3) {
            $resultado = $valor / $cambio;
            return $resultado;
        } else {
            return $valor;
        }
    }

    /**
     * Ordena um array em ordem crescentess
     * @param type $array
     * @return type
     */
    public static function quicksort($array) {
        if (count($array) < 2) {
            return $array;
        }
        $left = $right = array();
        reset($array);
        $pivot_key = key($array);
        $pivot = array_shift($array);
        foreach ($array as $k => $v) {
            if ($v < $pivot)
                $left[$k] = $v;
            else
                $right[$k] = $v;
        }
        return array_merge(self::quicksort($left), array($pivot_key => $pivot), self::quicksort($right));
    }

    /**
     * 
     * @param type $arr
     * @param type $stop
     * @param type $debug
     */
    public static function pr($arr, $stop = false, $debug = false) {
        echo '<pre>';
        if (!$debug)
            print_r($arr);
        elseif ($debug)
            var_dump($arr);
        echo '</pre>';
         if ($stop) {
             die();
         }
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
    public static function httpPost($url, $params) {

        $post_data = http_build_query($params);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, count($post_data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        $output = curl_exec($ch);

        curl_close($ch);
        return $output;
    }

    public static function rand_str($length = 32, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890') {
        $chars_length = (strlen($chars) - 1);

        $string = $chars{rand(0, $chars_length)};

        for ($i = 1; $i < $length; $i = strlen($string)) {
            $r = $chars{rand(0, $chars_length)};
            if ($r != $string{$i - 1})
                $string .= $r;
        }

        return $string;
    }

    /**
     * 
     * @param type $str
     */
    public static function replaceStr($str) {
        $str = @ereg_replace("[ÁÀÂÃ]", "A", $str);
        $str = @ereg_replace("[áàâãª]", "a", $str);
        $str = @ereg_replace("[ÉÈÊ]", "E", $str);
        $str = @ereg_replace("[éèê]", "e", $str);
        $str = @ereg_replace("[ÍÌÊ]", "I", $str);
        $str = @ereg_replace("[íìî]", "i", $str);
        $str = @ereg_replace("[ÓÒÔÕ]", "O", $str);
        $str = @ereg_replace("[óòôõº]", "o", $str);
        $str = @ereg_replace("[ÚÙÛ]", "U", $str);
        $str = @ereg_replace("[úùû]", "u", $str);
        $str = @str_replace("Ç", "C", $str);
        $str = @str_replace("ç", "c", $str);
        $str = @str_replace("'", "", $str);
        $str = @str_replace('"', '', $str);
        $str = @str_replace(' ', '-', $str);
        $str = @str_replace('/', '-', $str);

        return $str;
    }

    public static function removeSqlInjection($arr) {
        if (is_array($arr)) {
            foreach ($arr as $key => $value) {
                $arr[$key] = preg_replace(sql_regcase('/( or | or|from|select|insert|delete|where|drop table|show tables|#|\*|\\\\)/'), '', $value);
            }
            return $arr;
        } else {
            $arr = preg_replace(sql_regcase('/( or | or|from|select|insert|delete|where|drop table|show tables|#|\*|\\\\)/'), '', $value);
        }
    }

    public static function clear_data(&$mixed) {
        if (is_array($mixed) || is_object($mixed)) {
            array_walk($mixed, 'self::clear_data');
        } elseif (is_string($mixed)) {
            $mixed = preg_replace(sql_regcase('/( or | or|from|select|insert|delete|where|drop table|show tables|#|\*|\\\\)/'), '', $mixed);
            $mixed = addslashes($mixed);
        }
        return $mixed;
    }

    /**
     * Valida senha
     * @param type $password
     * @return boolean
     */
    public static function validaPassword($password, $length = 8) {

        if (strlen($password) < $length) {
            $result = array('success' => '0', 'msg' => 'A senha dever conter 8 ou mais caracteres.');
        } elseif (ctype_alpha($password) === true) {
            $result = array('success' => '0', 'msg' => utf8_encode('A senha contém apenas letras.'));
        } elseif (ctype_digit($password) === true) {
            $result = array('success' => '0', 'msg' => utf8_encode('A senha contém apenas números.'));
        } elseif (ctype_alnum($password) === true) {
            $result = array('success' => '0', 'msg' => utf8_encode('A senha contém apenas letras e números. Insira caracteres especiais.'));
        } else {
            $result = array('success' => '1', 'msg' => 'A senha foi aprovada.');
        }

        return json_encode($result);
    }

    public static function httpPostJson($url, $params) {

        $post_data = http_build_query($params);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, count($post_data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        $output = curl_exec($ch);

        curl_close($ch);

        return json_decode(utf8_decode($output));
    }

    /**
     * Retorna se existe uma ocorrência na string
     * @param type $string
     * @param type $busca
     * @return boolean
     */
    public static function searchStringRegex($string, $find) {
        if (preg_match("[{$find}]", strtolower($string)))
            return true;

        return false;
    }

}

?>