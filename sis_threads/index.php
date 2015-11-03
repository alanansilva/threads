<?php

session_start();
unset($_SESSION['dados']);
define('URL_POST_FILE_REMOTE', 'http://74.63.255.164/curl/');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
    <head>
        <title>Foco Multimídia</title>
        <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
        <meta name="language" content="pt-br" />
        <meta http-equiv="imagetoolbar" content="no" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta name="globalsign-domain-verification" content="3O2Aj-wXRK2H0Y_Rw5dwGaVe79tef3aVR1QovbNDsg" />

        <!-- Início Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <!-- Fim Jquery -->

        <!-- Início COLOR BOX -->
        <link type="text/css" media="screen" rel="stylesheet" href="lib/js/colorbox-master/example1/colorbox.css" />
        <script type="text/javascript" src="lib/js/colorbox-master/jquery.colorbox.js"></script>
        <!-- Fim COLOR BOX -->

        <!-- Início estilo geral -->
        <link rel="stylesheet" type="text/css" href="lib/ext/resources/css/ext-all.css" />
        <!-- link rel="stylesheet" type="text/css" href="lib/ext/resources/css/xtheme-gray.css" /-->
        <link rel="stylesheet" type="text/css" href="css/login.css" />
        <!-- Fim estilo geral -->

        <!-- Início Bootstrap 3.0.3 -->
        <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css" />
        <script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="lib/bootstrap/js/holder.js"></script>
        <script type="text/javascript" src="lib/bootstrap/js/application.js"></script>
        <!-- Fim Bootstrap -->
    </head>
    <body id="imagemFundo">	
        <form action="lib/php/action.php?action=logar" method="post" name="my-form" id="my-form"> 
            <div id="box" class="loginBox"> 
                <div align="center" style="margin-top:15%;">
                    <div class="container">    
                        <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                            <div class="panel panel-info" style="border-color: #DDD; width: 400px;">
                                <div class="panel-heading" style="background-color: #fff; border: none; margin-top: 25px">
                                    <div class="panel-title">
                                        <img src="<?php echo URL_POST_FILE_REMOTE?>motor_reserva/images/logo.png" alt="E-Marketer 2010" /> 
                                    </div>
                                </div>

                                <div class="panel-body" style="margin-bottom: 20px;">

                                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                                    <p class="text-muted" style="text-align: left; margin-left: 35px">Digite os seus dados para acesso</p>

                                    <form id="loginform" class="form-horizontal" role="form">
                                        <!-- class="input-group" -->
                                        <div style="margin-bottom: 15px">
<!--                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>-->
                                            <input id="nome" type="text" class="form-control Field150" name="nome" value="" placeholder="Usuário" style="width: 300px;" />                                        
                                        </div>

                                        <div style="margin-bottom: 15px">
<!--                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>-->
                                            <input id="senha" type="password" class="form-control Field150" name="senha" placeholder="Senha" style="width: 300px;" />
                                        </div>

                                        <div>                                              
                                            <div class="help-block" style="color: red; text-align: right; font-size: 12px; margin-right: 35px;"> 
                                                <?php echo $_REQUEST['Erro']; ?>
                                            </div>
                                        </div>

                                        <div style="margin-top:10px; text-align: left; margin-left: 20px;" class="form-group">
                                            <div class="col-sm-12 controls">
                                                <input type="submit" name="SubmitButton" value="Entrar" class="FormButton btn btn-success" />
                                            </div>
                                        </div>
                                    </form>     

                                </div>                     
                            </div>  
                        </div>
                    </div>

                </div> 
            </div> 
        </form> 
    </body>
</html>
