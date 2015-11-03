<!-- banner-slider -->
<script src="js/jquery.bxslider/jquery.bxslider.min.js"></script>
<link href="js/jquery.bxslider/jquery.bxslider.css" rel="stylesheet" />
<style>
    /* Início Galeria bxslider index geral */
    .galeria_bxslider_full_ger .bx-wrapper{
        margin: 0 auto !important;
    }
    .galeria_bxslider_full_ger .bx-wrapper img{
        width: 100%;
    }
    .galeria_bxslider_full_ger .bx-viewport{
        box-shadow: none !important;
        border: none !important;
    }
    .galeria_bxslider_full_ger{
        position: relative;
    }
    .galeria_bxslider_full_sup_btns{
        width: 100%;
        position: absolute;
        top: 50%;
    }
    .galeria_bxslider_full_sup_btns #galeria_bxslider_sup_btn_esq, .galeria_bxslider_full_sup_btns #galeria_bxslider_sup_btn_dir{
        position: absolute;
        -webkit-transition: all 100ms ease;
        -moz-transition: all 100ms ease;
        -ms-transition: all 100ms ease;
        -o-transition: all 100ms ease;
        transition: all 100ms ease;
    }
    .galeria_bxslider_full_sup_btns #galeria_bxslider_sup_btn_esq:hover, .galeria_bxslider_full_sup_btns #galeria_bxslider_sup_btn_dir:hover{
        background: rgba(0, 0, 0, 0.7);
        -webkit-transition: all 100ms ease;
        -moz-transition: all 100ms ease;
        -ms-transition: all 100ms ease;
        -o-transition: all 100ms ease;
        transition: all 100ms ease;
    }
    .galeria_bxslider_full_sup_btns #galeria_bxslider_sup_btn_esq{
        left: 0;
    }
    .galeria_bxslider_full_sup_btns #galeria_bxslider_sup_btn_dir{
        right: 0;
    }
    .galeria_bxslider_full_sup_btns i{
        /*font-size: 40px;*/
        font-size: 18px;
        /*color: #03BEF0;*/
        color: #FFF;
    }
    .galeria_bxslider_full_sup_btns .bx-prev, .galeria_bxslider_full_sup_btns .bx-next{
        width: 35px;
        height: 60px;
        display: block;
        line-height: 68px;
        position: relative;
        text-align: center;
        background: rgba(0, 0, 0, 0.50);
        margin: 0;
    }
    .galeria_bxslider_full_ger .bx-controls{
        position: relative;
        top: -50px;
    }
    .galeria_bxslider_full_ger .bx-wrapper .bx-pager.bx-default-pager a:hover, .galeria_bxslider_full_ger .bx-wrapper .bx-pager.bx-default-pager a.active{
        background: #03BEF0;
    }
    .galeria_bxslider_full_ger .bx-wrapper .bx-viewport{
        left: 0;
    }
    /* Fim Galeria bxslider index geral */
</style>
<script>
    $(document).ready(function () {
        $('.galeria_bxslider_full_sup').bxSlider({
            auto: true,
            autoHover: true,
            adaptiveHeight: true,
            nextSelector: '#galeria_bxslider_sup_btn_dir',
            prevSelector: '#galeria_bxslider_sup_btn_esq',
            nextText: '<i class="glyphicon glyphicon-menu-right"></i>',
            prevText: '<i class="glyphicon glyphicon-menu-left"></i>'
        });

        $('.galeria_bxslider_full_ger').hover(
                function () {
                    $('#galeria_bxslider_sup_btn_esq, #galeria_bxslider_sup_btn_dir').fadeIn('fast');
                }, function () {
            $('#galeria_bxslider_sup_btn_esq, #galeria_bxslider_sup_btn_dir').fadeOut('fast');
        }
        );

        setTimeout(function () {
            $('#galeria_bxslider_sup_btn_esq, #galeria_bxslider_sup_btn_dir').fadeOut('fast');
        }, 1000);
    });
</script>
<!--<div id="home" class="banner-slider">-->
<div id="home">
    <div id="top" class="callbacks_container">
        <div class="galeria_bxslider_full_ger">
            <ul class="galeria_bxslider_full_sup">
                <?php
                 $path = URL_POST_FILE_REMOTE;
                $objBanner=$banner->getBanner(null, 1);
                
                $objColImagem=$imagem->getColecaoImagem(9,$objBanner['id']);
                while ($objColImagem->proximo()){
                    $objImagem=$objColImagem->getItem();
                ?>
                <li>
                    <img src="<?php echo $path . $objImagem['nome_img']?>" />
                </li>
                <?php
                }
                ?>
            </ul>
            <div class="galeria_bxslider_full_sup_btns">
                <span id="galeria_bxslider_sup_btn_esq"></span>
                <span id="galeria_bxslider_sup_btn_dir"></span>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<!-- //banner-slider -->