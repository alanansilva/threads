<?php
header("Content-Type: text/html;  charset=ISO-8859-1", true);
ob_start();
session_start();
require_once 'session.php';

require_once 'Carrinho.php';
require_once '../../models/Menu.php';

$carrinho = new Carrinho('carrinhoPerfilItem');
$data = new Menu();
?>

<script>
    function removeItemCarrinho(key) {
        if (confirm("Deseja realmente deletar o registro")) {
            $('#montaGrid').html('Removendo...');
            $.post('../../lib/php/montaGridPerfilItem.php',
                    {
                        key: key,
                        acao: 'del'
                    },
            function (resposta) {
                $('#montaGrid').html(resposta);
            }
            );
        }
        return false;
    }
</script>
<div class='panel panel-primary'>
    <div class='panel-heading'>
        <h3 class='panel-title'>Views</h3>
        <div class='pull-right'>
            <span class='clickable filter' data-toggle='tooltip' title='Botão de filtragem da tabela' data-container='body'>
                <i class='glyphicon glyphicon-filter'></i>
            </span>
        </div>
    </div>
    <div class='panel-body'>
        <input type='text' class='form-control' id='dev-table-filter' data-action='filter' data-filters='#dev-table' placeholder='Pesquisa' />
    </div>
    <table class='table table-hover'>
        <thead>
            <tr>
                <th>Menu</th>
                <th class='tdAcoes'>Ações</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th colspan='2'>&nbsp;</th>
            </tr>
        </tfoot>
        <tbody>
            <?php
            $stringItem = $_REQUEST['menu_id'] . '#';

            /**
             * INSERE PRODUTO NO CARRINHO DE COMPRAS
             */
            if ($_REQUEST['acao'] == 'add') {
                $carrinho->insereCarrinho($stringItem);
            } elseif ($_REQUEST['acao'] == 'del') {
                $carrinho->removeCarrinho($_REQUEST['key']);
            }

            $i = 0;

            $nomeIndiceArraySessao = array(
                'menu_id'
            );

            $objCol = $carrinho->getCarrinho($nomeIndiceArraySessao);

            while ($objCol->Proximo()) {
                $obj = $objCol->getItem();
                $objMenu = $data->getMenu($obj['menu_id']);
                ?>
                <tr id="row_<?php echo $obj['id'] ?>" <?php echo ($i++ % 2 == 0) ? ' class="altrow"' : ''; ?>>
                    <td><?php echo $objMenu['descricao'] ?></td>
                    <td class='actions'>
                        <a class="btn btn-danger delete" onclick='return removeItemCarrinho("<?php echo $obj['key'] ?>");' data-toggle="tooltip" title="Deletar" href='javascript:void(0)' data-delete-id="<?php echo $obj['id'] ?>" data-delete-url="<?php echo $pathApp . $app . "/persistence.php" ?>" data-row-id="row_<?php echo $obj['id'] ?>">
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