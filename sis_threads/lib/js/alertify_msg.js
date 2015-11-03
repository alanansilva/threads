$(document).ready(function() {
    /**
     * Retorna msg de sucesso
     * @returns {Boolean}
     */
    $.getMsgSuccessAlertFy = function() {
        reset();
        var msg;
        if ($('input[name=acao]').val() == 1)
            msg = 'Registro inserido com sucesso!'
        else if ($('input[name=acao]').val() == 2)
            msg = 'Registro alterado com sucesso!'

        alertify.success(msg);
        return false;
    }
    /**
     * Retorna msg de erro
     * @returns {Boolean}
     */
    $.getMsgErrorAlertFy = function() {
        reset();
        var msg;
        if ($('input[name=acao]').val() == 1)
            msg = 'Não foi possível inserir o registro!'
        else if ($('input[name=acao]').val() == 2)
            msg = 'Não foi possível alterar o registro!'

        alertify.error(msg);
        return false;
    }

    /**
     * Retorna msg de confirmação
     * @returns {Boolean}
     */
    $.getMsgConfirmAlertFy = function() {
        reset();
        alertify.confirm("Este Ã© um diÃ¡logo de confirmaÃ§Ã£o", function(e) {
            if (e) {
                alertify.success("VocÃª clicou em OK");
            } else {
                alertify.error("VocÃª clicou em Cancelar");
            }
        });
        return false;
    }
}); // end document.ready
