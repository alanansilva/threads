<?php
require_once 'default.php';
$obj = $data->getBanner($_REQUEST['id']);
		 if (!empty($obj['banner_categoria_id']))
			 $objBannerCategoria = $bannerCategoria->getBannerCategoria($obj['banner_categoria_id']);
?>

<div id='container'>
	<div id='content'>
		    <div class='users view'>
				<dl>
					<p class='header'>Curso</p>
					<dt>Id</dt>
					<dd><?php echo $obj['id']?>&nbsp;</dd>
					<dt>Banner_categoria_id</dt>
					<dd><?php echo $objBannerCategoria['nome']?>&nbsp;</dd>
					<dt>Nome</dt>
					<dd><?php echo $obj['nome']?>&nbsp;</dd>
					<dt>Link</dt>
					<dd><?php echo $obj['link']?>&nbsp;</dd>
					<dt>Ativo</dt>
					<dd><?php echo $obj['ativo']?>&nbsp;</dd>
					<dt>Descricao</dt>
					<dd><?php echo $obj['descricao']?>&nbsp;</dd>
				</dl>
				<input type='button' value='Editar' class='editar' onclick='window.location="<?php echo $link?>/edit&acao=2&operacao=1&id=<?php echo $obj['id']?>"' />
				<input type='button' name='voltar' value='Voltar' class='voltar' onclick='window.location.href="<?php echo $link?>/index"'/>
			</div>
	</div>
</div>

<?php
?>
