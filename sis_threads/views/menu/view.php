<?php
require_once('default.php');
$obj = $data->getMenu($_REQUEST['id']);
?>

<div id='container'>
	<div id='content'>
		    <div class='users view'>
				<dl>
					<p class='header'>Menu</p>
					<dt>Menu ID</dt>
					<dd><?php echo $obj['menu_id']?>&nbsp;</dd>
					<dt>Descricao</dt>
					<dd><?php echo $obj['descricao']?>&nbsp;</dd>
					<dt>Url</dt>
					<dd><?php echo $obj['url']?>&nbsp;</dd>
					<dt>Posicao</dt>
					<dd><?php echo $obj['posicao']?>&nbsp;</dd>
					<dt>IconCls</dt>
					<dd><?php echo $obj['iconCls']?>&nbsp;</dd>
				</dl>
				<input type='button' value='Editar' class='editar' onclick='window.location="<?php echo $link?>/edit&acao=2&operacao=1&id=<?php echo $obj['id']?>"' />
				<input type='button' name='voltar' value='Voltar' class='voltar' onclick='window.location.href="<?php echo $link?>/index"'/>
			</div>
	</div>
</div>

<?php
$data->fecharConn();
?>
