<?php
require_once 'default.php';
if ($_REQUEST['acao'] == 1 && $_REQUEST['operacao'] == 1) {
?>
	<div class="container-fluid">
	      <div class="row">
            <div class="col-md-12">
                <h5 class="h5_tit_bor_bottom">
                    Cadastrar imagem
                </h5>
            </div>
        </div>
				<form id="form_imagem" name="form_imagem" method="post" action="<?php echo $link?>/add" role="form">
			      <input type="hidden" name="acao" value="1"/>
			      <input type="hidden" name="operacao" value="2"/>
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
				<div class="row">
			     <div class="col-md-4">
			  <label for="nome">* Nome</label>
									<input type='text' name='nome'  id='nome' class='form-control'   placeholder="Nome">
			      </div>
				</div>
			     <div class="col-md-4">
			  <label for="destaque">* Destaque</label>
									<input type='text' name='destaque'  id='destaque' class='form-control'   placeholder="Destaque">
			      </div>
				<div class="row">
			     <div class="col-md-4">
			  <label for="titulo">* Titulo</label>
									<input type='text' name='titulo'  id='titulo' class='form-control'   placeholder="Titulo">
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
if ($_REQUEST['acao'] == 1 && $_REQUEST['operacao'] == 2) {
	if ($data->add()) {
		$msgOK = 'Registro inserido com sucesso!';
	}else {
		$msgErro = 'Não foi possível inserir o registro!';
	}
	header('location:' . $link . '/add&acao=1&operacao=1&msgOK=' . $msgOK . '&msgErro=' . $msgErro );
}
?>
