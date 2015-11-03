<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$objPessoa = $pessoa->getPessoa();
?>
<div id="contato" class="mod_cat">
    <div class="container">
        <div class="get-info text-center">
            <h3>CONTATO</h3>
            <h4><i>Não hesite em contactar-nos</i></h4>
            <p>Lorem ipsum dolor amet, libero turpis non cras ligula, id commodo, aenean est in volutpat amet sodales, porttitor bibendum facilisi suspendisse</p>
        </div>
    </div>
    <div class="map">
        <iframe src="<?php echo $objPessoa['mapa_localizacao'] ?> " width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</div>

<div class="contact-us">
    <div class="container">
        <div class="contact-grids">
            <div class="col-md-4 contact-grid text-center">
                <div class="point-icon"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></div>
                <p><?php echo $objPessoa['endereco'] ?></p>
            </div>
            <div class="col-md-4 contact-grid text-center">
                <div class="point-icon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></div>
                <p><a href="mailto:info@example.com"><?php echo $objPessoa['email'] ?></a></p>
            </div>
            <div class="col-md-4 contact-grid text-center">
                <div class="point-icon"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></div>
                <p><?php echo $objPessoa['telefone'] ?></p>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="contact-info">
             <span id="msg_enviar_email"></span>
            <form role="form" id="enviar_email" name="enviar_email" action="javascript:void(0)">
                <!--<input type="text" placeholder="Seu nome" required>-->
                <input type="text"  name="nome_enviar_email" id="nome_enviar_email" placeholder="Insira aqui o seu nome">
                <input type="text"  name="email_enviar_email" id="email_enviar_email" placeholder="Insira aqui o seu email">
                <!--<input type="text" placeholder="Seu e-mail" required>-->
                <!--<input type="text" placeholder="Assunto" required>-->
                <input type="text"  name="assunto_enviar_email" id="assunto_enviar_email" placeholder="Assunto">
                <textarea placeholder="Sua mensagem" name="mensagem_enviar_email" id="mensagem_enviar_email" required></textarea>
                <input type="submit" value="Enviar mensagem">
            </form>
              <div id="resp_email_capa"></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
//        $('#enviar_email').validate({
//            rules: {
//                nome_enviar_email: {
//                    minlength: 2,
//                    required: true
//                },
//                email_enviar_email: {
//                    minlength: 2,
//                    required: true
//                },
//                asssunto_enviar_email: {
//                    required: true
//                }
//            }, //end rules 
//            messages: {
//                nome_enviar_email: 'Preencha o campo Nome',
//                email_enviar_email: 'Preencha o campo E-mail',
//                assunto_enviar_email: 'Preencha o campo Telefone'
//            },
//            submitHandler: function (form) {
//                $.post("lib/enviar_email.php", $('#enviar_email').serialize()).done(function (data) {
//                    $("#msg_enviar_email").html(data);
//                });
//                return false;
//            },
//            highlight: function (element) {
//                $(element).closest('.control-group').removeClass('success').addClass('error');
//            },
//            success: function (element) {
//                element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
//            }
//        });
        
      $('#enviar_email').validate({
         rules: {
                nome_enviar_email: {
                    minlength: 2,
                    required: true
                },
                email_enviar_email: {
                    minlength: 2,
                    required: true
                },
                asssunto_enviar_email: {
                    required: true
                }
            }, //end rules 
       messages: {
                nome_enviar_email: 'Preencha o campo Nome',
                email_enviar_email: 'Preencha o campo E-mail',
                assunto_enviar_email: 'Preencha o campo Telefone'
            },
        submitHandler: function () {
            var data;
            data = $('#enviar_email').serialize();
            $.ajax({
                url: "lib/enviar_email.php",
                type: "post",
                data: data,
                beforeSend: function () {
                    $("#resp_email_capa").html('Enviando...');
                },
                success: function (resposta) {
                    $("#resp_email_capa").html(resposta);
                    setTimeout(function () {
                        $("#resp_email_capa").hide();
                    }, 1500)
                }
            });
        }
    });
        
    });
</script>
<!-- //contato -->
