<?php
require_once('default.php');
unset($_SESSION['carrinhoPerfilItem']);
?>
<div class="container-fluid">
    <!-- Filtro -->
    <div id='divFiltro' class="x-hidden pesquisar" style="height: 120px;">
        <form id="form1" name="form1" method="post" action="<?php echo $link ?>/index">
            <div>
                <div class="col-md-12">
                    <label for="nome">Nome</label>
                    <input name="nome" id="nome" class="form-control" type="text" maxlength="50"/>
                </div>
            </div>
            <div>
                <div class="col-md-12">
                    <input type="submit" class="btn btn-success" value="Filtrar" />
                </div>
            </div>
        </form>
    </div>
    <div class="container container_listagem">
        <div class="row_table">
            <div class="actions">
                <a href='<?php echo $link ?>/add&acao=1&operacao=1' id='add' class='add'>Novo</a>   <a href='#' id='pesquisar' class='lupa'>Pesquisar</a>
            </div>
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Perfil</h3>
                        <div class="pull-right">
                            <span class="clickable filter" data-toggle="tooltip" title="Buscar na tabela" data-container="body">
                                <i class="glyphicon glyphicon-filter"></i>
                            </span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Pesquisa" />
                    </div>
                    <table class="table table-hover" id="dev-table">
                        <thead>
                            <tr>
                                <th>Perfil</th>
                                <th>Pessoa</th>
                                <th class="tdAcoes">Ações</th>
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
                            $objCol = $data->getColecaoPerfil($_SESSION['dados']['pessoa']['id']);
                            $objPaginacao = new PaginacaoLink($objCol, 20, '');

                            while ($objPaginacao->colecao->Proximo()) {
                                $obj = $objPaginacao->colecao->getItem();
                                $objPessoa = $pessoa->getPessoa($obj['pessoa_id']);
                                ?>
                                <tr id="row_<?php echo $obj['id'] ?>" <?php echo ($i++ % 2 == 0) ? ' class="altrow"' : ''; ?>>
                                    <td><?php echo $obj['nome'] ?></td>
                                    <td><?php echo $objPessoa['nome'] ?></td>
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
    <!-- PAGINAÇÃO -->
    <div id='paginacao'>
        <?php echo $objPaginacao->getMsgPaginacao() ?>
    </div>
    <!-- PAGINAÇÃO -->   
</div>
<?php
if ($_REQUEST['acao'] == 3 && $_REQUEST['operacao'] == 2) {
    if ($data->delete()) {
        $msg = 'Registro excluido com sucesso!';
    } else {
        $msg = 'Não foi possível excluir o registro!';
    }
    header('location:' . $link . '/index&msg=' . $msg);
}

$data->fecharConn();
?>