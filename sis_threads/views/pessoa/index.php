<?php
require_once 'default.php';
?>
<div class='container-fluid'>
    <div id='divFiltro' class='x-hidden pesquisar'>
        <form id="form_pessoa" name="form_pessoa_index" method="post" action="<?php echo $link ?>/index" role="form">
            <div>
                <div class="col-md-12">
                    <label for="tipo_pessoa_id">Tipo</label>
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
            </div>
            <div>
                <div class="col-md-12">
                    <label for="nome">* Nome</label>
                    <input type='text' name='nome'  id='nome' class='form-control' placeholder="Nome">
                </div>
            </div>
            <div>
                <div class="col-md-12">
                    <input type="submit" class="btn btn-success" name="salvar" id="salvar" value="Salvar"/>
                    <input type="button" class="btn btn-primary" name="voltar" value="Voltar" onclick="window.location.href = '<?php echo $link ?>/index'"/>
                </div>
            </div>
        </form>
    </div>
    <div class='container container_listagem'>
        <div class='row_table'>
            <div class='actions'>
                <a href='<?php echo $link ?>/add&acao=1&operacao=1' id='add' class='add'>Novo</a> <a href='#' id='pesquisar' class='lupa'>Pesquisar</a>
            </div> 
            <div class='col-md-12'>
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        <h3 class='panel-title'>Pessoa</h3>
                        <div class='pull-right'>
                            <span class='clickable filter' data-toggle='tooltip' title='Botão de filtragem da tabela' data-container='body'>
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
                                <th>#</th>
                                <th>Tipo</th>
                                <th>Cpf/cnpj</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
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
                            $objCol = $data->getColecaoPessoa(PESSOA_ID, $_REQUEST['tipo_pessoa_id'], $_REQUEST['nome']);

                            $objPaginacao = new PaginacaoLink($objCol, 20, '');
                            while ($objPaginacao->colecao->Proximo()) {
                                $obj = $objPaginacao->colecao->getItem();
                                if (!empty($obj['pessoa_id']))
                                    $objPessoa = $data->getPessoa($obj['pessoa_id']);
                                if (!empty($obj['tipo_pessoa_id']))
                                    $objTipoPessoa = $tipoPessoa->getTipoPessoa($obj['tipo_pessoa_id']);
                                ?>
                                <tr id="row_<?php echo $obj['id'] ?>" style='text-align: center;'>
                                    <td><?php echo $obj['id'] ?></td>
                                    <td><?php echo $objPessoa['nome'] ?></td>
                                    <td><?php echo $obj['cpf_cnpj'] ?></td>
                                    <td><?php echo $objTipoPessoa['nome'] ?></td>
                                    <td><?php echo $obj['email'] ?></td>
                                    <td><?php echo $obj['excluido'] ?></td>
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
<!-- PAGINAÇÃO -->
<div id='paginacao'>
    Foi encontrado um total de <b><?php echo $objPaginacao->qtdRegistros ?></b> registro(s).<?php echo $objPaginacao->getMsgPaginacao() ?>
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
?>
