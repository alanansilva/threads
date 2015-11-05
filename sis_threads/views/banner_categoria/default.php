<?php
//ini_set('display_errors', 1);

require_once '../../models/BannerCategoria.php';
$data = new BannerCategoria();

$link = 'app.php?app=' . $app;
?>

<script>
    $(document).ready(function () {
        $('#form_banner_categoria').validate({
            rules: {
                nome: {
                    required: true
                }
            }, //end rules
            submitHandler: function (form) {
                var msg;

                if ($('input[name=acao]').val() == 1)
                    msg = 'Deseja realmente inserir um novo registro?'
                else if ($('input[name=acao]').val() == 2)
                    msg = 'Deseja realmente alterar o registro?'

                $.getMsgAjaxSubmitFormUpload(msg, form, "<?php echo $pathApp . $app . "/persistence.php" ?>");
                return false;
            },
            messages: {
                nome: 'Preencha o campo Nome'
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
