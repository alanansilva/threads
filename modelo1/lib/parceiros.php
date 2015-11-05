<!-- parceiros -->
<div id="parceiros" class="mod_cat" style="background: #EEE;">
    <div class="container">
        <div class="title_cat">
            <h3>PARCEIROS</h3>
        </div>
        <div class="clearfix"></div>
        <style>
            #parceiros ul {
                list-style: outside none none;
                position: relative;
                margin: 0px;
                padding: 0px;
            }
            #parceiros li {
                float: left;
                margin: 0.4%;
                background: #FFF none repeat scroll 0% 0%;
                padding: 8px;
                position: relative;
                width: 32.4%;
            }
            #parceiros li a, #parceiros li a img {
                display: block;
                position: relative;
                width: 100%;
            }
        </style>
        <ul>
            <?php
            $path = URL_POST_FILE_REMOTE;
            $objColConteudo = $conteudo->getColecaoConteudo(null, 5);
//             UtilString::pr($objColConteudo);
            while ($objColConteudo->proximo()) {
                $objConteudo = $objColConteudo->getItem();
                $objImagem = $imagem->getImagem(null, 7, $objConteudo['id']);
               
                    ?>
                    <li>
                        <a href="javascript:void(0)">
                            <img src="<?php echo $path . $objImagem['nome_img'] ?>" alt="Parceiros" />
                        </a>
                    </li>
                    <?php
            }
            ?>
        </ul>
    </div>
</div>
<div class="clearfix"></div>
<!-- //parceiros -->