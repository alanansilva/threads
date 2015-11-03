$(document).ready(function () {


    /**
     * Exibe um modal de confirmação para persitênia via ajax
     * @param {type} msg
     * @param {type} form
     * @param {type} url
     * @returns {bollean}
     */
    $.getMsgAjaxSubmitForm = function (msg, form, url) {
        bootbox.confirm(msg, function (e) {
            if (e)
                $.ajaxSubmitForm(form, url);
        });
    }

    /**
     * Exibe um modal de confirmação para persitênia via ajax com arquivo
     * @param {type} msg
     * @param {type} form
     * @param {type} url
     * @returns {bollean}
     */
    $.getMsgAjaxSubmitFormUpload = function (msg, form, url) {
        bootbox.confirm(msg, function (e) {
            if (e)
                $.ajaxSubmitFormUpload(form, url);
        });
    }
// Efeito Caixa de alerta
    $('<div id="box_alert_conte_ger"><div class="box_alert_ger" id="box_alert_inter"><div><h4 class="box_alert_ger_tit">Aguarde...</h4><img src="http://74.63.255.164/curl/motor_reserva/images/loading.gif" alt="Carregando"></div></div><div class="box_alert_mask"></div></div>').prependTo('body');
    $.boxAlertGer = function () {
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();

        var winH = $(window).height();
        var winW = $(window).width();

        $('.box_alert_mask').css({'width': maskWidth, 'height': maskHeight});

        $('.box_alert_mask').fadeIn(700);
        $('.box_alert_mask').fadeTo("slow", 0.8);

        $('#box_alert_inter').css('top', winH / 2 - $('.box_alert_ger').height() / 2);
        $('#box_alert_inter').css('left', winW / 2 - $('.box_alert_ger').width() / 2);

        $('#box_alert_inter').fadeIn(700);
    };
    /**
     * 
     * @param {string} form
     * @param {string} url
     * @returns {Boolean}
     */
    $.ajaxSubmitForm = function (form, url) {
        var dados = $(form).serialize();
        $.ajax({
            type: "post",
            url: url,
            data: dados,
            dataType: "json",
            beforeSend: function () {
                $(".btn").addClass('disabled');
                $.boxAlertGer();
            },
            complete: function () {
                $(".btn").removeClass('disabled');
            },
            success: function (data) {
                if (data.success == 1)
                    $.getMsgSuccessAlertFy();
                else if (data.success == 0)
                    $.getMsgErrorAlertFy();

                $('.box_alert_mask').fadeOut(400);
                $('.box_alert_ger').fadeOut(400);
            }
        });
        return false;
    }

    $.ajaxSubmitFormUpload = function (form, url) {

        var bar = $('.bar');
        var percent = $('.percent');
        var status = $('#status');

        var options = {
            url: url,
            type: "post",
            beforeSubmit: function () {
                $(".btn").addClass('disabled');
                status.empty();
                var percentVal = '0%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            uploadProgress: function (event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
//                console.log(percentVal, position, total);
//                console.log(event);
            },
            complete: function (xhr) {
                $(".btn").removeClass('disabled');
//                console.log(xhr);
//                status.html(xhr.responseText);
            },
            success: function (data) {

                var percentVal = '100%';
                bar.width(percentVal)
                percent.html(percentVal);

                if (data.success == 1) {
                    $.getMsgSuccessAlertFy();
                } else if (data.success == 0) {
                    $.getMsgErrorAlertFy();
                }
            }
        }
        $(form).ajaxSubmit(options);
        //$(form).resetForm();
        return false;
    }


    /**
     * Persiste a exclusão via ajax
     * @param {integer} id
     * @param {string} url
     * @param {string} row_id
     * @returns {Boolean}
     */
    $.ajaxDelete = function (id, url, row_id) {
        $.ajax({
            type: "post",
            url: url + '?id=' + id + '&acao=3&operacao=2',
            dataType: "json",
            beforeSend: function () {
                $("#" + row_id).addClass('danger');
            },
            success: function (data) {
                if (data.success == 1) {
                    reset();
                    $("#" + row_id).hide();
                    $("#" + row_id).removeClass('danger');
                    alertify.success('Registro excluído com sucesso!');
                    return false;
                } else if (data.success == 0) {
                    reset();
                    $("#" + row_id).removeClass('danger');
                    alertify.error('Não foi possível exclui o registro!');
                    return false;
                }
            }
        });
        return false;
    }

    $('.delete').click(function () {

        var obj = $(this);
        bootbox.confirm('Deseja realmente excluir o registro?', function (e) {
            if (e)
                $.ajaxDelete(obj.attr('data-delete-id'), obj.attr('data-delete-url'), obj.attr('data-row-id'));
        });
    });

    /**
     * 
     * @param {type} tipo_campo
     * @param {type} titulo
     * @returns {_L1._$.inicioMsgValidate.msg|jQuery.inicioMsgValidate.msg|_L11._jQuery._$.inicioMsgValidate.msg|window.jQuery._$.inicioMsgValidate.msg|_L1._jQuery._$.inicioMsgValidate.msg|window.$._$.inicioMsgValidate.msg|Window.$._$.inicioMsgValidate.msg|_jQuery._$.inicioMsgValidate.msg|jQuery._$.inicioMsgValidate.msg|String|_$.inicioMsgValidate.msg}
     */
    $.inicioMsgValidate = function (tipo_campo, descricao) {
        var msg;
        if (tipo_campo == 'text' || tipo_campo == 'textarea')
            msg = 'preencha';
        else if (tipo_campo == 'select' || tipo_campo == 'radio' || tipo_campo == 'checkbox')
            msg = 'selecione';

        msg = 'Por favor ' + msg + ' o campo ' + descricao;

        return msg
    };


    /* JS Mascara para Valores*/
    /*
     <div class="btn-group btn-group-lg">
     <button type="button" class="btn btn-default">Left</button>
     <button type="button" class="btn btn-default">Middle</button>
     <button type="button" class="btn btn-default">Right</button>
     </div>
     */
    $(".formata_moeda").after(function () {
        var html = '';
        html += '<div class="btn-group btn-group-lg group_money">';
        html += '   <button type="button" class="tipo_moeda btn btn-default btn-xs" attr_field="#' + this.id + '" attr_value="real">R$</button>';
        html += '   <button type="button" class="tipo_moeda btn btn-default btn-xs" attr_field="#' + this.id + '" attr_value="dolar">&#36;</button>';
        html += '   <button type="button" class="tipo_moeda btn btn-default btn-xs" attr_field="#' + this.id + '" attr_value="euro">&#128;</button>';
        html += '</div>'
        return html;
    });
    $(".percent-valor").after(function () {
        var html = '';
        html += '<div class="btn-group btn-group-lg group_money">';
        html += '   <button type="button" class="tipo_valor btn btn-default btn-xs" attr_field="#' + this.id + '" attr_value="1">%</button>';
        html += '   <button type="button" class="tipo_valor btn btn-default btn-xs" attr_field="#' + this.id + '" attr_value="0">$</button>';
        html += '</div>'
        return html;
    });

    $('.tipo_moeda').click(function () {
        var obj = $(this).attr('attr_field');
        var obj_class = $(this).attr('attr_value');

//            alert($(this).attr('attr_field'));
//            alert($(this).attr('attr_value'));

        /**
         * Remove as formatações de moeda
         */
        $(obj).removeClass('real');
        $(obj).removeClass('dolar');
        $(obj).removeClass('euro');

        /**
         * Adiciona classe de moeda
         */
        $(obj).addClass(obj_class);

        if (obj_class == 'real') {
            $('.real').maskMoney({
                prefix: '',
                allowNegative: true,
                thousands: '.',
                decimal: ',',
                affixesStay: false
            });
        } else if (obj_class == 'dolar') {
            $('.dolar').maskMoney({
                prefix: '',
                allowNegative: true,
                thousands: ' ',
                decimal: ',',
                affixesStay: false
            });
        } else if (obj_class == 'euro') {
            $('.euro').maskMoney({
                prefix: '',
                allowNegative: true,
                thousands: ' ',
                decimal: ',',
                affixesStay: false
            });
        }
    });

    $('.real').maskMoney({
        prefix: '',
        allowNegative: true,
        thousands: '.',
        decimal: ',',
        affixesStay: false
    });

    $('.moeda_default').maskMoney({
        prefix: '',
        allowNegative: true,
        thousands: '.',
        decimal: ',',
        affixesStay: false
    });

    $('.skin-minimal input').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue',
        increaseArea: '20%'
    });

    /* JS Mascara para formulário */
    $("#telefone_principal").mask("(99) 9999-9999");
    $("#telefone_secundario").mask("(99) 9999-9999");
    $("#celular").mask("(99) 9999-9999");
    $("#telefone").mask("(99) 9999-9999");
    //$("#cpf_cnpj").mask("999.999.999-99");
    $("#cep").mask("99.999-999");
    $(".cpf").mask("999.999.999-99");
    $(".cnpj").mask("99.999.999/9999-99");
    $(".data_mascara").mask("99/99/9999");


    $('.data').datepicker({
        format: "dd/mm/yyyy",
        language: "pt-BR",
        autoclose: true
    });


    $('div[class*="col-md"] label[for]').addClass('control-label');
// $('div[class*="col-md"] input, div[class*="col-md"] label[for]').wrapAll('<div class="control-group"></div>');
    $('div[class*="col-md"] label[for]').parent().addClass('control-group');

    $('.container_listagem .actions a#pesquisar').prepend('<span class="glyphicon glyphicon-search" style="margin:0 5px 0 0;"></span>');
    $('.container_listagem .actions a#add').prepend('<span class="glyphicon glyphicon-plus-sign" style="margin:0 5px 0 0;"></span>');
    $('.container_listagem .actions a#voltar_pag').prepend('<span class="glyphicon glyphicon-circle-arrow-left" style="margin:0 5px 0 0;"></span>');
    $('.container-fluid > form').addClass('well').css('background-color', '#f2f2f2;');

    /* Efeito na página de relatório e reservas */
    $dashboardHtml = $('.total_valor_ger_sup').html();
    $('#tabela_list_reserv_ger').before($dashboardHtml);
    $('.total_valor_ger_sup').remove(); 
}); // end document.ready