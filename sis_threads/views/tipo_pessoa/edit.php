<?php
require_once('default.php');
$obj = $data->getTipoPessoa($_REQUEST['id']);
if ($_REQUEST['acao'] == 2 && $_REQUEST['operacao'] == 1) {
    ?>
    <div class="container-fluid">
        <div class="row">            
            <div class="col-md-12">                
                <h5 class="h5_tit_bor_bottom">Editar - Tipo de Pessoa</h5>
            </div>
        </div>
        <form id="tipo_pessoa" name="tipo_pessoa" method="post" action="<?php echo $link ?>/edit">
            <input type="hidden" name="acao" value="2"/>
            <input type="hidden" name="operacao" value="2"/>
            <input type="hidden" name="id" value="<?php echo$_REQUEST['id'] ?>"/>
            <div class="row">
                <div class="col-md-6">
                    <label for="nome">* Nome</label>
                    <input type='text' name='nome' id='nome' class="required form-control" title='Preencha o campo Nome!' value='<?php echo $obj['nome'] ?>'>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div style="color: red;">* obrigat&oacute;rio(s)</div>
                </div>
            </div>
            <div class="row mg-top-10">
                <div class="col-md-12">
                    <input type="submit" name="salvar" class="btn btn-primary" id="salvar" value="Salvar" onClick="javascript: return enviar2(form1);"/>
                    <input type="button" name="voltar" value="Voltar" class="voltar btn btn-success" onclick="window.location.href = '<?php echo $link ?>/index'"/>
                </div>
            </div>
        </form>
    </div>
    <?php
    if ($_REQUEST['msgErro'] != "") {
        echo '<div class="message">' . $_REQUEST['msgErro'] . '</div>';
    } elseif ($_REQUEST['msgOK'] != "") {
        echo '<div class="message">' . $_REQUEST['msgOK'] . '</div>';
    }
}
if ($_REQUEST['acao'] == 2 && $_REQUEST['operacao'] == 2) {
    if ($data->edit()) {
        $msgOK = 'Registro atualizado com sucesso!';
    } else {
        $msgErro = 'Não foi Possível alterar o registro!';
    }
    header('location:' . $link . '/edit&acao=2&operacao=1&id=' . $_REQUEST["id"] . '&msgOK=' . $msgOK . '&msgErro=' . $msgErro);
}
$data->fecharConn();
?>
