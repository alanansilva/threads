<?php
require_once 'conn.php';

if (!isset($_SESSION['dados'])) {
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" lang="pt_BR" xml:lang="pt_BR">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
            <meta http-equiv="Content-Language" content="pt_BR" />
            <meta name="GENERATOR" content="PHPEclipse 1.2.0" />
            <title>Foco Hoteis</title>
        </head>
        <body>
            Usuário não autenticado, ou a sessão caiu.
            <a href="/">Voltar</a>

        </body>
    </html>
    <?php
    header('location:./3heads');
}
?>