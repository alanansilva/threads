<?php
//ini_set('display_errors', 1);
require_once 'default.php';
require_once 'models/usuario.php';

$data = new Usuario();

$link = "alterar_senha.php";

if ($_REQUEST['acao'] == 2 && $_REQUEST['operacao'] == 1) {
    ?>
    <script>
        $(document).ready(function() {

            /**
             * Valida a Senha
             * @param {type} form
             * @param {type} url
             * @returns {Boolean}
             */
            $.validaSenha = function(form, url) {
                var dados = $('#nova_senha').val();
                $.ajax({
                    type: "post",
                    url: url,
                    data: {
                        senha: $('#nova_senha').val()
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.success == 1) {
                            alertify.success(data.msg);
                        } else if (data.success == 0) {
                            $('#nova_senha').val(null);
                            alertify.error(data.msg);
                            return false;
                        }
                    }
                });
            }

            $('#nova_senha').blur(function() {
                if ($(this).val() != "") {
                    if (!$.validaSenha($('#form1'), 'lib/php/valida_senha.php')) {
                        return false;
                    }
                }
            });


            $("#form1").submit(function() {
                if ($("#nova_senha").val() != $("#nova_senha2").val()) {
                    alert('Senhas digitadas não conferem!');
                    return false;
                }

                if ($(this).val() != "") {
                    if (!$.validaSenha($('#form1'), 'lib/php/valida_senha.php')) {
                        return false;
                    }
                }
            });
        });
    </script>
    <style>

    </style>
    <div class="container" style="width: 100%">
        <div id="content">
            <div class="row">
                <div class="col-md-12">
                    <h3 class='tituloForm'>Alterar Senha</h3>
                </div>
            </div>
            <form id="form1" name="form1" method="post" action="<?php echo $link ?>">
                <input type="hidden" name="acao" value="2"/>
                <input type="hidden" name="operacao" value="2"/>
                <input type="hidden" name="primeiro_acesso" value="<?php echo $_REQUEST['primeiro_acesso'] ?>"/>
                <div  class="formulario">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <label for="login">* Login</label>
                            <input type='text' name='login'  id='login' class='required form-control' title='Preencha o campo Login!'>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <label for="senha">* Senha</label>
                            <input type='password' name='senha'  id='senha' class='required form-control' title='Preencha o campo Senha!'>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <label for="nova_senha">* Nova Senha</label>
                            <input type='password' name='nova_senha'  id='nova_senha' class='required form-control' title='Preencha o campo Nova Senha!'>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <label for="nova_senha2">* Confirma Senha</label>
                            <input type='password' name='nova_senha2'  id='nova_senha2' class='required form-control' title='Preencha o campo Confirma Senha!'>
                        </div>
                    </div>
                    <!--                    <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <span style="text-align: center;color: red; margin: 15px 0">* obrigat&oacute;rio(s)</span>
                                            </div>
                    </div>--><br>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="submit" name="salvar" id="salvar" class="btn btn-success" value="Salvar" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    if ($_REQUEST['msgErro'] != "")
        echo '<div class="message">' . $_REQUEST['msgErro'] . '</div>';
    elseif ($_REQUEST['msgOK'] != "")
        echo '<div class="message">' . $_REQUEST['msgOK'] . '</div>';
}
if ($_REQUEST['acao'] == 2 && $_REQUEST['operacao'] == 2) {
    if ($data->setAlterarSenhaUsuario())
        $msgOK = 'Senha atualizada com sucesso!';
    else
        $msgErro = 'Não foi possível alterar a senha, usuário ou senha incorretos!';

    if (!empty($_REQUEST['primeiro_acesso'])) {
        header('location:index.jsp?acao=2&operacao=1&msgOK=' . $msgOK . '&msgErro=' . $msgErro);
    } else {
        header('location:' . $link . '?acao=2&operacao=1&msgOK=' . $msgOK . '&msgErro=' . $msgErro);
    }
}
?>
