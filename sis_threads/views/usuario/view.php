<?php
require_once('default.php');
$obj = $data->getUsuario($_REQUEST['id']);
$objPerfil = $perfil->getPerfil($obj['perfil_id']);
?>

<div id='container'>
    <div id='content'>
        <div class='users view'>
            <dl>
                <p class='header'>Usuário</p>
                <dt>Nome</dt>
                <dd><?php echo $obj['nome'] ?>&nbsp;</dd>
                <dt>Login</dt>
                <dd><?php echo $obj['login'] ?>&nbsp;</dd>
                <dt>Perfil</dt>
                <dd><?php echo $objPerfil['nome'] ?>&nbsp;</dd>
                <dt>Ativo</dt>
                <dd>
                    <?php
                    if ($obj['ativo'] == 1) {
                        $img = '../../images/drop-yes.gif';
                        $title = 'Sim';
                    } else {
                        $img = '../../images/delete.gif';
                        $title = 'Não';
                    }
                    ?>
                    <img src="<?php echo $img ?>" title="<?php echo $title ?>"/>&nbsp;
                </dd>

            </dl>
            <input type='button' value='Editar' class='editar' onclick='window.location = "<?php echo $link ?>/edit&acao=2&operacao=1&id=<?php echo $obj['id'] ?>"' />
            <input type='button' name='voltar' value='Voltar' class='voltar' onclick='window.location.href = "<?php echo $link ?>/index"'/>
        </div>
    </div>
</div>

<?php
$data->fecharConn();
?>
