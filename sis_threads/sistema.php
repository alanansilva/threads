<?php
session_start();
require_once 'lib/php/session.php';
require_once 'lib/php/menu.php';
$url = "http://curl.threads.com.br/";
define('URL_POST_FILE_REMOTE', $url);
?>
<html>
    <head>
        <meta http-equiv="Content-Language" content="pt_br" />
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

        <title>..:: THREADS ::.</title>

        <link rel="stylesheet" type="text/css" href="lib/ext/resources/css/ext-all.css" />
        <!--	<link type="text/css" rel="stylesheet" media="screen, print" href="lib/ext/resources/css/xtheme-gray.css" />-->
        <link type="text/css" rel="stylesheet" media="screen, print" href="css/main.css" />

        <!-- Início Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <!-- Fim Jquery -->

        <script type="text/javascript" src="lib/ext/adapter/ext/ext-base.js"></script>
        <script type="text/javascript" src="lib/ext/ext-all.js"></script>
        <script type="text/javascript" src="lib/ext/Ext.ux.TabCloseMenu.js"></script>

        <!-- Bootstrap 3.0.3 -->
        <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css" />
        <script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="lib/bootstrap/js/holder.js"></script>
        <script type="text/javascript" src="lib/bootstrap/js/application.js"></script>
        <!-- Fim Bootstrap -->

        <script type="text/javascript">
            Ext.BLANK_IMAGE_URL = 'lib/ext/resources/images/default/s.gif';
            Ext.onReady(function () {

                Ext.state.Manager.setProvider(new Ext.state.CookieProvider());

                var accordion = new Ext.Panel({
                    region: 'west',
                    id: 'west-panel',
                    title: 'Menu',
                    split: true,
                    width: 220,
                    minSize: 190,
                    maxSize: 250,
                    collapsible: true,
                    autoScroll: true,
                    margins: '0 0 5 5',
                    layout: 'accordion',
                    layoutConfig: {
                        animate: false
                    }
                });

                    <?php
                    //			print_r($categorias);
                    foreach ($categorias as $categoria) {
                        echo "accordion.add({title: '" . $categoria['descricao'] . "', contentEl: '" . $categoria['descricao'] . "', border: false, autoScroll:true, iconCls: '" . $categoria['iconCls'] . "'});";
                    }
                    ?>

                                    var topo = new Ext.BoxComponent({
                                        region: 'north',
                                        el: 'north',
                                        height: 75
                                    });

                                    var tabCentral = new Ext.TabPanel({
                                        region: 'center',
                                        deferredRender: false,
                                        resizeTabs: true,
                                        activeTab: 0,
                                        minTabWidth: 115,
                                        margins: '0 5 5 0',
                                        tabWidth: 170,
                                        enableTabScroll: true,
                                        items: [{
                                                contentEl: 'center',
                                                title: 'Principal',
                                                autoScroll: true
                                            }],
                                        defaults: {
                                            autoScroll: true
                                        },
                                        plugins: new Ext.ux.TabCloseMenu()
                                    })

                                    var viewport = new Ext.Viewport({
                                        layout: 'border',
                                        items: [topo, accordion, tabCentral]
                                    });

                                    newTab = function (id, title, href) {
                                        if (Ext.get('tab' + title)) {
                                            tabCentral.activate('tab' + title);
                                        } else {
                                            var tab = tabCentral.add({
                                                title: title,
                                                id: 'tab' + title,
                                                html: "<iframe name='direita' id='div" + title + "' src='" + href + "' frameborder='0' style='width:100%;height:100%'></iframe>",
                                                closable: true
                                            });
                                            tab.show();
                                        }
                                    }

                    <?php
                    foreach ($categorias as $categoria) {
                        foreach ($categoria['itens'] as $item) {
                            if (!isset($_SESSION['menu'][$item['url']]['menu_id'])) {
                                $_SESSION['menu'][$item['url']]['menu_id'] = $item['id'];
                            }
                            ?>
                                            Ext.get('<?php echo $item['descricao'] ?>').on('click', function () {
                                                newTab('<?php echo $item['id'] ?>', this.id, 'lib/php/app.php?app=<?php echo $item['url'] ?>&menu_id=<?php echo $item['id'] ?>');
                                            });
                            <?php
                        }
                    }
                    ?>
            });

            function logout() {
                if (confirm('Deseja realmente sair do sistema?')) {
                    window.location.href = 'lib/php/logout.php';
                } else {
                    return false;
                }
                ;
            }
        </script>
        <style type="text/css">
            #mask {
                position:absolute;
                left:0;
                top:0;
                z-index:9000;
                background-color:#000;
                display:none;
            }

            #boxes .window {
                position:absolute;
                left:0;
                top:0;
                display:none;
                z-index:9999;
            }

            .close{display:block; text-align:right;}

            #alterar_senha{
                display: inline-block;
                margin-bottom: 0;
                font-size: 14px;
                font-weight: normal;
                line-height: 1.428571429;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                cursor: pointer;
                background-image: none;
                border: 1px solid transparent;
                border-radius: 4px;
                background: #337ab7;
                color: #fff;
                font-size: 11px;
                padding: 3px 12px;
            }
            #alterar_senha:hover{
                text-decoration: none;
            }
        </style>        
    </head>
    <body>
        <div id="north">
            <div style='float:right; font-size:12px; font-weight:bold; padding: 7px; padding-top:10px;'>
                <div style='font-weight:normal; color:#5B5B5B; display:inline;'>Usuário: </div> 
                <strong style="color:#5B5B5B;"><?php echo $_SESSION['dados']['usuario']['nome'] ?></strong>
                <div style='font-weight:normal; color:#5B5B5B; display:inline;'>| Perfil: </div> 
                <strong style="color:#5B5B5B;"><?php echo $_SESSION['dados']['pessoa']['perfil'] ?></strong> 
                <a href="#" onClick="return logout();" class="btn btn-danger" title="" style="font-size:11px; padding: 3px 12px;">
                    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    Sair
                </a>
            </div>
            <div style='width: 200px; display:inline-block; padding:10px 0 0 15px; margin:0'>
                <!--<img src="<?php echo URL_POST_FILE_REMOTE ?>motor_reserva/images/logo_foco.png" alt="Foco Multimídia">-->
            </div>
            <div class="clear"></div>
            <div style="float:right; padding: 7px; margin-top:-30px; text-align:right">

                <!--Modal-->
                <div id="dialog" class="window"></div>
                <div id="mask"></div>
                <!--Modal-->
            </div>
        </div>
        <div id="center">
            <div id="start-div">
                <div style="float:left;">
                    <!-- <img src="images/logo.png" style='width: 50%;'/> -->
                </div>
            </div>
        </div>

        <div id='itensMenu'>
            <?php foreach ($categorias as $categoria): ?>
                <div id='<?php echo $categoria['descricao'] ?>'>
                    <?php foreach ($categoria['itens'] as $item): ?>
                        <div id='<?php echo $item['descricao'] ?>'>
                            <div id="linkMenu">
                                <span class="linkMenu_icon"></span>
                                <span><?php echo $item['descricao'] ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>   
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Início COLOR BOX -->
        <link type="text/css" media="screen" rel="stylesheet" href="lib/js/colorbox-master/example1/colorbox.css" />
        <script type="text/javascript" src="lib/js/colorbox-master/jquery.colorbox.js"></script>
        <!-- Fim COLOR BOX -->
    </body>
</html>
