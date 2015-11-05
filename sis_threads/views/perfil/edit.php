<?php
require_once 'default.php';

if ($_REQUEST['acao'] == 2 && $_REQUEST['operacao'] == 1) {

    $obj = $data->getPerfil($_REQUEST['id']);
    $objPermissoes = $data->getColecaoPerfilPermissao();
    $nomeIndiceArraySessao = array(
        'menu_id'
    );
    $carrinho->editCarrinho($objPermissoes, $nomeIndiceArraySessao);
    ?>
    <script type="text/javascript">
        $.post('../../lib/php/montaGridPerfilItem.php',
                {},
                function (resposta) {
                    $('#montaGrid').html(resposta);
                }
        );
    </script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h5 class="h5_tit_bor_bottom">
                    Editar - Perfis
                </h5>
            </div>
        </div>
        <form id="formPerfil" name="formPerfil" method="post" action="<?php echo $link ?>/edit">
            <input type="hidden" name="acao" value="2"/>
            <input type="hidden" name="operacao" value="2"/>
            <input type="hidden" name="id" value="<?php echo $obj['id'] ?>"/>
            <div class="row">
                <div class="col-md-4">
                    <label for="nome">* Nome</label>
                    <input name="nome" type="text" maxlength="255" class="form-control" id="nome" validationmsg='Preencha o campo Nome!' value="<?php echo $obj['nome'] ?>"/>
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
                    <select name="menu_id" id="menu_id" class="form-control" >
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
    //Tratando Permissões
    while ($objPermissoes->Proximo()) {
        $objCombo = $objPermissoes->getItem();

        $varPermissaoValue = $objCombo['menu_id'] . "#" . $objCombo['acao_inserir'] . "#" . $objCombo['acao_alterar'] . "#" . $objCombo['acao_excluir'];
        $varPermissaoText = $objCombo['menu_descricao'];

        if ($objCombo['acao_inserir'] == 1 || $objCombo['acao_alterar'] == 1 || $objCombo['acao_excluir'] == 1) {
            $varPermissaoText.= ":";

            if ($objCombo['acao_inserir'] == 1) {
                $varPermissaoText.= " Inserir";
            }
            if ($objCombo['acao_alterar'] == 1 && $objCombo['acao_inserir'] == 0) {
                $varPermissaoText.= " Alterar";
            } elseif ($objCombo['acao_alterar'] == 1) {
                $varPermissaoText.= " | Alterar";
            }
            if ($objCombo['acao_excluir'] == 1 && $objCombo['acao_alterar'] == 0 && $objCombo['acao_inserir'] == 0) {
                $varPermissaoText.= " Excluir";
            } elseif ($objCombo['acao_excluir'] == 1) {
                $varPermissaoText.= " | Excluir";
            }
        }

        //Montando combo de Permissões
        if ($varPermissaoValue != "" && $varPermissaoText != "") {
            ?>
            <script language="javascript">
                InsereElemento(document.form1.elements['permissoes[]'], '<?php echo $varPermissaoValue ?>', '<?php echo $varPermissaoText ?>');
            </script>
            <?php
        }
    }


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
        $msgErro = 'Não foi possível alterar o registro!';
    }

    header('location:' . $link . '/edit&acao=2&operacao=1&id=' . $_REQUEST['id'] . '&msgOK=' . $msgOK . '&msgErro=' . $msgErro);
}

$data->fecharConn();
?>