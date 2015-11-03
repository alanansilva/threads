<?php
require_once 'default.php';
if ($_REQUEST['acao'] == 1 && $_REQUEST['operacao'] == 1) {
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h5 class="h5_tit_bor_bottom">
                    Adicionar - Perfis
                </h5>
            </div>
        </div>
        <form id="formPerfil" name="formPerfil" method="post" action="<?php echo $link ?>/add">
            <input type="hidden" name="acao" value="1"/>
            <input type="hidden" name="operacao" value="2"/>
            <div class="row">
                <div class="col-md-4">
                    <label for="nome">* Nome</label>
                    <input name="nome" type="text" class="form-control" maxlength="255" value="" id="nome"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="menu_pai_id">Menu</label>
                    <?php
                    $options = array(
                        'name' => 'menu_pai_id',
                        'id' => 'menu_pai_id',
                        'value' => 'id',
                        'label' => array('descricao'),
                        'class' => array('form-control'),
                        'option_default' => array('label' => '* Selecione', 'value' => null, 'use' => true),
                    );
                    echo UtilCombo::getComboCollectionOrArray($menu->getComboMenu(null), $options)
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="menu_id">Sub-menu</label>
                    <select name="menu_id" id="menu_id" class="form-control">
                        <option value="">* Selecione</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>&nbsp;</label>
                    <input type="button" value="+" style="margin: 0 0 0 -25px; padding: 6px" id='addItemPermissao' class="form-control" name='addItemPermissao'>
                    <span id='erro_pacote_1' style='color: red;'></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id='montaGrid'></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div style="color: red;">* obrigat&oacute;rio(s)</div>
                </div>
            </div>
            <div class="row mg-top-10">
                <div class="col-md-12">
                    <input type="submit" name="salvar" class="btn btn-success" value="Salvar" onClick="return enviar3(form1, document.form1.elements['permissoes[]']);"/>
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
        $msgErro = 'Não foi Possível inserir registro!';
    }

    header('location:' . $link . '/add&acao=1&operacao=1&msgOK=' . $msgOK . '&msgErro=' . $msgErro);
}

$data->fecharConn();
?>