<?php
require_once 'default.php';
if ($_REQUEST['acao'] == 1 && $_REQUEST['operacao'] == 1) {
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h5 class="h5_tit_bor_bottom">
                    Cadastrar pessoa
                </h5>
            </div>
        </div>
        <form id="form_pessoa" name="form_pessoa" method="post" action="<?php echo $link ?>/add" role="form" enctype="multipart/form-data" >
            <input type="hidden" name="acao" value="1"/>
            <input type="hidden" name="operacao" value="2"/>
            <div class="row">
                <div class="col-md-3">
                    <label for="tipo_pessoa_id">* Tipo</label>
                    <?php
                    $options = array(
                        'name' => 'tipo_pessoa_id',
                        'id' => 'tipo_pessoa_id',
                        'value' => 'id',
                        'label' => array('nome'),
                        'class' => array('selectpicker', 'form-control'),
                        'option_default' => array('label' => '* Selecione', 'value' => null, 'use' => true),
                        'other_attribute' => array('data-live-search' => 'true'),
                    );
                    echo UtilCombo::getComboCollectionOrArray($tipoPessoa->getColecaoTipoPessoa(), $options);
                    ?>
                </div>
                <div class="col-md-3 skin-minimal">
                    <label for="fisica_juridica">* Fisica/juridica</label>
                    <input type='radio' name='fisica_juridica'  id='fisica_juridica' class='radio-inline' value="F"> F
                    <input type='radio' name='fisica_juridica'  id='fisica_juridica' class='radio-inlinel' value="J"> J
                </div>
                  <div class="col-md-3 skin-minimal ">
                    <label for="ativo">* Ativo</label>
                    <input type="radio" id="ativo" class="radio-inline" name="ativo" value='S' checked /> Sim
                    <input type="radio" id="ativo" class="radio-inline" name="ativo" value='N' /> Não
                </div>
                  <div class="col-md-3 skin-minimal ">
                    <label for="excluido">* Excluido</label>
                    <input type="radio" id="excluido" class="radio-inline" name="excluido" value='S'  /> Sim
                    <input type="radio" id="excluido" class="radio-inline" name="excluido" value='N' checked /> Não
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="cpf_cnpj">* Cpf/cnpj</label>
                    <input type='text' name='cpf_cnpj' id='cpf_cnpj' class='form-control'   placeholder="Cpf/cnpj">
                </div>
                <div class="col-md-4">
                    <label for="nome">* Nome</label>
                    <input type='text' name='nome'  id='nome' class='form-control'   placeholder="Nome">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="email">* Email</label>
                    <input type='text' name='email'  id='email' class='form-control'   placeholder="Email">
                </div>
                <div class="col-md-4">
                    <label for="endereco">* Endereço</label>
                    <input type='text' name='endereco'  id='endereco' class='form-control'   placeholder="Endereco">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="telefone">* Telefone</label>
                    <input type='text' name='telefone'  id='telefone' class='form-control'   placeholder="Telefone">
                </div>
                <div class="col-md-4">
                    <label for="mapa_localizacao">* Mapa de Localização</label>
                    <input type='text' name='mapa_localizacao'  id='mapa_localizacao' class='form-control'   placeholder="Mapa de Localização">
                </div>
            </div>
             <div class="row">
             <div class="col-md-4">
                <div class="form-group" data-toggle="tooltip" data-placement="top" title="Tamanho: 620px X 385px">
                    <label for="icone">Logomarca</label>
                    <input type="file" name='logomarca'  id='logomarca' />
                </div>
            </div>
            </div>
            <input type="submit" class="btn btn-success" name="salvar" id="salvar" value="Salvar"/>
            <input type="button" class="btn btn-primary" name="voltar" value="Voltar" onclick="window.location.href = '<?php echo $link ?>/index'"/>
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
        $msgErro = 'Não foi possível inserir o registro!';
    }
    header('location:' . $link . '/add&acao=1&operacao=1&msgOK=' . $msgOK . '&msgErro=' . $msgErro);
}
?>
