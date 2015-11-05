<?php
//ini_set('display_errors', 1);

require_once '../../models/ConteudoCategoria.php';
$data = new ConteudoCategoria();

$link = 'app.php?app=' . $app;
?>

<script>
    $(document).ready(function () {
        $('#form_conteudo_categoria').validate({
            rules: {
                nome: {
                    minlength: 2,
                    required: true
                }
            }, //end rules 
            messages: {
                nome: 'Preencha o campo Nome'
            },
            submitHandler: function (form) {
                var msg;

                if ($('input[name=acao]').val() == 1)
                    msg = 'Deseja realmente inserir um novo registro?'
                else if ($('input[name=acao]').val() == 2)
                    msg = 'Deseja realmente alterar o registro?'

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
    }); // end document.ready
</script>
