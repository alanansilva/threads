<?php
require_once 'default.php';
?>
<div class="container-fluid">
    <div id='divFiltro' class='x-hidden pesquisar' style="height: 250px;">
        <form id='form1' name='form1' method='post' action='<?php echo $link ?>/index'>
            <div>
                <div class="col-md-12">
                    <label for="pessoa_id">Pessoa</label>
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
            </div>
            <div>
                <div class="col-md-12">
                    <label for="nome">Nome</label>
                    <input type='text' name='nome' class="form-control" id='nome'>
                </div>
            </div>
            <div>
                <div class="col-md-12">
                    <input type='submit' class="btn btn-success" value='Filtrar' />
                </div>
            </div>
        </form>
    </div>
    <div class="container container_listagem">
        <div class="row_table">
            <div class='actions'>
                <a href='<?php echo $link ?>/add&acao=1&operacao=1' id='add' class='add'>Novo</a>   <a href='#' id='pesquisar' class='lupa'>Pesquisar</a>
            </div>
            <span id="respostaMsg"></span>
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Usuário(s)</h3>
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
                                <th>Nome</th>
                                <th>Login</th>
                                <th>E-mail</th>
                                <th>Perfil</th>
                                <th>Pessoa</th>
                                <th>Ativo</th>
                                <th class='tdAcoes'>Ações</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan='7'>&nbsp;</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $i = 0;
                            $objCol = $data->getColecaoUsuario($_REQUEST['pessoa_id']);
                            $objPaginacao = new PaginacaoLink($objCol, 20, '');
                            while ($objPaginacao->colecao->Proximo()) {
                                $obj = $objPaginacao->colecao->getItem();
                                
                                $objPerfil = $perfil->getPerfil($obj['perfil_id']);
                                $objPessoa = $pessoa->getPessoa($obj['pessoa_id']);
                                ?>
                                <tr id="row_<?php echo $obj['id'] ?>" style='text-align: center;'>
                                    <td><?php echo $obj['nome'] ?></td>
                                    <td><?php echo $obj['login'] ?></td>
                                    <td style="width: 200px;">
                                        <input type="text" name="email" class="form-control input-sm" id="email<?php echo $obj['id'] ?>" value="<?php echo $obj['email'] ?>" style="width: 200px; height: 25px; margin-bottom: 0;">
                                    </td>
                                    <td><?php echo $objPerfil['nome'] ?></td>
                                    <td><?php echo $objPessoa['nome'] ?></td>
                                    <td>
                                        <?php echo UtilString::getFlagAfirmacao($obj['ativo']) ?>
                                    </td>
                                    <td class='actions' style="width: 150px;">
                                        <a class="btn btn-success" data-toggle="tooltip" title="Alterar" href="javascript:void()" onclick='javascript: return editar(<?php echo $obj['id'] ?>, 0);'>
                                            <i class="glyphicon glyphicon-refresh"></i>
                                        </a>
                                        <a class="btn btn-info" data-toggle="tooltip" title="Resetar senha" href="javascript:void()" onclick='javascript: return editar(<?php echo $obj['id'] ?>, 1);'>
                                            <i class="glyphicon glyphicon-warning-sign"></i>
                                        </a>
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
<!-- PAGINAÇÃO -->
<div id='paginacao'>
    <?php echo $objPaginacao->getMsgPaginacao() ?>
</div>
<!-- PAGINAÇÃO -->
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