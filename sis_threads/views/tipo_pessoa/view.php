<?php
require_once('default.php');
$obj = $data->getTipoPessoa($_REQUEST['id']);
?>

<div id='container'>
	<div id='content'>
		    <div class='users view'>
				<dl>
					<p class='header'>Tipo de pessoa</p>
					<dt>Nome</dt>
					<dd><?php echo $obj['nome']?>&nbsp;</dd>
				</dl>
				<input type='button' value='Editar' class='editar' onclick='window.location="<?php echo $link?>/edit&acao=2&operacao=1&id=<?php echo $obj['id']?>"' />
				<input type='button' name='voltar' value='Voltar' class='voltar' onclick='window.location.href="<?php echo $link?>/index"'/>
			</div>
	</div>
</div>

<?php
$data->fecharConn();
?>
