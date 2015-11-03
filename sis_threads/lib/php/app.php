<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);


ob_start();
session_start();
require_once 'session.php';

require_once 'UploadFiles.php';
require_once '../../models/Imagem.php';
require_once 'PostFileCURL.php';

$host = "mail.meusitenaweb.com.br";
$userName = "formulario@meusitenaweb.com.br";
$password = "formulario!@foco#";
$from = "formulario@meusitenaweb.com.br";

define('HOST', $host);
define('USER_NAME', $userName);
define('PASSWORD', $password);
define('FROM', $from);
define('USUARIO_ID', $_SESSION['dados']['usuario']['id']);
define('PESSOA_ID', $_SESSION['dados']['pessoa']['id']);
//define('URL_POST_FILE_REMOTE', 'http://joelsonbraga.com.br/checkok/curl/');
//define('URL_POST_FILE_REMOTE', 'http://74.63.255.164/curl/');
$url = "http://3heads/projeto_3heads/curl/";
define('URL_POST_FILE_REMOTE', $url);
define('PERFIL_ID', $_SESSION['dados']['pessoa']['perfil_id']);
define('TIPO_PESSOA_ID', $_SESSION['dados']['pessoa']['tipo_pessoa_id']);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt_BR" xml:lang="pt_BR">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta http-equiv="Content-Language" content="pt_BR" />
        <meta name="GENERATOR" content="PHPEclipse 1.2.0" />

        <link rel="stylesheet" type="text/css" href="../ext/resources/css/core.css" />
        <link rel="stylesheet" type="text/css" href="../ext/resources/css/window.css" />
        <link rel="stylesheet" type="text/css" href="../ext/resources/css/panel.css" />
        <link rel="stylesheet" type="text/css" href="../ext/resources/css/xtheme-gray.css" />
        <link rel="stylesheet" type="text/css" href="../ext/resources/css/ext-all.css" />	

        <script src="../js/jquery-1.11.0.min.js"></script>

        <script type="text/javascript" src="../ext/adapter/ext/ext-base.js"></script>
        <script type="text/javascript" src="../ext/ext-all.js"></script>


        <!-- Bootstrap 3.0.3 -->
        <link rel="stylesheet" type="text/css" href="../js/bootstrap/css/bootstrap.min.css" />
        <script type="text/javascript" src="../js/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap/js/holder.js"></script>
        <script type="text/javascript" src="../js/bootstrap/js/application.js"></script>
        <script type="text/javascript" src="../js/bootstrap/js/bootbox.min.js"></script>

        <link rel="stylesheet" href="../js/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css" />
        <script src="../js/jquery-ui-1.10.4.custom/development-bundle/external/jquery.mousewheel.js"></script>
        <script src="../js/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
        <script>
            $(function () {
                $('.spinner').spinner();
            });
        </script>

        <!--Paginacao Jquery -->
        <script language="JavaScript" type="text/javascript" src="../js/jTPS_grid/jTPS.js"></script>
        <link rel="stylesheet" type="text/css" href="../js/jTPS_grid/jTPS.css">
            <!--Fim Paginacao Jquery  -->


            <!-- wysihtml5 --> 
            <link rel="stylesheet" type="text/css" href="../js/bootstrap-wysihtml5-master/lib/css/bootstrap.min.css"></link>

            <!-- Início datepicker -->
            <link rel="stylesheet" href="../js/datepicker-bootstrap/css/datepicker.css" />
            <script src="../js/datepicker-bootstrap/js/bootstrap-datepicker.js"></script>
            <script src="../js/datepicker-bootstrap/js/locales/bootstrap-datepicker.pt-BR.js"></script>
            <!-- Fim datepicker -->

            <!-------Novo Fkeditor---------->
            <script src="../js/ckeditor/ckeditor.js"></script>
            <script src="../js/ckeditor/adapters/jquery.js"></script>
            <!-------Novo Fkeditor---------->


            <!-- Início CSS para alertas -->
            <link rel="stylesheet" href="../js/alertify.js-0.3.11/themes/alertify.core.css" />
            <link rel="stylesheet" href="../js/alertify.js-0.3.11/themes/alertify.default.css" id="toggleCSS" />
            <style>
                .alertify-log-custom {
                    background: blue;
                }
            </style>
            <!-- Fim CSS para alertas -->   

            <!-- Início Select-bootstrap -->
            <script type="text/javascript" src="../js/select-bootstrap/bootstrap-select.js"></script>
            <link rel="stylesheet" type="text/css" href="../js/select-bootstrap/bootstrap-select.css" />
            <script type="text/javascript">
            $(window).on('load', function () {

                $('.selectpicker').selectpicker({});

                // $('.selectpicker').selectpicker('hide');
            });
            </script>
            <!-- Fim Select-bootstrap -->


            <!-- Início icheck master -->
            <link rel="stylesheet" type="text/css" href="../js/iCheck-master/skins/all.css" />
            <script type="text/javascript" src="../js/iCheck-master/icheck.js"></script>
            <!-- Fim icheck master -->

            <style type="text/css">
                #paginacao{
                    text-align: center;
                }
            </style>


            <style>
                /* Hide Angular JS elements before initializing */
                .ng-cloak {
                    display: none;
                }

                .group_money{
                    /*            border-radius:2px;
                                border:1px solid #a1a1a1;
                                width:148px; 
                                cursor:pointer;*/
                }
            </style>
            <!-- Fim CSS JQuery Upload -->

            <!-- Validação -->
            <script src="../js/plentz-jquery-maskmoney-89c45c8/src/jquery.maskMoney.js"></script>

            <link rel="stylesheet" type="text/css" href="../js/validate/css/style.css" />
            <script src="../js/validate/assets/js/jquery.validate.min.js"></script>
            <!--<script src="../js/validate/js/script.js"></script>-->
            <script src="../js/validate/js/jquery.maskedinput.min.js" type="text/javascript"></script>

            <script src="../js/form-master/jquery.form.js"></script>         
            <script src="../js/filtro_listagem.js" type="text/javascript"></script>
            <script src="../js/global.js" type="text/javascript"></script>

            <!-- Início Script para alertas -->
            <script src="../js/alertify.js-0.3.11/lib/alertify.min.js"></script>
            <script src="../js/alertify.js-0.3.11/default.js"></script>
            <!-- Fim Script para alertas -->

            <script src="../js/alertify_msg.js" type="text/javascript"></script>
            <script src="../js/bootstrap-touchspin/bootstrap.touchspin.js"></script>


            <style>
                #picker {
                    margin:0;
                    padding:0;
                    border:0;
                    width: 200px;
                    height: 34px;
                    border-right:40px solid green;
                    line-height:20px;
                }
            </style>
            <!-- Início color picker -->

            <script>
            Ext.onReady(function () {
                var win;
                Ext.get('pesquisar').on('click', function () {
                    if (!win) {
                        win = new Ext.Window({
                            title: 'Pesquisar',
                            width: '600',
                            closeAction: 'hide',
                            autoHeight: true,
                            shadow: false,
                            modal: true,
                            borders: false,
                            items: new Ext.Panel({
                                contentEl: 'divFiltro'
                            })
                        });
                    }
                    win.show(this);
                });
            });
            function msgBoxExt(titulo, msg) {
                Ext.MessageBox.alert(titulo, msg);
            }

            </script>        

            <style type="text/css">
                /* Divisor formulário */
                .form_div_border{
                    width:100%;
                    height:1px;
                    border-bottom:1px solid #DEDEDE;
                    margin:15px 0;
                }

                h5.h5_tit_bor_bottom{
                    border-bottom:2px solid #AEAEAE;
                    padding-bottom:6px;
                    margin:15px 0;
                }


                .row_table{
                    margin-top:40px;
                    padding: 0 10px;
                }
                .clickable{
                    cursor: pointer;   
                }

                .panel-heading div {
                    margin-top: -18px;
                    font-size: 15px;
                }
                .panel-heading div span{
                    margin-left:5px;
                }
                .panel-body{
                    display: none;
                }

                .container_listagem {
                    width:100%;
                }

                .actions{
                    margin-bottom: 10px;
                }

                .actions a{
                    font-weight: bold;
                }
            </style>           


    </head>
    <body scroll='yes' style='color:#000000; font-size:80%;'>
        <?php
        $app = isset($_REQUEST["app"]) ? $_REQUEST["app"] : "";


        $split = explode('/', $app);

        if (empty($split[0])) {
            unset($split[0]);
            $s = array_chunk($split, count($split));
            $split = $s[0];
        }

        if (count($split) > 1) {
            $app = $split[0];
            $acao = $split[1];
        } else {
            $app = $split[0];
            $acao = 'index';
        }

        $acao = explode('?', $acao);

        $pathApp = "../../views/";
        define('PATH_APP', $pathApp . $app . '/');


        /**
         * GLOBAL DO MENU ID
         * @var INTEGER
         */
        define('MENU_ID', $_SESSION['menu'][$app]['menu_id']);
        define('MENU_URL', $app);

        if (is_file($pathApp . $app . "/" . $acao[0] . ".php")) {
            include($pathApp . $app . "/" . $acao[0] . ".php");
        } else {
            echo '<div id="message" style="width:600px; margin-left:-300px; text-align:left; background-color:#FFEEE8">' .
            'A página <b>' . $pathApp . $app . '/' . $acao[0] . '.php' . $params . '</b> não existe!!' .
            '<br/><br/><b>Obs.:</b> Caso seja necessário passar parâmetros via <b>$_GET</b> usar "/" como separador.' .
            '<br/><br/><hr/><br/><b>Ex.:</b> users/index/id=2 e a <b>URL</b> será users/index.php?id=2</div>';
        }
        ?>
        <script>
            $('.spinner3').addClass('input-small');
            $('.spinner3').TouchSpin();
            $('.spinner4').TouchSpin({
                max: 1000
            });
        </script>


        <script>
            $(document).ready(function () {
                if ($("input.spinner3")) {
                    $(".bootstrap-touchspin label.valid").css({
                        "right": "35px",
                        "top": "4px"
                    });
                }
            });
        </script>
    </body>
</html>