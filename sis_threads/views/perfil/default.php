<?php
require_once '../../models/Perfil.php';
require_once '../../models/Menu.php';
require_once '../../models/Pessoa.php';
require_once 'Carrinho.php';


$data = new Perfil();
$menu = new Menu();
$pessoa = new Pessoa();
$carrinho = new Carrinho('carrinhoPerfilItem');

$link = 'app.php?app=' . $app;
?>

<script>
    $(document).ready(function() {
        $('#formPerfil').validate({
            rules: {
                nome: {
                    required: true
                }
            },
            submitHandler: function(form) {
                var msg;

                if ($('input[name=acao]').val() == 1)
                    msg = 'Deseja realmente inserir um novo registro?'
                else if ($('input[name=acao]').val() == 2)
                    msg = 'Deseja realmente alterar o registro?'

                $.getMsgAjaxSubmitForm(msg, form, "<?php echo $pathApp . $app . "/persistence.php" ?>");
                return false;
            },
            highlight: function(element) {
                $(element).closest('.control-group').removeClass('success').addClass('error');
            },
            success: function(element) {
                element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
            }
        });

        $("#addItemPermissao").click(function() {
            if ($('#menu_id').val() == '') {
                alert('Informe um menu!');
                return false;
            }

            $('#erro_pacote_1').html('');
            $('#montaGrid').html('Inserindo...');
            $.post('../../lib/php/montaGridPerfilItem.php', {
                menu_id: $('#menu_id').val(),
                acao: 'add'
            }, function(resposta) {
                $('#montaGrid').html(resposta);
            });

        });

        $("#menu_pai_id").change(function() {
            $('#menu_id').html('<option value="">Procurando...</option>');
            $.post('../../lib/php/montacombo.php', {
                menu_pai_id: $(this).val(),
                query: 1
            }, function(resposta) {
                $('#menu_id').html(resposta);
            });
        });
    });
</script>