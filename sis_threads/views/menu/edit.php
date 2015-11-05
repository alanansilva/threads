<?php
require_once('default.php');
$obj = $data->getMenu($_REQUEST['id']);
if ($_REQUEST['acao'] == 2 && $_REQUEST['operacao'] == 1) {
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h5 class="h5_tit_bor_bottom">
                    Editar Menu
                </h5>
            </div>
        </div>
        <form id="form_menu" name="form_menu" method="post" action="<?php echo $link ?>/edit">
            <input type="hidden" name="acao" value="2"/>
            <input type="hidden" name="operacao" value="2"/>
            <input type="hidden" name="id" value="<?php echo$_REQUEST['id'] ?>"/>
            <div class="row">
                <div class="col-md-5">
                    <label for="menu_id">Menu</label>
                    <?php
                    $options = array(
                        'name' => 'menu_id_1',
                        'id' => 'menu_id_1',
                        'value' => 'id',
                        'label' => array('descricao'),
                        'selected' => array('field' => 'id', 'value' => $obj['menu_id']),
                        'class' => array('form-control', 'selectpicker'),
                        'option_default' => array('label' => '* Selecione', 'value' => null, 'use' => true),
                    );
                    echo UtilCombo::getComboCollectionOrArray($data->getComboMenu(null), $options);
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <label for="descricao">* Descrição</label>
                    <input type='text' name='descricao' id='descricao' class='required form-control' title='Preencha o campo Descricao!' value='<?php echo $obj['descricao'] ?>'>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <label for="url">Url</label>
                    <input type='text' name='url' id='url' class="form-control" value='<?php echo $obj['url'] ?>'>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <label for="posicao">* Posição</label>
                    <input type='text' name='posicao' id='posicao' class='required form-control' title='Preencha o campo Posicao!' value='<?php echo $obj['posicao'] ?>'>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div style="color: red;">* obrigat&oacute;rio(s)</div>
                </div>
            </div>
            <div class="row mg-top-10">
                <div class="col-md-12">
                    <input type="submit" name="salvar" class="btn btn-success" id="salvar" value="Salvar" onClick="javascript: return enviar2(form1);"/>
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
