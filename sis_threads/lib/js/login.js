Login = function(){
    var win, form, submitUrl = 'lib/php/action.php?action=logar';
	var trim = Ext.util.Format.trim;
	
    function Logar(){
        formPanel = Ext.getCmp('my-form');
        
        if (Ext.isEmpty(trim(Ext.get('nome').getValue()))) {
            Ext.MessageBox.show({
                title: 'Erro',
                msg: '<b>Digite um nome!</b>',
                buttons: Ext.MessageBox.OK,
                animEl: 'Botao',
                icon: Ext.MessageBox.ERROR,
                fn: function(){
                    Ext.getCmp('nome').setValue("");
                    Ext.getCmp('nome').focus();
                }
            });
            return false;
        }
        
        if (Ext.isEmpty(trim(Ext.get('senha').getValue()))) {
            Ext.MessageBox.show({
                title: 'Erro',
                msg: '<b>Digite uma senha!</b>',
                buttons: Ext.MessageBox.OK,
                animEl: 'Botao',
                icon: Ext.MessageBox.ERROR,
                fn: function(){
                    Ext.getCmp('senha').setValue("");
                    Ext.getCmp('senha').focus();
                }
            });
            return false;
        }
        
        if (formPanel.form.isValid()) {
			
			formPanel.form.submit({
				waitMsgTarget: false,
				url: 'lib/php/action.php?action=logar',
			   	success: function(form,action) {
/*					Ext.MessageBox.show({
                        msg: "&nbsp;<b>Carregando as configura&ccedil;&otilde;es</b>",
                        progressText: 'Acessando sistema...',
                        width: 500,
                        wait: true,
                        waitConfig: {
                            interval: 200
                        },
                        icon: 'ext-sistema-load',
                        animEl: 'login-win'
                    });
					setTimeout(function(){			    
						win.close();        						
						window.location = 'sistema.php';
			        }, 1500);*/

					//NOVA IMPLEMENTAÇÃO PARA CARREGAR O SISTEMA				
					Ext.MessageBox.show({
//					           title: 'Please wait',
//					           msg: 'Loading ...',
					           title: 'Um momento por favor',
    						   msg: "&nbsp;<b>Carregando as configura&ccedil;&otilde;es</b>",
					           progressText: 'Incializando o sistema...',
					           width:500,
					           progress:true,
					           closable:false,
					           icon: 'ext-sistema-load',
					           animEl: 'login-win'
					       });
					       
				       // this hideous block creates the bogus progress
				       var f = function(v){
//				       	   alert(v);
				            return function(){
				                if(v == 12){
				                    Ext.MessageBox.hide();
				                    Ext.example.msg('Done', 'Your fake items were loaded!');
				                }else{
				                    var i = v/11;
				                    Ext.MessageBox.updateProgress(i, Math.round(100*i)+'% Carregado');
				                }
				           };
				       };
				       for(var i = 1; i < 13; i++){
				           setTimeout(f(i), i*500);
//				           alert(i*500);
				       }
						setTimeout(function(){			    
								win.close();        						
								window.location = 'sistema.php';
					        }, 5500);				       

			   	},
			   	failure: function(form, action){
					Ext.MessageBox.show({
                        title: 'Erro',
                        msg: '<b>Usuario e/ou senha invalidos!</b>',
                        buttons: Ext.MessageBox.OK,
                        animEl: 'Botao',
                        icon: Ext.MessageBox.ERROR
                    });
				}
			});
        }
    }
    
    return {
        Init: function(){
			Ext.BLANK_IMAGE_URL = 'images/default/s.gif';
            Ext.QuickTips.init();
            Ext.form.Field.prototype.msgTarget = 'side';
                        
            var formPanel = new Ext.form.FormPanel({
                id: 'my-form',
                method: 'POST',
                baseParams: {
                    modulo: 'login'
                },
                baseCls: 'x-plain',
                labelWidth: 45,
                labelAlign: 'left',
                onSubmit: function(e){
                    e.stopEvent();
                },
                defaultType: 'textfield',
                layout: 'form',
                defaults: {
                    width: 180,
                    minLength: 3,
                    maxLength: 10,
                    allowBlank: false,
                    selectOnFocus: true,
                    minLengthText: "O campo deve ter no minimo de {0} caracteres",
                    maxLengthText: "O campo deve ter no m&aacute;ximo de {0} caracteres"
                },
                items: [{
                    fieldLabel: "<b>Nome</b>",
                    id: 'nome',
                    name: 'nome',
                    tabIndex: 1,
                    blankText: 'Digite um Nome',
                    validationEvent: "blur",
                    autoCreate: {
                        tag: "input",
                        type: "text",
                        autocomplete: "on",
                        maxLength: 10
                    },
                    fireKey: function(e){
                        if (e.getKey() == e.ENTER) {
                            Ext.getCmp('senha').focus();
                        }
                    }
                }, {
                    fieldLabel: "<b>Senha</b>",
                    id: 'senha',
                    name: 'senha',
                    tabIndex: 2,
                    inputType: 'password',
                    blankText: 'Digite uma Senha'
                }],
                buttonAlign: 'center',
                buttons: [{
                    id: 'Botao',
                    text: 'Entrar',
                    type: 'submit',
                    disabled: false,
                    minButtonWidth: 75,
                    handler: Logar
                }]
            });
            
            // Cria janela de login
            win = new Ext.Window({
                title: 'Acesso ao sistema',
                baseCls: 'x-window',
                width: 285,
                height: 138,
                plain: true,
                layout: 'fit',
                plain: true,
                collapsible: false,
                resizable: false,
                closable: false,
                closeAction: 'hide',
                modal: true,
                border: false,
                keys: [{
                    key: Ext.EventObject.ENTER,
                    fn: function(){
                        if (!(Ext.isEmpty(trim(Ext.get('nome').getValue()))) && !(Ext.isEmpty(trim(Ext.get('senha').getValue())))) {
                            Logar();
                        }
                    },
                    scope: this
                }],
                items: formPanel,
                focus: function(){
                    Ext.get('nome').focus();
                }
            });
        win.show(this);
        }
    };
}();

Ext.onReady(Login.Init, Login, true);
