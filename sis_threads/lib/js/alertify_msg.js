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
            msg = 'N�o foi poss�vel inserir o registro!'
        else if ($('input[name=acao]').val() == 2)
            msg = 'N�o foi poss�vel alterar o registro!'

        alertify.error(msg);
        return false;
    }

    /**
     * Retorna msg de confirma��o
     * @returns {Boolean}
     */
    $.getMsgConfirmAlertFy = function() {
        reset();
        alertify.confirm("Este é um diálogo de confirmação", function(e) {
            if (e) {
                alertify.success("Você clicou em OK");
            } else {
                alertify.error("Você clicou em Cancelar");
            }
        });
        return false;
    }
}); // end document.ready
