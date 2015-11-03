<?php
require_once 'default.php';
?>
<div class='container-fluid'>
    <div id='divFiltro' class='x-hidden pesquisar'>
        <form id="form_conteudo_categoria" name=form_"conteudo_categoria" method="post" action="<?php echo $link ?>/index" role="form">
            <div>
                <div class="col-md-4">
                    <label for="id">* Id</label>
                    <input type='text' name='id'  id='id' class='form-control'   placeholder="Id">
                </div>
            </div>
            <div>
                <div class="col-md-4">
                    <label for="nome">* Nome</label>
                    <input type='text' name='nome'  id='nome' class='form-control'   placeholder="Nome">
                </div>
            </div>
            <div>
                <div class="col-md-8">
                    <label for="titulo">* Titulo</label>
                    <input type='text' name='titulo'  id='titulo' class='form-control'   placeholder="Titulo">
                </div>
            </div>
        </form>
    </div>
    <div class='container container_listagem'>
        <div class='row_table'>
            <div class='actions'>
                <a href='<?php echo $link ?>/add&acao=1&operacao=1' id='add' class='add'>Novo</a> | <a href='#' id='pesquisar' class='lupa'>Pesquisar</a>
            </div> 
            <div class='col-md-12'>
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Categoria</h3>
                        <div class='pull-right'>
                            <span class='clickable filter' data-toggle='tooltip' title='Bot�o de filtragem da tabela' data-container='body'>
                                <i class='glyphicon glyphicon-filter'></i>
                            </span>
                        </div>
                    </div>
                    <div class='panel-body'>
                        <input type='text' class='form-control' id='dev-table-filter' data-action='filter' data-filters='#dev-table' placeholder='Pesquisa' />
                    </div>
                    <table class='table table-hover' id='dev-table'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nome</th>
                                <th class='tdAcoes'>A��es</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan='3'>&nbsp;</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $i = 0;
                            $objCol = $data->getColecaoConteudoCategoria($_REQUEST['id'], $_REQUEST['nome']);
                            $objPaginacao = new PaginacaoLink($objCol, 20, '');
                            while ($objPaginacao->colecao->Proximo()) {
                                $obj = $objPaginacao->colecao->getItem();
                                ?>
                                <tr  style='text-align: center;'>
                                    <td><?php echo $obj['id'] ?></td>
                                    <td><?php echo $obj['nome'] ?></td>
                                     <td class="actions">
                                        <a class="btn btn-primary" data-toggle="tooltip" title="Editar" href="<?php echo $link ?>/edit&id=<?php echo $obj['id'] ?>&acao=2&operacao=1">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </a>
                                        <a class="btn btn-danger delete" data-toggle="tooltip" title="Deletar" href='javascript:void(0)' data-delete-id="<?php echo $obj['id'] ?>" data-delete-url="<?php echo $pathApp . $app . "/persistence.php" ?>" data-row-id="row_<?php echo $obj['id'] ?>">
                                            <i class="glyphicon glyphicon-trash" style="color: #fff;"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PAGINA��O -->
<div id='paginacao'>
    Foi encontrado um total de <b><?php echo $objPaginacao->qtdRegistros ?></b> registro(s).<?php echo $objPaginacao->getMsgPaginacao() ?>
</div>
<!-- PAGINA��O -->
<?php
if ($_REQUEST['acao'] == 3 && $_REQUEST['operacao'] == 2) {
    if ($data->delete()) {
        $msg = 'Registro excluido com sucesso!';
    } else {
        $msg = 'N�o foi poss�vel excluir o registro!';
    }
    header('location:' . $link . '/index&msg=' . $msg);
}
?>
