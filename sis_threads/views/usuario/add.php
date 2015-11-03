<?php
echo '<pre class="hide">';
print_r($_SESSION['dados']['usuario']);
echo '</pre>';

require_once('default.php');
if ($_REQUEST['acao'] == 1 && $_REQUEST['operacao'] == 1) {
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h5 class="h5_tit_bor_bottom">
                    Adicionar - Usuário(s)
                </h5>
            </div>
        </div>
        <form id="formUsuario" name="formUsuario" method="post" action="<?php echo $link ?>/add">
            <input type="hidden" name="acao" value="1"/>
            <input type="hidden" name="operacao" value="2"/>
            <div class="row">
                <div class="col-md-6">
                    <label for="pessoa_id">* Pessoa</label>
                    <?php
                    $options = array(
                        'name' => 'pessoa_id',
                        'id' => 'pessoa_id',
                        'value' => 'id',
                        'label' => array('nome'),
                        'class' => array('selectpicker', 'form-control'),
                        'option_default' => array('label' => '* Selecione', 'value' => null, 'use' => true),
                        'other_attribute' => array('data-live-search' => 'true'),
                    );
                    echo UtilCombo::getComboCollectionOrArray($pessoa->getColecaoPessoa(), $options)
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
                <div class="col-md-12 skin-minimal">
                    <label for="ativo">* Ativo</label>
                    <input type="radio" name="ativo" value="1" checked="" />Sim
                    <input type="radio" name="ativo" value="0" />Não
                </div>
            </div>
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
