<?php
require_once 'default.php';
$obj = $data->getConteudo($_REQUEST['id']);
if (!empty($obj['conteudo_categoria_id']))
    $objConteudoCategoria = $conteudoCategoria->getConteudoCategoria($obj['conteudo_categoria_id']);
$objColImagem = $imagem->getColecaoImagem(7, $obj['id']);

if ($_REQUEST['acao'] == 2 && $_REQUEST['operacao'] == 1) {
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h5 class="h5_tit_bor_bottom">
                    Editar conteudo
                </h5>
            </div>
        </div>
        <form id="form_conteudo" name="form_conteudo" method="post" action="<?php echo $link ?>/edit" role="form">
            <input type="hidden" name="acao" value="2"/>
            <input type="hidden" name="operacao" value="2"/>
            <input type="hidden" name="id" value="<?php echo $_REQUEST['id'] ?>"/>
            <div class="row">
                <div class="col-md-4">
                    <label for="conteudo_categoria_id">Categoria</label>
                    <!--<input type='text' name='conteudo_categoria_id'  id='conteudo_categoria_id' class='form-control'  value='<?php echo $obj['conteudo_categoria_id'] ?>' placeholder="Conteudo_categoria_id">-->
                    <?php
                    $objColConteudoCategoria = $conteudoCategoria->getColecaoConteudoCategoria();
                    $options = array(
                        'name' => 'conteudo_categoria_id',
                        'id' => 'conteudo_categoria_id',
                        'value' => 'id',
                        'label' => array('nome'),
                        'selected' => array('field' => 'id', 'value' => $obj['conteudo_categoria_id']),
                        'class' => array('selectpicker', 'form-control'),
                        'option_default' => array('label' => '* Selecione', 'value' => null, 'use' => true),
                        'other_attribute' => array('data-live-search' => 'true'),
                    );
                    echo UtilCombo::getComboCollectionOrArray($objColConteudoCategoria, $options);
                    ?>
                </div>
                <?php
                if ($obj['conteudo_categoria_id'] != 4) {
                    $display = "none";
                } else {
                    $display2 = "none";
                }
                
                
                if ($obj['conteudo_categoria_id'] != 2) {
                    $display3 = "none";
                } else {
                    $display5 = "none";
                }

                if ($obj['conteudo_categoria_id'] != 1)
                    $display4 = "none";
                ?>

                <div class="col-md-4 configuracao_equipe_2" style="display: <?php echo $display2 ?>" >
                    <label for="titulo">* Titulo</label>
                    <input type='text' name='titulo'  id='titulo' class='form-control'  value='<?php echo $obj['titulo'] ?>' placeholder="Titulo">
                </div>
                <div class="col-md-4 configuracao_equipe_2" style="display: <?php echo $display2 ?>">
                    <label for="subtitulo">* Subtitulo</label>
                    <input type='text' name='subtitulo'  id='subtitulo' class='form-control'  value='<?php echo $obj['subtitulo'] ?>' placeholder="Subtitulo">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 configuracao_equipe"  style="display: <?php echo $display ?>">
                    <label for="nome">* Nome</label>
                    <input type='text' name='nome'  id='nome' class='form-control'  value='<?php echo $obj['nome'] ?>'  placeholder="Nome">
                </div>
                <div class="col-md-4 configuracao_equipe"  style="display: <?php echo $display ?>">
                    <label for="nome">* Cargo</label>
                    <input type='text' name='cargo'  id='cargo' class='form-control'  value='<?php echo $obj['cargo'] ?>' placeholder="Titulo">
                </div>
                <div class="col-md-4 configuracao_equipe"  style="display: <?php echo $display ?>">
                    <label for="nome">* Função</label>
                    <input type='text' name='funcao'  id='funcao' class='form-control' value='<?php echo $obj['funcao'] ?>'  placeholder="Titulo">
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
                        'selected' => array('field' => 'id', 'value' => $obj['ordem']),
                        'class' => array('form-control', 'input-sm', 'valid'),
                        'option_default' => array('label' => ':: Selecione ::', 'value' => null),
                    );
                    echo UtilCombo::getComboCollectionOrArray($arrayOrdem, $options);
                    ?>
                </div>
                <div class="col-md-4">
                    <label for="ativo">* Ativo</label>
                    <input type='radio' name='ativo'  id='ativo'  value='S' <?php
                    if ($obj['ativo'] == 'S') {
                        echo 'checked';
                    }
                    ?> />Sim 
                    <input type='radio' name='ativo'  id='ativo'  value='N' <?php
                    if ($obj['ativo'] == 'N') {
                        echo 'checked';
                    }
                    ?>/>Não
                </div>
                <div class="col-md-4 configuracao_produto" style="display: <?php echo $display4 ?>">
                    <label for="valor">* Valor</label>
                    <input type='text' name='valor'  id='valor' class='form-control moeda'  value='<?php echo $obj['valor'] ?>' placeholder="0,00">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 configuracao_equipe_2" style="display: <?php echo $display2 ?>">
                    <label for="descricao_breve">* Descricao_breve</label>
                    <input type='text' name='descricao_breve'  id='descricao_breve' class='form-control'  value='<?php echo $obj['descricao_breve'] ?>' placeholder="Descricao_breve">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 configuracao_servico_2" style="display: <?php echo $display5 ?>">
                    <div class="form-group">
                        <label for="icone">Foto</label>
                        <input type="file" name='foto[]' id='foto' multiple=""/>
                    </div>
                </div>
                <div class="col-md-8 configuracao_servico" style="display: <?php echo $display3 ?>">
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
            <?php
            $path = URL_POST_FILE_REMOTE;
            while ($objColImagem->Proximo()) {
                $objImagem = $objColImagem->getItem();
                ?>
                <div class="row configuracao_servico_2">
                    <div class="col-md-2" id="row_<?php echo $objImagem['id'] ?>" style="position: relative;">
                        <!--<label>Foto <?php // echo $objImagem['destaque']  ?></label>-->
                        <img src="<?php echo $path . $objImagem['nome_img'] ?>" class="thumbnail small" style="width: 100%;"/>
                        <a class="btn btn-danger delete" data-toggle="tooltip" title="Deletar" href='javascript:void(0)' data-delete-id="<?php echo $objImagem['id'] ?>" data-delete-url="<?php echo $pathApp . 'imagem' . "/persistence.php" ?>" data-row-id="row_<?php echo $objImagem['id'] ?>" style="position: absolute; bottom: 25px; right: 5px; margin-right: 15px; border-radius: 4px 4px 0 4px;">
                            <i class="glyphicon glyphicon-trash" style="color: #fff;"></i>
                        </a>
                    </div>
                </div>

        <?php
    }
    ?>
            <div class="row">
                <div class="col-md-12 configuracao_equipe_2" style="display: <?php echo $display2 ?>">
                    <label for="descricao">Descricao</label>
                    <textarea class="ckeditor" id="descricao" name="descricao"><?php echo $obj['descricao'] ?></textarea>
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
if ($_REQUEST['acao'] == 2 && $_REQUEST['operacao'] == 2) {
    if ($data->edit()) {
        $msgOK = 'Registro atualizado com sucesso!';
    } else {
        $msgErro = 'Não foi possível alterar o registro!';
    }
    header('location:' . $link . '/edit&acao=2&operacao=1&id=' . $_REQUEST["id"] . '&msgOK=' . $msgOK . '&msgErro=' . $msgErro);
}
?>
