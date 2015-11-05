<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
header("Content-Type: text/html;  charset=ISO-8859-1", true);
ob_start();

require_once './conn.php';
require_once '../../../sis_3heads/lib/php/class.phpmailer.php';
require_once '../../../sis_3heads/models/Pessoa.php';

$mail = new PHPMailer();
$pessoa = new Pessoa();
$objPessoa = $pessoa->getPessoa();
//UtilString::pr($objPessoa);
extract($_REQUEST);
//UtilString::pr($_REQUEST);
?>
<table>
    <tr>
        <td>
            Nome:
        </td>
        <td>
            <?php echo $nome_enviar_email ?>
        </td>
    </tr>
    <tr>
        <td>
            E-mail:
        </td>
        <td>
            <?php echo $email_enviar_email ?>
        </td>
    </tr>
    <tr>
        <td>
            Assunto:
        </td>
        <td>
            <?php echo $assunto_enviar_email ?>
        </td>
    </tr>
    <tr>
        <td>
            Mensagem:
        </td>
        <td>
            <?php echo $mensagem_enviar_email ?>
        </td>
    </tr>
    <tr>
</table>
 <?php
    $content = ob_get_clean();
    
    $host = "webmail.motor-reserva.com.br";
    $userName = "mensagens@motor-reserva.com.br";
    $password = "F0c0_@#123**_.";
    $from = "mensagens@motor-reserva.com.br";
        
//    $host = "mail.meusitenaweb.com.br";
//$userName = "formulario@meusitenaweb.com.br";
//$password = "formulario!@foco#";
//$from = "formulario@meusitenaweb.com.br";

    $mail->IsSMTP(); // send via SMTP
    $mail->SMTPAuth = true; // 'true' para autenticacao
    $mail->CharSet = "ISO-8859-1";


    $mail->Host = $host;
    $mail->Username = $userName;
    $mail->Password = $password;
    $mail->From = $from;
    $mail->FromName = 'Novos Contatos';

//     $mail->AddCC('alanansilva@gmail.com');
    
    $mail->AddAddress('alanansilva@gmail.com');
    $mail->WordWrap = 64; // Definicao de quebra de linha
    $mail->IsHTML(true); // envio como HTML se 'true'

    $mail->Subject = $assunto;

    $mail->Body = $content;

    if (!$mail->Send()) {
        die($mail->ErrorInfo);
    } else {
        echo '<script>alert("Email enviado com sucesso")</script>';
    }