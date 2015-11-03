<?php
require_once('../../models/Menu.php');

$data = new Menu();

$link = 'app.php?app=' . $app;

$sql = "SELECT";
$sql.= "	id ";
$sql.= ",	descricao ";
$sql.= "FROM";
$sql.= "	menu ";
$sql.= " WHERE";
$sql.= "	menu_id is NULL ";
$sql.= "ORDER BY descricao";
?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#form_menu').validate({
            rules: {
                descricao: {
                    required: true
                },
                posicao: {
                    required: true
                }
            }, //end rules 
            messages: {
                descricao: 'Preencha o campo Descrição',
                posicao: 'Preencha o campo Posição',
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
    });
</script>
