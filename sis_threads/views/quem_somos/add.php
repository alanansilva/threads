<?php
require_once 'default.php';
if ($_REQUEST['acao'] == 1 && $_REQUEST['operacao'] == 1) {
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h5 class="h5_tit_bor_bottom">
                    Cadastrar quem_somos
                </h5>
            </div>
        </div>
        <form id="form_quem_somos" name="form_quem_somos" method="post" action="<?php echo $link ?>/add" role="form">
            <input type="hidden" name="acao" value="1"/>
            <input type="hidden" name="operacao" value="2"/>
            <div class="row">
                <div class="col-md-4">
                    <label for="titulo">* Titulo</label>
                    <input type='text' name='titulo'  id='titulo' class='form-control'   placeholder="Titulo">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="subtitulo">* Subtitulo</label>
                    <input type='text' name='subtitulo'  id='subtitulo' class='form-control'   placeholder="Subtitulo">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                <div class="form-group" data-toggle="tooltip" data-placement="top" title="Tamanho: 620px X 385px">
                   <label for="imagem">* Imagem</label>
                   <input type='file' name='imagem[]'  id='imagem' class='form-control' multiple placeholder="Imagem">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <!-- UPLOAD PROGRESS-->
                    <div class="progress">
                        <div class="bar"></div >
                        <div class="percent">0%</div >
                    </div>
                    <div id="status"></div>
                    <!-- UPLOAD PROGRESS-->
                </div>
            </div>
            <div class="divisor_row_marg_top"></div>
            <input type="submit" class="btn btn-success" name="salvar" id="salvar" value="Salvar"/>
            <input type="button" class="btn btn-primary" name="voltar" value="Voltar" onclick="window.location.href = '<?php echo $link ?>/index'"/>
        </form>
    </div>
    <?php
    if ($_REQUEST['msgErro'] != "") {
        echo '<div class="message">' . $_REQUEST['msgErro'] . '</div>';
    } elseif ($_REQUEST['msgOK'] != "") {
        echo '<div class="message">' . $_REQUEST['msgOK'] . '</div>';
    }
}
if ($_REQUEST['acao'] == 1 && $_REQUEST['operacao'] == 2) {
    if ($data->add()) {
        $msgOK = 'Registro inserido com sucesso!';
    } else {
        $msgErro = 'Não foi possível inserir o registro!';
    }
    header('location:' . $link . '/add&acao=1&operacao=1&msgOK=' . $msgOK . '&msgErro=' . $msgErro);
}
?>
