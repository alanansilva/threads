<style>
    .menu_princ_ger {
        display: inline-block;
        vertical-align: middle;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        box-shadow: 0 0 1px rgba(0, 0, 0, 0);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -moz-osx-font-smoothing: grayscale;
        position: relative;
        -webkit-transition-property: color;
        transition-property: color;
        -webkit-transition-duration: 0.5s;
        transition-duration: 0.5s;
    }
    .menu_princ_ger:before {
        content: "";
        position: absolute;
        z-index: -1;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: #D7D7D7;
        -webkit-transform: scaleY(0);
        transform: scaleY(0);
        -webkit-transform-origin: 50% 0;
        transform-origin: 50% 0;
        -webkit-transition-property: transform;
        transition-property: transform;
        -webkit-transition-duration: 0.5s;
        transition-duration: 0.5s;
        -webkit-transition-timing-function: ease-out;
        transition-timing-function: ease-out;
    }
    .menu_princ_ger:hover, .menu_princ_ger:focus, .menu_princ_ger:active {
        color: white;
    }
    .menu_princ_ger:hover:before, .menu_princ_ger:focus:before, .menu_princ_ger:active:before {
        -webkit-transform: scaleY(1);
        transform: scaleY(1);
        -webkit-transition-timing-function: cubic-bezier(0.52, 1.64, 0.37, 0.66);
        transition-timing-function: cubic-bezier(0.52, 1.64, 0.37, 0.66);
    }


    .navigation ul li {
        text-align: center;
        border-left: 0;
        display: inline-block;
        list-style-type: none;
        float: left;
    }
    .navigation ul li a{
        color: #000;
        font-size: 13px;
        font-weight: bold;
        padding: 29px 15px 22px;
        outline: none;
    }
    .header a:hover, .header a:focus{
        text-decoration: none;
        outline: none;
    }
</style>
<?php
$objPessoa = $pessoa->getPessoa(null, 1);
$objImagem= $imagem -> getImagem(null, MENU_ID, $objPessoa['id']);
?>
<div class="header" style="width: 100%; position: fixed; z-index: 3;">
    <div class="header-left">
        <a class="scroll" href="#home">
            <!--<img src="http://www.focomultimidia.com/img/logo.png" alt="Logo" />-->
            <img src="<?php echo$objImagem['nm_imagem'] ?>" alt="Logo" />
        </a>
    </div>
    <div class="navigation">
        <span class="menu"><img src="images/menu.png" alt=""/></span>
        <!--<nav class="cl-effect-11" id="cl-effect-11">-->	
        <nav>	
            <ul class="nav1">	
                <!--<li><a class="scroll" href="#home" data-hover="INÍCIO">INÍCIO</a></li>-->
                <li class="menu_princ_ger"><a class="scroll" href="#sobre">EMPRESA</a></li>
                <li class="menu_princ_ger"><a class="scroll" href="#equipe">EQUIPE</a></li>
                <li class="menu_princ_ger"><a class="scroll" href="#servicos">SERVIÇOS</a></li>
                <li class="menu_princ_ger"><a class="scroll" href="#produtos">PRODUTOS</a></li>
                <li class="menu_princ_ger"><a class="scroll" href="#parceiros">PARCEIROS</a></li>
                <li class="menu_princ_ger"><a class="scroll" href="#clientes">CLIENTES</a></li>
                <li class="menu_princ_ger"><a class="scroll" href="#portfolio">PORTFOLIO</a></li>
                <li class="menu_princ_ger"><a class="scroll" href="#contato">CONTATO</a></li>
            </ul>
        </nav>
        <!-- script for menu -->
        <script>
            $("span.menu").click(function () {
                $("ul.nav1").slideToggle(300, function () {
                    // Animation complete.
                });
            });
        </script>
        <!-- //script for menu -->

    </div>
    <div class="clearfix"></div>
</div>