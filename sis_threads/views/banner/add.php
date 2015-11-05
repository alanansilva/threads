<?php
require_once 'default.php';
if ($_REQUEST['acao'] == 1 && $_REQUEST['operacao'] == 1) {
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h5 class="h5_tit_bor_bottom">
                    Cadastrar banner
                </h5>
            </div>
        </div>
        <form id="form_banner" name="form_banner" method="post" action="<?php echo $link ?>/add" role="form" enctype="multipart/form-data">
            <input type="hidden" name="acao" value="1"/>
            <input type="hidden" name="operacao" value="2"/>
            <div class="row">
                <div class="col-md-6">
                    <label for="banner_categoria_id">*Categoria</label>
                    <!--<input type='text' name='banner_categoria_id'  id='banner_categoria_id' class='form-control'   placeholder="Banner_categoria_id">-->
                    <?php
                    $objColBannerCategoria = $bannerCategoria->getColecaoBannerCategoria();
                    $options = array(
                        'name' => 'banner_categoria_id',
                        'id' => 'banner_categoria_id',
                        'value' => 'id',
                        'label' => array('nome'),
                        'class' => array('selectpicker', 'form-control'),
                        'option_default' => array('label' => '* Selecione', 'value' => null, 'use' => true),
                        'other_attribute' => array('data-live-search' => 'true'),
                    );
                    echo UtilCombo::getComboCollectionOrArray($objColBannerCategoria, $options);
                    ?>
                </div>
                <div class="col-md-6">
                    <label for="nome">* Nome</label>
                    <input type='text' name='nome'  id='nome' class='form-control'   placeholder="Nome">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="link">* Link</label>
                    <input type='text' name='link'  id='link' class='form-control'   placeholder="Link">
                </div>
                <div class="col-md-6">
                    <label for="ativo">* Ativo</label>
                    <input type="radio" id="ativo" class="radio-inline" name="ativo" value='S' checked /> Sim
                    <input type="radio" id="ativo" class="radio-inline" name="ativo" value='N' /> Não
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="icone">TV</label>
                        <input type="file" name='tv[]' id='tv' multiple=""/>
                    </div>
                </div>                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="descricao">Descricao</label>
                    <textarea class="ckeditor" id="descricao" name="descricao"></textarea>
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
