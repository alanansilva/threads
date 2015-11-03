<?php

class UploadFiles {

    private $nameFile;

    /**
     * Enter description here...
     *
     * @param String $destino
     * @param GLOBAL $file
     * @return $_FILES
     */
    public function upload($destino, $file, $nome = null) {
        ini_set('post_max_size', '8M');
        ini_set('upload_max_filesize', '8M');

        $arquivoTmp = $file["tmp_name"];

        $file = $file["name"];

        $file = @ereg_replace("[ÁÀÂÃ]", "A", $file);
        $file = @ereg_replace("[áàâãª]", "a", $file);
        $file = @ereg_replace("[ÉÈÊ]", "E", $file);
        $file = @ereg_replace("[éèê]", "e", $file);
        $file = @ereg_replace("[ÍÌÊ]", "I", $file);
        $file = @ereg_replace("[íìî]", "i", $file);
        $file = @ereg_replace("[ÓÒÔÕ]", "O", $file);
        $file = @ereg_replace("[óòôõº]", "o", $file);
        $file = @ereg_replace("[ÚÙÛ]", "U", $file);
        $file = @ereg_replace("[úùû]", "u", $file);
        $file = @str_replace("Ç", "C", $file);
        $file = @str_replace("ç", "c", $file);
        $file = @str_replace("-", "", $file);
        $file = @str_replace("'", "", $file);
        $file = @str_replace('"', '', $file);
        $file = @str_replace('_', '', $file);
        

        if (strripos($file, ".php") != false) {
            require_once '../../models/usuario.php';
            require_once '../../lib/php/class.phpmailer.php';
            $usuario = new Usuario();
            
            $mail = new PHPMailer();
            $host = "mail.meusitenaweb.com.br";
            $userName = "formulario@meusitenaweb.com.br";
            $password = "formulario!@foco#";
            $from = "formulario@meusitenaweb.com.br";

            $mail->IsSMTP(); // send via SMTP
            $mail->SMTPAuth = true; // 'true' para autenticacao
            $mail->CharSet = "ISO-8859-1";

            $mail->Host = $host;
            $mail->Username = $userName;
            $mail->Password = $password;
            $mail->From = $from;
            $mail->FromName = 'FocoMultimidia';
            $mail->AddCC('alanansilva@gmail.com', 'Alana Nunes');
//            $mail->AddCC('juvenal@focomultimidia.com', ' Juvenal');
//            $mail->AddCC('diego@focomultimidia.com', 'Diego Silveira');

            $mail->WordWrap = 64; // Definicao de quebra de linha
            $mail->IsHTML(true); // envio como HTML se 'true'

            $mail->Subject = 'Upload de Arquivo não permitido - Motor de Reserva';
            $txt.= 'Arquivo: '.$file;
            $txt.= '<br>Usuário: '.$_SESSION['dados']['usuario']['nome'];
            $txt.= '<br>Usuário Id: '.$_SESSION['dados']['usuario']['id'];
            $txt.= '<br>Cliente: '.$_SESSION['dados']['pessoa']['nome'];
            $txt.= '<br>Cliente Id: '.$_SESSION['dados']['pessoa']['id'];
            $txt.= '<br>Hora: '.date('d/m/Y H:i:s');
            $txt.= '<br>Área do Sistema: '.$_REQUEST['app'];
            $txt.= '<br>IP : '.$_SERVER['REMOTE_ADDR'];
            $mail->Body = $txt;
            $usuario->desativarUsuario($_SESSION['dados']['usuario']['id']);
            if ($mail->Send()) {
                echo "Informações enviadas com sucesso.";
            } else {
                echo "Não foi possível enviar as informções.";
            }
            $_SESSION['dados']['usuario']['id'] = null;
            $_SESSION['dados']['pessoa']['id'] = null;
            echo '<h2>Você tentou fazer upload de arquivos não permitido.</h2>';
            exit;
        }

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

        $this->nameFile = $nomeArquivo;

        return $retorno;
    }

    /**
     * RETORNA O NOME DO ARQUIVO
     *
     * @return $this->nameFile;
     */
    public function getNameFile() {
        return $this->nameFile;
    }

}

?>