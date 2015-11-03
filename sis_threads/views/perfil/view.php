<?php
require_once('default.php');


$obj = $data->getPerfil();
$objPermissoes = $data->getColecaoPerfilPermissao();


//Tratando Permissões

while ($objPermissoes->Proximo()) {
    $objCombo = $objPermissoes->getItem();

    $varPermissaoText.= $objCombo['menu_descricao'];

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
    $varPermissaoText.= "<br>";
}
?>

<div id="container">

    <div id="content">
        <div class="users view">
            <dl>
                <p class='header'>Perfil</p>
                <dt>Nome</dt>
                <dd><?php echo $obj['nome'] ?>&nbsp;</dd>
                <dt>Permissões</dt>
                <dd><?php echo $varPermissaoText ?>&nbsp;</dd>
            </dl>
            <input type="button" value="Editar" class="editar" onclick="window.location = '<?php echo $link ?>/edit&acao=2&operacao=1&id=<?php echo $obj['id'] ?>'" />    
            <input type="button" name="voltar" value="Voltar" class="voltar" onclick="window.location.href = '<?php echo $link ?>/index'"/>
        </div>
    </div>
</div> 
<?php
$data->fecharConn();
?>