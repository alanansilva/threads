<?php
require_once 'default.php';
$obj = $data->getImagem($_REQUEST['id']);
		 if (!empty($obj['menu_id']))
			 $objMenu = $menu->getMenu($obj['menu_id']);
		 if (!empty($obj['relacionamento_id']))
			 $objRelacionamento = $relacionamento->getRelacionamento($obj['relacionamento_id']);
if ($_REQUEST['acao'] == 2 && $_REQUEST['operacao'] == 1) {
?>
	<div class="container-fluid">
	      <div class="row">
            <div class="col-md-12">
                <h5 class="h5_tit_bor_bottom">
                    Editar imagem
                </h5>
            </div>
        </div>
				<form id="form_imagem" name="form_imagem" method="post" action="<?php echo $link?>/edit" role="form">
						<input type="hidden" name="acao" value="2"/>
						<input type="hidden" name="operacao" value="2"/>
						<input type="hidden" name="id" value="<?php echo$_REQUEST['id']?>"/>
				<div class="row">
			     <div class="col-md-4">
			  <label for="menu_id">* Menu_id</label>
									<input type='text' name='menu_id'  id='menu_id' class='form-control'  value='<?php echo $obj['menu_id']?>' placeholder="Menu_id">
			      </div>
				</div>
				<div class="row">
			     <div class="col-md-4">
			  <label for="relacionamento_id">* Relacionamento_id</label>
									<input type='text' name='relacionamento_id'  id='relacionamento_id' class='form-control'  value='<?php echo $obj['relacionamento_id']?>' placeholder="Relacionamento_id">
			      </div>
				</div>
				<div class="row">
			     <div class="col-md-4">
			  <label for="nome">* Nome</label>
									<input type='text' name='nome'  id='nome' class='form-control'  value='<?php echo $obj['nome']?>' placeholder="Nome">
			      </div>
				</div>
			     <div class="col-md-4">
			  <label for="destaque">* Destaque</label>
									<input type='text' name='destaque'  id='destaque' class='form-control'  value='<?php echo $obj['destaque']?>' placeholder="Destaque">
			      </div>
				<div class="row">
			     <div class="col-md-4">
			  <label for="titulo">* Titulo</label>
									<input type='text' name='titulo'  id='titulo' class='form-control'  value='<?php echo $obj['titulo']?>' placeholder="Titulo">
			      </div>
				</div>
						<input type="submit" class="btn btn-success" name="salvar" id="salvar" value="Salvar"/>
						<input type="button" class="btn btn-primary" name="voltar" value="Voltar" onclick="window.location.href='<?php echo $link?>/index'"/>
					</form>
		</div>
<?php
    if ( $_REQUEST['msgErro'] != "" ){
        echo '<div class="message">' . $_REQUEST['msgErro'] .'</div>';
    }elseif( $_REQUEST['msgOK'] != "" ){
        echo '<div class="message">' . $_REQUEST['msgOK'] .'</div>';
    }
}
if ($_REQUEST['acao'] == 2 && $_REQUEST['operacao'] == 2) {
	if ($data->edit()) {
		$msgOK = 'Registro atualizado com sucesso!';
	}else {
		$msgErro = 'N�o foi poss�vel alterar o registro!';
	}
	header('location:' . $link . '/edit&acao=2&operacao=1&id=' . $_REQUEST["id"] . '&msgOK=' . $msgOK . '&msgErro=' . $msgErro );
}
?>
