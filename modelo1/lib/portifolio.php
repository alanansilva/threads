<!-- portfolio -->
<script src="js/jquery.chocolat.js"></script>
<script type="text/javascript">
    $(function () {
        $(".colorBoxGroup1").colorbox({rel:'colorBoxGroup1'});
    });
</script>
<div id="portfolio" class="mod_cat">
    <div class="container">
        <div class="title_cat">
            <h3>PORTFOLIO</h3>
        </div>
        <div class="clearfix"></div>
        <section>
            <?php
              $path = URL_POST_FILE_REMOTE;
            $objColConteudo = $conteudo->getColecaoConteudo(null, 7);
//             UtilString::pr($objColConteudo);
            while ($objColConteudo->proximo()) {
                $objConteudo = $objColConteudo->getItem();
                $objImagem = $imagem->getImagem(null, 7, $objConteudo['id']);
               
                    ?>
            <ul id="da-thumbs" class="da-thumbs">
                <li>
                    <a href="<?php echo $path . $objImagem['nome_img'] ?>" class="colorBoxGroup1">
                        <img src="<?php echo $path . $objImagem['nome_img'] ?>" alt="Imagem" />
                        <div>
                            <h5>VER</h5>
                        </div>
                    </a>
                </li>
                         <?php
            }
            ?>
            </ul>
        </section>
        <script type="text/javascript" src="js/jquery.hoverdir.js"></script>	
        <script type="text/javascript">
    $(function () {
        $('#da-thumbs > li').each(function () {
            $(this).hoverdir();
        });
    });
        </script>
    </div>
</div>
<div class="clearfix"></div>
<!-- //portfolio -->