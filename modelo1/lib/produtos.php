<!-- produtos -->
<link rel="stylesheet" href="js/colorbox/colorbox.css">
<script type="text/javascript" src="js/colorbox/jquery.colorbox-min.js"></script>

<div id="produtos" class="mod_cat">
    <div class="container">
        <div class="title_cat">
            <h3>PRODUTOS</h3>
        </div>
        <div class="clearfix"></div>

        <style>
            /*---portfolio-section-------*/
            .port-section {
                padding: 1.5em 0 4em 0;
                position:relative;
            }
            .port-section  h2{
                position: absolute;
                left: 13.3%;
                top: -3%;
                background: #fff;
                padding: 0.3em 0.3em;
                font-size: 1.34em;
                font-weight: 700;
            }
            .port-grid {
                background: #eee;
                width: 24.2%;
                float: left;
                margin-right: 1.0%;
                margin-bottom: 10px;
                padding: 1em 1em;
                position: relative;
                -webkit-transition: all 600ms ease;
                -moz-transition: all 600ms ease;
                -ms-transition: all 600ms ease;
                -o-transition: all 600ms ease;
                transition: all 600ms ease;
            }
            .port-grid.lost{
                margin-right:0%;
            }
            .port-grid:hover   {
                background:#03BEF0;
                -webkit-transition: all 600ms ease;
                -moz-transition: all 600ms ease;
                -ms-transition: all 600ms ease;
                -o-transition: all 600ms ease;
                transition: all 600ms ease;
            }
            .box_type {
                background: #03BEF0;
                padding: 5px 21px;
                /*position: absolute;*/
                bottom: 146px;
                color: #fff;
                left: 14px;
                font-size: 0.85em;
            }
            .box-hover {
                position: absolute;
                bottom: 141px;
                right: 13px;
            }
            ul.port-icons li {
                list-style: none;
                display: inline-block;
            }
            ul.port-icons  li  i.per{
                width: 27px;
                height: 27px;
                display: inline-block;
                background: url("../images/s-icons.png")-243px -83px no-repeat #03BEF0;
            }
            ul.port-icons  li  i.loca{
                width: 27px;
                height: 27px;display:inline-block;
                background:url("../images/s-icons.png")-277px -83px no-repeat #03BEF0;
            }
            .text a h3{
                font-size: 1.2em;
                font-weight: 600;
                text-transform: uppercase;
                margin-top: 1em;
                padding: 0em 0 0 0;
            }
            .text a:hover{
                text-decoration: none;
            }
            .text p{
                font-size:0.95em;
                color:#999;
                line-height:1.8em;
                margin:0.5em 0;
            }
            .port-grid .port-grid-price{
                color: #C00;
                font-size: 14px;
            }
            .port-grid .port-grid-price-sub{
                color: #000;
                font-weight: 700;
                font-size: 10px;
            }
            .port-grid :hover  .text ,.port-grid.lost:hover .text,.port-grid.lost:hover .text h3,.port-grid:hover .text h3, .port-grid :hover .port-grid-price, .port-grid :hover .port-grid-price-sub{
                color:#fff;
            }
            .port-grid:hover .text p {
                color: #fff;
            }
            /*----mid-section----*/
            .bottom-section {
                padding: 4em 0;
                border-top: double #ddd;
                border-bottom: double #ddd;
            }
            .bottom-top {
                background: #eee;
                padding: 3em 1em;
                border: 1px solid #ddd;
                border-left:5px solid #03BEF0;
            }
            .bottom-text  h3 {
                text-transform: uppercase;
                font-size: 1.15em;
                font-weight: 600;
                margin-bottom: 0.7em;
            }
            .bottom-text p {
                color: #999;
                font-size: 0.95em;
            }
            .bottom-text{
                float:left;
            }
            .stories {
                position: relative;
                display: inline;
            }
            .stories span {
                position: absolute;
                width: 185px;
                background: #03BEF0;
                display: block;
                line-height: 1em;
                text-transform: uppercase;
                height: 130px;
                top: -42px;
                padding: 2.5em 1em 1em 6em;
            }
            .stories span:before {
                content: '';
                position: absolute;
                top: 14%;
                left: -11%;
                width: 0;
                height: 0;
                border-right: 132px solid #eee;
                border-top: 94px solid transparent;
                transform: rotate(-269deg);
                -webkit-transform: rotate(-269deg);
                -o-transform: rotate(-269deg);
                -moz-transform: rotate(-269deg);

            }
        </style>

        <!--/port-section-->
        <div id="features" class="port-section">
            <div class="container">
                <div class="port-grids">
                    <?php
                         $path = URL_POST_FILE_REMOTE;
                    $objColConteudo = $conteudo->getColecaoConteudo(null, 1);
                    while ($objColConteudo->proximo()) {
                        $objConteudo = $objColConteudo->getItem();
                        ?>
                        <script>
                            $(document).ready(function () {
                                $(".inline_html_prod_<?php echo $objConteudo['id'] ?>").colorbox({inline: true, width: "600"});
                            });
                        </script>

                           <?php
                    $objColImagem = $imagem->getColecaoImagem(7, $objConteudo['id']);
                    while ($objColImagem->proximo()) {
                        $objImagem = $objColImagem->getItem();
                        ?>
                        <div class="col-md-3 col-sm-4 col-xs-6 port-grid wow zoomInLeft animated">
                            <a class="inline_html_prod_<?php echo $objConteudo['id'] ?>" href="#inline_content_prod_<?php echo $objConteudo['id'] ?>">
                                <img src="<?php echo $path . $objImagem['nome_img']?>" class="img-responsive" alt="" />
                            </a>
                            <div class="text">
                                <a class="inline_html_prod_<?php echo $objConteudo['id'] ?>" href="#inline_content_prod_<?php echo $objConteudo['id'] ?>">
                                    <h3><?php echo $objConteudo['titulo'] ?></h3>
                                </a>
                                <div class="port-grid-price">R$ <?php echo $objConteudo['valor'] ?></div>
                                <!--<div class="port-grid-price-sub">8X R$ 10,75</div>-->
                                <p><?php echo $objConteudo['descricao_breve'] ?></p>
                            </div>
                        </div>

                        <div style='display:none'>
                            <div id='inline_content_prod_<?php echo $objConteudo['id'] ?>' style='padding:10px; background:#fff;'>
                                <img src="<?php echo $path . $objImagem['nome_img']?>" class="img-responsive" alt="" width="100%" />
                                <div class="text">
                                    <h2><?php echo $objConteudo['titulo'] ?></h2>
                                    <div>
                                        <strong style="font-size: 18px">R$ <?php echo $objConteudo['valor'] ?></strong>
                                        <!--<span>8X R$ 10,75</span>-->
                                    </div>
                                    <p><?php echo $objConteudo['descricao'] ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    }
                    ?>
                    <!--div class="col-md-3 col-sm-4 col-xs-6 port-grid wow zoomInLeft animated">
                        <a class="inline" href="#inline_content"><img src="images/p1.jpg" class="img-responsive" alt="" /></a>
                        <div class="text">
                            <a class="inline" href="#inline_content"><h3>I am an amazing project</h3></a>
                            <div class="port-grid-price">R$86,00</div>
                            <div class="port-grid-price-sub">8X R$ 10,75</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis nulla amet. turpis. </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-6 port-grid wow zoomInLeft animated" >
                        <a class="inline" href="#inline_content"><img src="images/p2.jpg" class="img-responsive" alt="" /></a>
                        <div class="text">
                            <a class="inline" href="#inline_content"><h3>I am an amazing project</h3></a>
                            <div class="port-grid-price">R$86,00</div>
                            <div class="port-grid-price-sub">8X R$ 10,75</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis nulla amet. turpis. </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-6 port-grid wow zoomInRight animated">
                        <a class="inline" href="#inline_content"><img src="images/p3.jpg" class="img-responsive" alt="" /></a>
                        <div class="text">
                            <a class="inline" href="#inline_content"><h3>I am an amazing project</h3></a>
                            <div class="port-grid-price">R$86,00</div>
                            <div class="port-grid-price-sub">8X R$ 10,75</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis nulla amet. turpis. </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-6 port-grid lost wow zoomInRight animated">
                        <a class="inline" href="#inline_content"><img src="images/p4.jpg" class="img-responsive" alt="" /></a>
                        <div class="text">
                            <a class="inline" href="#inline_content"><h3>I am an amazing project</h3></a>
                            <div class="port-grid-price">R$86,00</div>
                            <div class="port-grid-price-sub">8X R$ 10,75</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis nulla amet. turpis. </p>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-xs-6 port-grid wow zoomInLeft animated">
                        <a class="inline" href="#inline_content"><img src="images/p1.jpg" class="img-responsive" alt="" /></a>
                        <div class="text">
                            <a class="inline" href="#inline_content"><h3>I am an amazing project</h3></a>
                            <div class="port-grid-price">R$86,00</div>
                            <div class="port-grid-price-sub">8X R$ 10,75</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis nulla amet. turpis. </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-6 port-grid wow zoomInLeft animated" >
                        <a class="inline" href="#inline_content"><img src="images/p2.jpg" class="img-responsive" alt="" /></a>
                        <div class="text">
                            <a class="inline" href="#inline_content"><h3>I am an amazing project</h3></a>
                            <div class="port-grid-price">R$86,00</div>
                            <div class="port-grid-price-sub">8X R$ 10,75</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis nulla amet. turpis. </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-6 port-grid wow zoomInRight animated">
                        <a class="inline" href="#inline_content"><img src="images/p3.jpg" class="img-responsive" alt="" /></a>
                        <div class="text">
                            <a class="inline" href="#inline_content"><h3>I am an amazing project</h3></a>
                            <div class="port-grid-price">R$86,00</div>
                            <div class="port-grid-price-sub">8X R$ 10,75</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis nulla amet. turpis. </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-6 port-grid lost wow zoomInRight animated">
                        <a class="inline" href="#inline_content"><img src="images/p4.jpg" class="img-responsive" alt="" /></a>
                        <div class="text">
                            <a class="inline" href="#inline_content"><h3>I am an amazing project</h3></a>
                            <div class="port-grid-price">R$86,00</div>
                            <div class="port-grid-price-sub">8X R$ 10,75</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis nulla amet. turpis. </p>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-4 col-xs-6 port-grid wow zoomInLeft animated">
                        <a class="inline" href="#inline_content"><img src="images/p1.jpg" class="img-responsive" alt="" /></a>
                        <div class="text">
                            <a href="portfolio.html"><h3>I am an amazing project</h3></a>
                            <div class="port-grid-price">R$86,00</div>
                            <div class="port-grid-price-sub">8X R$ 10,75</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis nulla amet. turpis. </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-6 port-grid wow zoomInLeft animated" >
                        <a class="inline" href="#inline_content"><img src="images/p2.jpg" class="img-responsive" alt="" /></a>
                        <div class="text">
                            <a href="portfolio.html"><h3>I am an amazing project</h3></a>
                            <div class="port-grid-price">R$86,00</div>
                            <div class="port-grid-price-sub">8X R$ 10,75</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis nulla amet. turpis. </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-6 port-grid wow zoomInRight animated">
                        <a class="inline" href="#inline_content"><img src="images/p3.jpg" class="img-responsive" alt="" /></a>
                        <div class="text">
                            <a class="inline" href="#inline_content"><h3>I am an amazing project</h3></a>
                            <div class="port-grid-price">R$86,00</div>
                            <div class="port-grid-price-sub">8X R$ 10,75</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis nulla amet. turpis. </p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-xs-6 port-grid lost wow zoomInRight animated">
                        <a class="inline" href="#inline_content"><img src="images/p4.jpg" class="img-responsive" alt="" /></a>
                        <div class="text">
                            <a class="inline" href="#inline_content"><h3>I am an amazing project</h3></a>
                            <div class="port-grid-price">R$86,00</div>
                            <div class="port-grid-price-sub">8X R$ 10,75</div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque quis nulla amet. turpis. </p>
                        </div>
                    </div-->
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<!-- //produtos -->