<!--services--> 
<div id="servicos" class="mod_cat" style="background: #020202;">
    <div class="container">
        <div class="title_cat">
            <div class="ser-top">
                <h3>Serviços</h3>
                <p>Lorem Ipsum é simplesmente uma simulação de texto da indústria 
                    tipográfica e de impressos, e vem sendo utilizado desde o 
                    século XVI, quando um impressor desconhecido pegou uma bandeja</p>
            </div>
            <?php
            $objColConteudo = $conteudo->getColecaoConteudo(null, 2);
            while ($objColConteudo->proximo()) {
                $objConteudo = $objColConteudo->getItem();
                if (!empty($objConteudo['icone_bootstrap_id'])) {
                    $objIconeBootstrap = $iconeBootstrap->getIconeBootstrap($objConteudo['icone_bootstrap_id']);
                }
                ?>
                <div class="col-md-4 ser-grid">
                    <span class="<?php echo $objIconeBootstrap['classe'] ?>" aria-hidden="true"></span>
                    <h4><?php echo $objConteudo['titulo'] ?></h4>
                    <span class="ser-gridline"> </span>
                    <p><?php echo $objConteudo['descricao_breve'] ?></p>

                </div>
                <?php
            }
            ?>
            <!--            <div class="col-md-4 ser-grid">
                                        <span class="glyphicon glyphicon-bullhorn" aria-hidden="true"></span>
                            <h4>Lorem Ipsum</h4>
                            <span class="ser-gridline"> </span>
                            <p>simplesmente uma simulação de texto da indústria tipográfica.</p>
            
                        </div>
                        <div class="col-md-4 ser-grid">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            <h4>Lorem Ipsum</h4>
                            <span class="ser-gridline"> </span>
                            <p>simplesmente uma simulação de texto da indústria tipográfica.</p>
                        </div>
                        <div class="col-md-4 ser-grid">
                            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                            <h4>Lorem Ipsum</h4>
                            <span class="ser-gridline"> </span>
                            <p>simplesmente uma simulação de texto da indústria tipográfica.</p>
                        </div>
                        <div class="col-md-4 ser-grid">
                            <span class="glyphicon glyphicon-globe" aria-hidden="true"></span>
                            <h4>Lorem Ipsum</h4>
                            <span class="ser-gridline"> </span>
                            <p>simplesmente uma simulação de texto da indústria tipográfica.</p>
                        </div>
                        <div class="col-md-4 ser-grid">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            <h4>Lorem Ipsum</h4>
                            <span class="ser-gridline"> </span>
                            <p>simplesmente uma simulação de texto da indústria tipográfica.</p>
                        </div>-->
        </div>
    </div>
</div>
<div class="clearfix"></div>
<!--services end here-->