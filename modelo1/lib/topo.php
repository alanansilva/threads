<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

header("Content-Type: text/html; charset=ISO-8859-1", true);

require_once 'lib/conn.php';
require_once 'lib/models/Pessoa.php';
require_once 'lib/models/Banner.php';
require_once 'lib/models/BannerCategoria.php';
require_once 'lib/models/Conteudo.php';
require_once 'lib/models/ConteudoCategoria.php';
require_once 'lib/models/Imagem.php';
require_once 'lib/models/Menu.php';
require_once 'lib/models/Perfil.php';
require_once 'lib/models/TipoPessoa.php';
require_once 'lib/models/Usuario.php';
require_once 'lib/PostFileCURL.php';
require_once 'lib/models/IconeBootstrap.php';

//require_once 'lib/UploadFiles.php';

$pessoa = new Pessoa();
$banner = new Banner();
$bannerCategoria = new BannerCategoria();
$conteudo = new Conteudo();
$conteudoCategoria = new ConteudoCategoria();
$imagem = new Imagem();
$menu = new Menu();
$perfil = new Perfil();
$tipoPessoa = new TipoPessoa();
$usuario = new Usuario();
$iconeBootstrap = new IconeBootstrap();

$url = "http://curl.threads.com.br/";
define('URL_POST_FILE_REMOTE', $url);
define('PESSOA_ID', 1);
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>.:: Modelo 1 ::.</title>
        <!--fonts-->
  
        <link href='//fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
              rel='stylesheet' type='text/css'>
        <!--//fonts-->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
        <link rel="stylesheet" href="css/chocolat.css" type="text/css">
        <!-- for-mobile-apps -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="keywords" content="Bigwig Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
              Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- //for-mobile-apps -->	
        <!-- js -->
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <!-- js -->
        <script src="js/modernizr.custom.97074.js"></script>
        <!-- start-smoth-scrolling -->
        <script type="text/javascript" src="js/move-top.js"></script>
        <script type="text/javascript" src="js/easing.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $(".scroll").click(function (event) {
                    event.preventDefault();
                    $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
                });
            });
        </script>
        <!-- start-smoth-scrolling -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>

<!--        <link rel="stylesheet" type="text/css" href="lib/lib/js/validate/css/style.css" />
        <script src="lib/lib/js/validate/assets/js/jquery.validate.min.js"></script>-->

        
    </head>
    <body>