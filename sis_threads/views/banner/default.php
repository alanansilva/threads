<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once '../../models/Banner.php';
$data = new Banner();

require_once '../../models/BannerCategoria.php';
$bannerCategoria = new BannerCategoria();

require_once '../../models/Imagem.php';
$imagem = new Imagem();

require_once '../../lib/php/UploadFiles.php';

$link = 'app.php?app=' . $app;
?>

<script>
    $(document).ready(function () {
        $('#form_banner').validate({
            rules: {
                banner_categoria_id: {
                    required: true
                },
                nome: {
                    required: true
                },
                link: {
                    required: true
                },
                ativo: {
                    required: true
                },
                descricao: {
                    required: true
                }
            }, //end rules
             submitHandler: function(form) {
                var msg;

                if ($('input[name=acao]').val() == 1)
                    msg = 'Deseja realmente inserir um novo registro?'
                else if ($('input[name=acao]').val() == 2)
                    msg = 'Deseja realmente alterar o registro?'

                $.getMsgAjaxSubmitFormUpload(msg, form, "<?php echo $pathApp . $app . "/persistence.php" ?>");
                return false;
            },
            messages: {
                banner_categoria_id: 'Preencha o campo Banner_categoria_id',
                nome: 'Preencha o campo Nome',
                link: 'Preencha o campo Link',
                ativo: 'Preencha o campo Ativo',
                descricao: 'Preencha o campo Descricao'
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
