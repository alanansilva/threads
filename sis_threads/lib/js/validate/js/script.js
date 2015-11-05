//
//	jQuery Validate example script
//
//	Prepared by David Cochran
//
//	Free for your use -- No warranties, no guarantees!
//

$(document).ready(function() {

    /**
     * 
     * @param {type} tipo_campo
     * @param {type} titulo
     * @returns {_L1._$.inicioMsgValidate.msg|jQuery.inicioMsgValidate.msg|_L11._jQuery._$.inicioMsgValidate.msg|window.jQuery._$.inicioMsgValidate.msg|_L1._jQuery._$.inicioMsgValidate.msg|window.$._$.inicioMsgValidate.msg|Window.$._$.inicioMsgValidate.msg|_jQuery._$.inicioMsgValidate.msg|jQuery._$.inicioMsgValidate.msg|String|_$.inicioMsgValidate.msg}
     */
    $.inicioMsgValidate = function(tipo_campo, descricao) {
        var msg;
        if (tipo_campo == 'text' || tipo_campo == 'textarea')
            msg = 'preencha';
        else if (tipo_campo == 'select' || tipo_campo == 'radio' || tipo_campo == 'checkbox')
            msg = 'selecione';

        msg = 'Por favor ' + msg + ' o campo ' + descricao;

        return msg
    };

    // Validate
    // http://bassistance.de/jquery-plugins/jquery-plugin-validation/
    // http://docs.jquery.com/Plugins/Validation/
    // http://docs.jquery.com/Plugins/Validation/validate#toptions

    $('#contact-form').validate({
        rules: {
            name: {
                minlength: 2,
                required: true
            },
            email: {
                required: true,
                email: true
            },
            email_site: {
                required: true,
                email: true
            },
            subject: {
                minlength: 2,
                required: true
            },
            message: {
                minlength: 2,
                required: true
            }
        },
        highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function(element) {
            element
                    .text('OK!').addClass('valid')
                    .closest('.control-group').removeClass('error').addClass('success');
        }
    });

    /**
     * Valida form de recurso_categoria
     */
    $('#form_recurso_categoria').validate({
        rules: {
            nome: {
                minlength: 2,
                required: true
            }
        },
        messages: {
            nome: $.inicioMsgValidate('text', 'Nome!')
        },
        highlight: function(element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        success: function(element) {
            element.text('OK!').addClass('valid').closest('.control-group').removeClass('error').addClass('success');
        }
    });

    /* JS Mascara para Valores*/
    $(document).ready(function() {
	/*
<div class="btn-group btn-group-lg">
        <button type="button" class="btn btn-default">Left</button>
        <button type="button" class="btn btn-default">Middle</button>
        <button type="button" class="btn btn-default">Right</button>
      </div>
*/
        $(".moeda").after(function() {
            var html = '';
            html += '<div class="group_money">';
            html += '      <b><span class="tipo_moeda" attr_field="#' + this.id + '" attr_value="real">R$</span></b> |';
            html += '      <b><span class="tipo_moeda" attr_field="#' + this.id + '" attr_value="dolar">&#36;</span></b> |';
            html += '      <b><span class="tipo_moeda" attr_field="#' + this.id + '" attr_value="euro">&#128;</span></b>';
            html += '</div>'
            return html;
        });

        $('.tipo_moeda').click(function() {
            var obj = $(this).attr('attr_field');
            var obj_class = $(this).attr('attr_value');

            alert($(this).attr('attr_field'));
            alert($(this).attr('attr_value'));
            
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
                    prefix: 'R$ ',
                    allowNegative: true,
                    thousands: '.',
                    decimal: ',',
                    affixesStay: false
                });
            } else if (obj_class == 'dolar') {
                $('.dolar').maskMoney({
                    prefix: '$ ',
                    allowNegative: true,
                    thousands: '.',
                    decimal: ',',
                    affixesStay: false
                });
            } else if (obj_class == 'euro') {
                $('.euro').maskMoney({
                    prefix: '? ',
                    allowNegative: true,
                    thousands: '.',
                    decimal: ',',
                    affixesStay: false
                });
            }
        });


        $('.real').maskMoney({
            prefix: 'R$ ',
            allowNegative: true,
            thousands: '.',
            decimal: ',',
            affixesStay: false
        });

    });

    /* JS Mascara para formulário */
    $("#telefone_principal").mask("(99) 9999-9999");
    $("#telefone_secundario").mask("(99) 9999-9999");
    $("#celular").mask("(99) 9999-9999");
    $("#telefone").mask("(99) 9999-9999");
    $("#cpf_cnpj").mask("999.999.999-99");
    $("#cep").mask("99.999-999");

}); // end document.ready
