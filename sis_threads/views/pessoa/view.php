<?php
require_once 'default.php';
$obj = $data->getPessoa($_REQUEST['id']);
if (!empty($obj['pessoa_id']))
    $objPessoa = $pessoa->getPessoa($obj['pessoa_id']);
if (!empty($obj['tipo_pessoa_id']))
    $objTipoPessoa = $tipoPessoa->getTipoPessoa($obj['tipo_pessoa_id']);
?>

<div id='container'>
    <div id='content'>
        <div class='users view'>
            <dl>
                <p class='header'>Curso</p>
                <dt>Id</dt>
                <dd><?php echo $obj['id'] ?>&nbsp;</dd>
                <dt>Pessoa_id</dt>
                <dd><?php echo $objPessoa['nome'] ?>&nbsp;</dd>
                <dt>Tipo_pessoa_id</dt>
                <dd><?php echo $objTipoPessoa['nome'] ?>&nbsp;</dd>
                <dt>Cpf_cnpj</dt>
                <dd><?php echo $obj['cpf_cnpj'] ?>&nbsp;</dd>
                <dt>Nome</dt>
                <dd><?php echo $obj['nome'] ?>&nbsp;</dd>
                <dt>Email</dt>
                <dd><?php echo $obj['email'] ?>&nbsp;</dd>
                <dt>Endereco</dt>
                <dd><?php echo $obj['endereco'] ?>&nbsp;</dd>
                <dt>Data_insercao</dt>
                <dd><?php echo $obj['data_insercao'] ?>&nbsp;</dd>
                <dt>Fisica_juridica</dt>
                <dd><?php echo $obj['fisica_juridica'] ?>&nbsp;</dd>
                <dt>Telefone</dt>
                <dd><?php echo $obj['telefone'] ?>&nbsp;</dd>
                <dt>Ativo</dt>
                <dd><?php echo $obj['ativo'] ?>&nbsp;</dd>
                <dt>Excluido</dt>
                <dd><?php echo $obj['excluido'] ?>&nbsp;</dd>
            </dl>
            <input type='button' value='Editar' class='editar' onclick='window.location = "<?php echo $link ?>/edit&acao=2&operacao=1&id=<?php echo $obj['id'] ?>"' />
            <input type='button' name='voltar' value='Voltar' class='voltar' onclick='window.location.href = "<?php echo $link ?>/index"'/>
        </div>
    </div>
</div>

<?php
?>
