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

            $mail->Subject = 'Upload de Arquivo n�o permitido - Motor de Reserva';
            $txt.= 'Arquivo: '.$file;
            $txt.= '<br>Usu�rio: '.$_SESSION['dados']['usuario']['nome'];
            $txt.= '<br>Usu�rio Id: '.$_SESSION['dados']['usuario']['id'];
            $txt.= '<br>Cliente: '.$_SESSION['dados']['pessoa']['nome'];
            $txt.= '<br>Cliente Id: '.$_SESSION['dados']['pessoa']['id'];
            $txt.= '<br>Hora: '.date('d/m/Y H:i:s');
            $txt.= '<br>�rea do Sistema: '.$_REQUEST['app'];
            $txt.= '<br>IP : '.$_SERVER['REMOTE_ADDR'];
            $mail->Body = $txt;
            $usuario->desativarUsuario($_SESSION['dados']['usuario']['id']);
            if ($mail->Send()) {
                echo "Informa��es enviadas com sucesso.";
            } else {
                echo "N�o foi poss�vel enviar as inform��es.";
            }
            $_SESSION['dados']['usuario']['id'] = null;
            $_SESSION['dados']['pessoa']['id'] = null;
            echo '<h2>Voc� tentou fazer upload de arquivos n�o permitido.</h2>';
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