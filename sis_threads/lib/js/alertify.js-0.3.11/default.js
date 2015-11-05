function reset() {
    $("#toggleCSS").attr("href", "../js/alertify.js-0.3.11/themes/alertify.default.css");
    alertify.set({
        labels: {
            ok: "OK",
            cancel: "Cancelar"
        },
        delay: 5000,
        buttonReverse: false,
        buttonFocus: "ok"
    });
}

// ==============================
// Standard Dialogs
$("#alert").on('click', function() {
    reset();
    alertify.alert("Este é um diálogo de alerta");
    return false;
});

$("#confirm").on('click', function() {
    reset();
    alertify.confirm("Este é um diálogo de confirmação", function(e) {
        if (e) {
            alertify.success("Você clicou em OK");
        } else {
            alertify.error("Você clicou em Cancelar");
        }
    });
    return false;
});

$("#prompt").on('click', function() {
    reset();
    alertify.prompt("Este é um diálogo de aviso", function(e, str) {
        if (e) {
            alertify.success("Você clicou em OK e digitou: " + str);
        } else {
            alertify.error("Você clicou em Cancelar");
        }
    }, "Valor Padrão");
    return false;
});

// ==============================
// Ajax
$("#ajax").on("click", function() {
    reset();
    alertify.confirm("Confirmar?", function(e) {
        if (e) {
            alertify.alert("AJAX bem sucedido depois OK");
        } else {
            alertify.alert("AJAX bem sucedido depois OK Cancelar");
        }
    });
});

// ==============================
// Standard Dialogs
$("#notification").on('click', function() {
    reset();
    alertify.log("Mensagem de log padrão");
    return false;
});

$("#success").on('click', function() {
    reset();
    alertify.success("Mensagem de log Sucesso");
    return false;
});

$("#error").on('click', function() {
    reset();
    alertify.error("Mensagem de log de erro");
    return false;
});

// ==============================
// Custom Properties
$("#delay").on('click', function() {
    reset();
    alertify.set({delay: 10000});
    alertify.log("Escondendo em 10 segundos");
    return false;
});

$("#forever").on('click', function() {
    reset();
    alertify.log("Vai ficar até clicado", "", 0);
    return false;
});

$("#labels").on('click', function() {
    reset();
    alertify.set({labels: {ok: "Aceitar", cancel: "Negar"}});
    alertify.confirm("Diálogo com labels de botão personalizado Confirmar", function(e) {
        if (e) {
            alertify.success("Você clicou em Aceitar");
        } else {
            alertify.error("Você clicou em Negar");
        }
    });
    return false;
});

$("#focus").on('click', function() {
    reset();
    alertify.set({buttonFocus: "cancelar"});
    alertify.confirm("Confirme diálogo com botão cancelar focado", function(e) {
        if (e) {
            alertify.success("Você clicou em OK");
        } else {
            alertify.error("Você clicou em Cancelar");
        }
    });
    return false;
});

$("#order").on('click', function() {
    reset();
    alertify.set({buttonReverse: true});
    alertify.confirm("Confirme diálogo com a ordem invertida botão", function(e) {
        if (e) {
            alertify.success("Você clicou em OK");
        } else {
            alertify.error("Você clicou em Cancelar");
        }
    });
    return false;
});

// ==============================
// Custom Log
$("#custom").on('click', function() {
    reset();
    alertify.custom = alertify.extend("custom");
    alertify.custom("Eu sou uma mensagem de log personalizado");
    return false;
});

// ==============================
// Custom Themes
$("#bootstrap").on('click', function() {
    reset();
    $("#toggleCSS").attr("href", "themes/alertify.bootstrap.css");
    alertify.prompt("Diálogo imediato com tema de bootstrap", function(e) {
        if (e) {
            alertify.success("Você clicou em OK");
        } else {
            alertify.error("Você clicou em Cancelar");
        }
    }, "Valor Padrão");
    return false;
});

$("#voltar").on('click', function() {
    reset();
    alertify.set({labels: {ok: "Voltar", cancel: "N&atilde;o Voltar"}});
    alertify.confirm("Tem certeza que deseja voltar?", function(e) {
        if (e) {
            alertify.success("Voc&ecirc; clicou em Voltar");
        } else {
            alertify.error("Voc&ecirc; clicou em N&atilde;o Voltar");
        }
    });
    return false;
});

$("#editar").on('click', function() {
    reset();
    alertify.alert("Tem certeza que deseja Editar?");
    return false;
});

$("#qual_nome").on('click', function() {
    reset();
    alertify.prompt("Qual &eacute; o seu nome?", function(e, str) {
        if (e) {
            alertify.success("Bem-Vindo: " + str);
        } else {
            alertify.error("Você clicou em Cancelar");
        }
    }, "Digire aqui seu nome");
    return false;
});