<?php
require_once 'default.php';
?>
<div id='container-fluid'>
			 <div id='divFiltro' class='x-hidden pesquisar'>
				<form id="form_imagem" name=form_"imagem" method="post" action="<?php echo $link?>/index" role="form">
				<div class="row">
			     <div class="col-md-4">
			  <label for="id">* Id</label>
									<input type='text' name='id'  id='id' class='form-control'   placeholder="Id">
			      </div>
				</div>
				<div class="row">
			     <div class="col-md-4">
			  <label for="menu_id">* Menu_id</label>
									<input type='text' name='menu_id'  id='menu_id' class='form-control'   placeholder="Menu_id">
			      </div>
				</div>
				<div class="row">
			     <div class="col-md-4">
			  <label for="relacionamento_id">* Relacionamento_id</label>
									<input type='text' name='relacionamento_id'  id='relacionamento_id' class='form-control'   placeholder="Relacionamento_id">
			      </div>
				</div>
						<input type="submit" class="btn btn-success" name="salvar" id="salvar" value="Salvar"/>
						<input type="button" class="btn btn-primary" name="voltar" value="Voltar" onclick="window.location.href='<?php echo $link?>/index'"/>
					</form>
		</div>
    <div class='container container_listagem'>
        <div class='row_table'>
		<div class='actions'>
			<a href='<?php echo $link?>/add&acao=1&operacao=1' id='add' class='add'>Novo</a> | <a href='#' id='pesquisar' class='lupa'>Pesquisar</a>
		</div> 
		<div class='col-md-6'>
		    <div class='panel panel-primary'>
		        <div class='panel-heading'>
		            <h3 class='panel-title'>Recurso Categoria</h3>
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
					<th>Id</th>
					<th>Menu_id</th>
					<th>Relacionamento_id</th>
					<th>Nome</th>
					<th>Destaque</th>
					<th class='tdAcoes'>Ações</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th colspan='6'>&nbsp;</th>
				</tr>
			</tfoot>
			<tbody>
			<?php 
			$i=0;
			$objCol = $data->getColecaoImagem($_REQUEST['id'], $_REQUEST['menu_id'], $_REQUEST['relacionamento_id']);
		    $objPaginacao = new PaginacaoLink( $objCol, 20,'');
			while ($objPaginacao->colecao->Proximo()){
				$obj = $objPaginacao->colecao->getItem();
		 if (!empty($obj['menu_id']))
			 $objMenu = $menu->getMenu($obj['menu_id']);
		 if (!empty($obj['relacionamento_id']))
			 $objRelacionamento = $relacionamento->getRelacionamento($obj['relacionamento_id']);
			?>
				<tr  style='text-align: center;'>
					<td><?php echo $obj['id']?></td>
					<td><?php echo $objMenu['nome']?></td>
					<td><?php echo $objRelacionamento['nome']?></td>
					<td class='actions'>
						<a href='<?php echo $link?>/view&id=<?php echo $obj['id']?>'><img src='../../images/actions/lupa.png' title='Vizualizar' alt='' /></a>
						<a href='<?php echo $link?>/edit&id=<?php echo $obj['id']?>&acao=2&operacao=1'><img src='../../images/actions/edit.png' title='Editar' alt='' /></a>
						<a href='<?php echo $link?>/index&id=<?php echo $obj['id']?>&acao=3&operacao=2' onclick='return confirm("Deseja realmente deletar o registro");'>
							<img src='../../images/actions/delete.png' title='Deletar' alt='' />
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
			Foi encontrado um total de <b><?php echo $objPaginacao->qtdRegistros?></b> registro(s).<?php echo $objPaginacao->getMsgPaginacao()?>
		</div>
		<!-- PAGINAÇÃO -->
<?php
if ($_REQUEST['acao'] == 3 && $_REQUEST['operacao'] == 2) {
	if ($data->delete()) {
		$msg = 'Registro excluido com sucesso!';
	}else {
		$msg = 'Não foi possível excluir o registro!';
	}
	header('location:' . $link . '/index&msg=' . $msg);
}
?>
