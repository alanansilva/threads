<?php
require_once 'default.php';
if ($_REQUEST['acao'] == 1 && $_REQUEST['operacao'] == 1) {
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h5 class="h5_tit_bor_bottom">
                    Cadastrar conteudo
                </h5>
            </div>
        </div>
        <form id="form_conteudo" name="form_conteudo" method="post" action="<?php echo $link ?>/add" role="form">
            <input type="hidden" name="acao" value="1"/>
            <input type="hidden" name="operacao" value="2"/>
            <div class="row">
                <div class="col-md-4">
                    <label for="conteudo_categoria_id">Categoria</label>
                    <!--<input type='text' name='conteudo_categoria_id'  id='conteudo_categoria_id' class='form-control'   placeholder="Conteudo_categoria_id">-->
                    <?php
                    $objColConteudoCategoria = $conteudoCategoria->getColecaoConteudoCategoria();
                    $options = array(
                        'name' => 'conteudo_categoria_id',
                        'id' => 'conteudo_categoria_id',
                        'value' => 'id',
                        'label' => array('nome'),
                        'class' => array('selectpicker', 'form-control'),
                        'option_default' => array('label' => '* Selecione', 'value' => null, 'use' => true),
                        'other_attribute' => array('data-live-search' => 'true'),
                    );
                    echo UtilCombo::getComboCollectionOrArray($objColConteudoCategoria, $options);
                    ?>
                </div>
                <div class="col-md-4 configuracao_equipe_2">
                    <label for="titulo">* Titulo</label>
                    <input type='text' name='titulo'  id='titulo' class='form-control'   placeholder="Titulo">
                </div>
                <div class="col-md-4 configuracao_equipe_2">
                    <label for="subtitulo">* Subtitulo</label>
                    <input type='text' name='subtitulo'  id='subtitulo' class='form-control'   placeholder="Subtitulo">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 configuracao_equipe" style="display: none">
                    <label for="nome">* Nome</label>
                    <input type='text' name='nome'  id='nome' class='form-control'   placeholder="Nome">
                </div>
                <div class="col-md-4 configuracao_equipe"  style="display: none">
                    <label for="nome">* Cargo</label>
                    <input type='text' name='cargo'  id='cargo' class='form-control'   placeholder="Titulo">
                </div>
                <div class="col-md-4 configuracao_equipe"  style="display: none">
                    <label for="nome">* Função</label>
                    <input type='text' name='funcao'  id='funcao' class='form-control'   placeholder="Titulo">
                </div>
                <div class="col-md-4">
                    <label for="ordem">* Ordem</label>
                    <!--<input type='text' name='ordem'  id='ordem' class='form-control'   placeholder="Ordem">-->
                    <?php
                    $arrayOrdem = array(
                        array('id' => '1', 'nome' => "1"),
                        array('id' => '2', 'nome' => "2"),
                        array('id' => '3', 'nome' => "3"),
                        array('id' => '4', 'nome' => "4"),
                        array('id' => '5', 'nome' => "5")
                    );
                    $options = array(
                        'name' => 'ordem',
                        'id' => 'ordem',
                        'value' => 'id',
                        'label' => array('nome'),
                        'selected' => array('field' => 'id', 'value' => ""),
                        'class' => array('form-control', 'input-sm', 'valid'),
                        'option_default' => array('label' => ':: Selecione ::', 'value' => null),
                    );
                    echo @UtilCombo::getComboCollectionOrArray($arrayOrdem, $options);
                    ?>
                </div>
                <div class="col-md-4 ">
                    <label for="ativo">* Ativo</label>
                    <input type="radio" id="ativo" class="radio-inline" name="ativo" value='S' checked /> Sim
                    <input type="radio" id="ativo" class="radio-inline" name="ativo" value='N' /> Não
                </div>
                <div class="col-md-4 configuracao_produto" style="display: none">
                    <label for="valor">* Valor</label>
                    <input type='text' name='valor'  id='valor' class='form-control moeda' placeholder="0,00">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 configuracao_equipe_2">
                    <label for="descricao_breve">* Descricao_breve</label>
                    <input type='text' name='descricao_breve'  id='descricao_breve' class='form-control'   placeholder="Descricao_breve">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 configuracao_servico_2">
                    <div class="form-group">
                        <label for="icone">Foto</label>
                        <input type="file" name='foto[]' id='foto' multiple=""/>
                    </div>
                </div> 
                <div class="col-md-8 configuracao_servico" style="display: none">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Ícone <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" id="dropdown-icones" role="menu" style="overflow: auto; height: 330px; width: 840px; min-width: 840px; max-width: 840px;">
                            <?php
                            $objColIconeBootstrap->inicio();
                            while ($objColIconeBootstrap->proximo()) {
                                $objIconeBootstrap = $objColIconeBootstrap->getItem();
                                $checked = null;
                                if ($objIconeBootstrap['id'] == $obj['icone_bootstrap_id']) {
                                    $checked = 'checked="" ';
                                }
                                echo '<li style="float: left; margin-right: 10px; margin-left: 5px; border-right: 1px solid #ccc; padding-right: 10px"><input type="radio" name="icone_bootstrap_id" value="' . $objIconeBootstrap['id'] . '" ' . $checked . ' style="margin-right: 10px;" id="icone_bootstrap_id" ><span class="' . $objIconeBootstrap['classe'] . '"</span></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 configuracao_equipe_2">
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
