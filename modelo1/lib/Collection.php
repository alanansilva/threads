<?php
class Collection {

/*==============================================================================
' Name: Collection
' Purpose: Classe respons�vel por armazenar inst�ncias deobjetos primitivos
' Remarks:
' Functions:
' Properties:
' Methods:
' Author: FoxQuiz (foxquiz@yahoo.com.br).
' Started: 
' Modified: 
'=============================================================================*/

/*===============================================================================
' Name: _elementos
' Input:
' Output:
'   Object - Guarda objetos.
' Purpose: armazenar os objetos em um vetor.
' Remarks: Atributo do tipo privado.
'=============================================================================*/
	var $_elementos;

/*===============================================================================
' Name: _qtdElementos
' Input:
' Output:
'   Integer - Guarda a quantidade de elementos da cole��o.
' Purpose: 
' Remarks: Atributo do tipo privado.
'=============================================================================*/
	var $_qtdElementos;

/*===============================================================================
' Name: posAtual
' Input:
' Output:
'   Integer - Informa a posi��o do cursor na cole��o.
' Purpose: 
' Remarks: Atributo do tipo p�blico.
'=============================================================================*/
	var $posAtual;

/*==============================================================================
' Name: function Collection
' Input:
' Output:
' Purpose: Construtor simples da Classe.
' Remarks: Executa o m�todo Clear para limpar a cole��o quando instanciado.
'============================================================================*/
	function Collection(){
		$this->Clear();
	}

/*==============================================================================
' Name: function Inicio
' Input:
' Output:
' Purpose: coloca o cursor no in�cio da cole��o.
' Remarks:
'============================================================================*/
	function Inicio(){
		$this->posAtual = 0;
	}

/*==============================================================================
' Name: function isInicio
' Input:
' Output:
' Purpose: verifica se o cursor aponta para o in�cio da cole��o.
' Remarks:
'============================================================================*/
	function isInicio(){
		if ( $this->posAtual == 0 ){
			return true;
		}else{
			return false;
		}
	}

/*==============================================================================
' Name: function IsVazio
' Input:
' Output:
' Purpose: verifica se o cursor aponta para o in�cio da cole��o.
' Remarks:
'============================================================================*/
	function IsVazio(){
		if ( $this->Count() > 0 ){
			return false;
		}else{
			return true;
		}
	}

/*==============================================================================
' Name: function Proximo
' Input:
' Output:
'   Boolean: Identifica se h� um outro objeto.
' Purpose: retorna o elemento a partir da posi��o do cursor.
' Remarks: incrementa o cursor.
'============================================================================*/
	function Proximo(){
		$bool = ($this->posAtual < $this->Count());
		return ( $bool );
	}

/*==============================================================================
' Name: function Count
' Input:
' Output:
' Purpose: retorna a quantidade de elementos da cole��o.
' Remarks: 
'============================================================================*/
	function Count(){
		return $this->_qtdElementos;
	}

/*==============================================================================
' Name: function Clear
' Input:
' Output:
' Purpose: limpa a colecao.
' Remarks: 
'============================================================================*/
	function Clear(){
		$this->_qtdElementos = 0;
		$this->_elementos[] = array();
		$this->Inicio();
	}

/*==============================================================================
' Name: function Add
' Input:
' Output:
' Purpose: adiciona um elemento na posi��o do cursor.
' Remarks: 
'============================================================================*/
	function Add( &$newElemento ){
		$this->_qtdElementos++;
		$this->_elementos[ $this->_qtdElementos-1 ] = $newElemento;
	}

/*==============================================================================
' Name: function getItem
' Input:
' Output:
' Purpose: retorna um elemento da cole��o em uma determinada posi��o.
' Remarks: 
'============================================================================*/
	function getItem(){
		$posTemp = $this->posAtual;
		$this->posAtual++;
		return $this->_elementos[ $posTemp ];
	}
        
        public function asortCollection() {
            asort($this->_elementos);
        }

}
?>