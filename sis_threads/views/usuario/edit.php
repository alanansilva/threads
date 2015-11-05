<?php
require_once'default.php';
$obj = $data->getUsuario($_REQUEST['id']);

if ($_REQUEST['acao'] == 2 && $_REQUEST['operacao'] == 1) {
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h5 class="h5_tit_bor_bottom">
                    Editar - Usuário(s)
                </h5>
            </div>
        </div>
        <form id="formUsuario" name="formUsuario" method="post" action="<?php echo $link ?>/edit">
            <input type="hidden" name="acao" value="2"/>
            <input type="hidden" name="operacao" value="2"/>
            <input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ?>"/>
            <div class="row">
                <div class="col-md-6">
                    <label for="pessoa_id">* Pessoa</label>
                    <?php
                    $options = array(
                        'name' => 'pessoa_id',
                        'id' => 'pessoa_id',
                        'value' => 'id',
                        'label' => array('nome'),
                        'selected' => array('field' => 'id', 'value' => $obj['pessoa_id']),
                        'multiple' => false,
                        'option_default' => array('label' => '* Selecione', 'value' => null),
                        'class' => array('form-control'),
                    );
                    $objColPessoa = $pessoa->getColecaoPessoa(null, null, $_SESSION['dados']['usuario']['rede_id']);
                    echo UtilCombo::getComboCollectionOrArray($objColPessoa, $options);
                    ?>
                </div>
                <div class="col-md-6">
                    <label for="perfil_id">* Perfil</label>
                    <?php
                    $options = array(
                        'name' => 'perfil_id',
                        'id' => 'perfil_id',
                        'value' => 'id',
                        'label' => array('nome'),
                        'class' => array('selectpicker', 'form-control'),
                        'selected' => array('field' => 'id', 'value' => $obj['perfil_id']),
                        'option_default' => array('label' => '* Selecione', 'value' => null, 'use' => true),
                        'other_attribute' => array('data-live-search' => 'true'),
                    );
                    echo UtilCombo::getComboCollectionOrArray($perfil->getColecaoPerfil($_SESSION['dados']['pessoa']['id']), $options)
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="nome">* Nome</label>
                    <input type='text' name='nome' id='nome' class='required form-control' title='Preencha o campo Nome!' value='<?php echo $obj['nome'] ?>'>
                </div>
                <div class="col-md-6">
                    <label for="email">* E-mail</label>
                    <input type='text' name='email'  id='email' class='required form-control' title='Preencha o campo E-mail!' value='<?php echo $obj['email'] ?>'>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="login">* Login</label>
                    <input type='text' name='login'  id='login' class='required form-control' title='Preencha o campo Login!' value='<?php echo $obj['login'] ?>'>
                </div>
                <div class="col-md-6">
                    <label for="senha">Senha</label>
                    <input type='password' name='senha'  id='senha' value=''  class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 skin-minimal">
                    <label for="ativo">* Ativo</label>
                    <input type="radio" name="ativo" value="1" <?php if ($obj['ativo'] == 1) { ?> checked <?php } ?> />Sim
                    <input type="radio" name="ativo" value="0" <?php if ($obj['ativo'] == 0) { ?>checked<?php } ?> />Não
                </div>
            </div>
            <?php
            if ($_SESSION['dados']['pessoa']['perfil_id'] == 1) {
                if ($obj['perfil_id'] == 40) {
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            unset($objUsuarioWebservice);

                            echo '<label for="webservice_id">Web Service</label>';
                            $objUsuarioWebservice = $usuarioWebservice->getUsuarioWebservice($obj['id']);
                            $options = array(
                                'name' => 'webservice_id',
                                'id' => 'webservice_id',
                                'value' => 'webservice_id',
                                'label' => array('nome'),
                                'option_default' => array('label' => '* Selecione', 'value' => null, 'use' => true),
                                'selected' => array('field' => 'webservice_id', 'value' => $objUsuarioWebservice['webservice_id']),
                                'javascript' => array(
                                    'onchange' => array('javascript: return editar(' . $obj['id'] . ',2)'),
                                ),
                                'class' => array('form-control'),
                            );
                            echo '<td>' . UtilCombo::getComboCollectionOrArray($objColCanalWebservice, $options) . '</td>';
                            ?>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="row mg-top-10">
                <div class="col-md-12">
                    <div style="color: red;">* obrigat&oacute;rio(s)</div>
                </div>
            </div>
            <div class="row mg-top-10">
                <div class="col-md-12">
                    <input type="submit" name="salvar" class="btn btn-success" id="salvar" value="Salvar"/>
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
