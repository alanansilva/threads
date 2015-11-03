<?php
require_once('default.php');
if ($_REQUEST['acao'] == 1 && $_REQUEST['operacao'] == 1) {
    ?>
    <div class="container-fluid">
        <div class="row">            
            <div class="col-md-12">                
                <h5 class="h5_tit_bor_bottom">Adicionar - Tipo de Pessoa</h5>
            </div>
        </div>
        <form id="tipo_pessoa" name="tipo_pessoa" method="post" action="<?php echo $link ?>/add">
            <input type="hidden" name="acao" value="1"/>
            <input type="hidden" name="operacao" value="2"/>
            <div class="row">
                <div class="col-md-6">
                    <label for="nome">* Nome</label>
                    <input type='text' name='nome'  id='nome' class="required form-control" placeholder="Ex.: Nome" title='Preencha o campo Nome!' >
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div style="color: red;">* obrigat&oacute;rio(s)</div>
                </div>
            </div>
            <div class="row mg-top-10">
                <div class="col-md-12">
                    <input type="submit" class="btn btn-success" name="salvar" id="salvar" value="Salvar" onClick="javascript: return enviar2(form1);"/>
                    <input type="button" name="voltar" value="Voltar" class="voltar btn btn-primary" onclick="window.location.href = '<?php echo $link ?>/index'"/>
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
if ($_REQUEST['acao'] == 1 && $_REQUEST['operacao'] == 2) {
    if ($data->add()) {
        $msgOK = 'Registro inserido com sucesso!';
    } else {
        $msgErro = 'Não foi Possível inserir o registro!';
    }
    header('location:' . $link . '/add&acao=1&operacao=1&msgOK=' . $msgOK . '&msgErro=' . $msgErro);
}
$data->fecharConn();
?>
