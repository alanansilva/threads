<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);


require_once '../../models/Usuario.php';
require_once '../../models/Pessoa.php';
require_once '../../models/Perfil.php';

$data = new Usuario();
$pessoa = new Pessoa();
$perfil = new Perfil();

$link = 'app.php?app=' . $app;
?>

<script type="text/javascript">
    function editar(id, resetar_senha) {
        var email = $('#email' + id).val();

        if (resetar_senha == 1)
            if (!confirm('Deseja realmente resetar a senha do usuário?'))
                return false;

        if (email == '') {
            alert('Preencha o campo e-mail');
            email.focus();
            return false;
        }

        $('#respostaMsg').html('Alterando...');
        $.post('../../lib/php/editarUsuario.php', {
            id: id,
            resetar_senha: resetar_senha,
            email: email
        }, function (resposta) {
            $('#respostaMsg').html(resposta);
        });
    }
</script>

<script>
    $(document).ready(function () {

        /**
         * Valida a Senha
         * @param {type} form
         * @param {type} url
         * @returns {Boolean}
         */
        $.validaSenha = function (form, url) {
            var dados = $(form).serialize();
            $.ajax({
                type: "post",
                url: url,
                data: dados,
                dataType: "json",
                success: function (data) {
                    if (data.success == 1) {
                        alertify.success(data.msg);
                    } else if (data.success == 0) {
                        alertify.error(data.msg);
                        return false;
                    }
                }
            });
        }


        $('#senha').blur(function () {
            if ($(this).val() != "") {
                if (!$.validaSenha($('#formUsuario'), 'valida_senha.php')) {
                    return false;
                }
            }
        });

        $('#formUsuario').validate({
            rules: {
                nome: {
                    minlength: 2,
                    required: true
                }
            }, //end rules 
            messages: {
                nome: 'Preencha o campo Nome',
            },
            submitHandler: function (form) {
                var msg;

                if ($('input[name=acao]').val() == 1)
                    msg = 'Deseja realmente inserir um novo registro?';
                else if ($('input[name=acao]').val() == 2)
                    msg = 'Deseja realmente alterar o registro?';

                $.getMsgAjaxSubmitForm(msg, form, "<?php echo $pathApp . $app . "/persistence.php" ?>");
                return false;
            },
            highlight: function (element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },
            success: function (element) {
                element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
            }
        });

        function editar(id, resetar_senha) {
            var email = $('#email' + id).val();

            if (resetar_senha == 1)
                if (!confirm('Deseja realmente resetar a senha do usuário?'))
                    return false;

            if (email == '') {
                alert('Preencha o campo e-mail');
                email.focus();
                return false;
            }

            $('#respostaMsg').html('Alterando...');
            $.post('../../lib/php/editarUsuario.php', {
                id: id,
                resetar_senha: resetar_senha,
                email: email
            },
            function (resposta) {
                $('#respostaMsg').html(resposta);
            });
        }
    }); // end document.ready
</script>
