<?php

class Paginacao {
    /* ==============================================================================
      ' Name: Paginacao
      ' Purpose: Componente criado para prover pagina��o nas p�ginas de consulta do
      '          Framework a partir de uma cole��o.
      ' Remarks:
      ' Functions:
      ' Properties:
      ' Methods:
      ' Author:
      ' Started:
      ' Modified:
      '============================================================================= */

//IMPLEMENTA��O DO OBJETO: Pagina��o
//############################################################################
//#								ATRIBUTOS									 #
//############################################################################

    /* ==============================================================================
      ' Name: colecao
      ' Input:
      ' Output:
      '   Collection - Cole��o de registros
      ' Purpose:
      ' Visibility: Public
      ' Remarks:
      '============================================================================= */
    var $colecao;

    /* ==============================================================================
      ' Name: $qtdRegistros
      ' Input:
      ' Output:
      ' Purpose: Quantidade de registros contidos no objeto Collection do
      '          Framework.
      ' Visibility: Public
      ' Remarks:
      '============================================================================= */
    var $qtdRegistros;

    /* ==============================================================================
      ' Name: _qtdPorPagina
      ' Input:
      ' Output:
      ' Purpose: Quantidade de registros que ser�o exibidos na tela por p�gina.
      ' Visibility: Private
      ' Remarks:
      '============================================================================= */
    var $_qtdPorPagina;

    /* ==============================================================================
      ' Name: _msgPaginacao
      ' Input:
      ' Output:
      ' Purpose: Mensagem que ser� mostrada na tela referente a pagina��o, nesta mensagem
      '          aparecer�o os �ndices inicial e final de cada p�gina, um input com a
      '          possibilidade de alterar a quantidade de registros por p�gina e os links
      '          de Anterior e Pr�ximo.
      ' Visibility: Private
      ' Remarks:
      '============================================================================= */
    var $_msgPaginacao;

    /* ==============================================================================
      ' Name: _indInicio
      ' Input:
      ' Output:
      ' Purpose: N�mero do registro inicial para a p�gina corrente.
      ' Visibility: Private
      ' Remarks:
      '============================================================================= */
    var $_indInicio;

    /* ==============================================================================
      ' Name: _indFinal
      ' Input:
      ' Output:
      ' Purpose: N�mero do registro final para a p�gina corrente.
      ' Visibility: Public
      ' Remarks:
      '============================================================================= */
    var $_indFinal;

    /* ==============================================================================
      ' Name: _strLink
      ' Input:
      ' Output:
      ' Purpose: Todas as vari�veis que foram passadas atrav&eacute;s de POST ou GET pela
      '          p�gina de busca.
      ' Visibility: Private
      ' Remarks:
      '============================================================================= */
    var $_strLink;

    /* ==============================================================================
      ' Name: _linkProximo
      ' Input:
      ' Output:
      ' Purpose: Link chamando a p�gina de busca adicionando os par�metros necess�rios
      '          � pagina��o.
      ' Visibility: Public
      ' Remarks:
      '============================================================================= */
    var $_linkProximo;

    /* ==============================================================================
      ' Name: _linkAnterior
      ' Input:
      ' Output:
      ' Purpose: Link chamando a p�gina de busca adicionando os par�metros necess�rios
      '          � pagina��o.
      ' Visibility: Private
      ' Remarks:
      '============================================================================= */
    var $_linkAnterior;

    /* ==============================================================================
      ' Name: _nomePagina
      ' Input:
      ' Output:
      ' Purpose: Nome da p�gina que est� efetuando a busca.
      ' Visibility: Public
      ' Remarks:
      '============================================================================= */
    var $_nomePagina;

//###########################################################################
//#								CONTROLADORES								#
//###########################################################################

    /* ==============================================================================
      ' Name: Paginacao
      ' Input:
      ' Output:
      ' Purpose: Construtor do componente onde s�o efetuadas as atribui��es padr�o.
      ' Visibility: Public
      ' Remarks:
      '============================================================================= */
    function Paginacao($objCollection, $qtdPaginas = 20) {
        $this->_preencheNomePagina();
        $this->_qtdPorPagina = $qtdPaginas; //'Valor Padr�o		
        $this->_montaLinks();
        $this->_preencheColecao($objCollection);
    }

    /* ==============================================================================
      ' Name:
      ' Input:
      '   objCollection as Collection - Cole��o contendo os dados da busca
      ' Output:
      ' Purpose: Neste m&eacute;todo &eacute; preparada uma nova cole��o para preenchimento dos dados
      '          necess�rios � exibi��o da tela de acordo com os �ndices final e inicial,
      '          montando tamb&eacute;m a mensagem que dever� ser exibida na tela.
      ' Visibility: Private
      ' Remarks:
      '============================================================================= */

    function _preencheColecao($objCollection) {

        $obj = null;
        $indice = null;
        $numPagina = null;
        $qtdPagina = null;

        $this->colecao = new Collection();

        $this->qtdRegistros = $objCollection->Count();


        If ($this->qtdRegistros > 0) {

            $indice = 0;

            if (isset($_GET["paginacaoIndiceInicio"]) && $_GET["paginacaoIndiceInicio"] != "") {
                $this->_indInicio = $_GET["paginacaoIndiceInicio"];
            } else {
                $this->_indInicio = 1;
            }

            if (isset($_GET["paginacaoIndiceFinal"]) && $_GET["paginacaoIndiceFinal"] != "") {
                $this->_indFinal = $_GET["paginacaoIndiceFinal"];
            } else {
                $this->_indFinal = $this->_qtdPorPagina;
            }

            if ($this->_indFinal >= $this->qtdRegistros) {
                $this->_indFinal = $this->qtdRegistros;
            }

            While ($objCollection->Proximo()) {
                $indice = $indice + 1;
                $obj = $objCollection->getItem();
                if ($indice >= $this->_indInicio && $indice <= $this->_indFinal) {
                    $this->colecao->add($obj);
                }
                $obj = null;
            }

            if ($this->_indInicio == 1) {
                $this->_linkAnterior = "&lt;&lt;Anterior";

                if ($this->qtdRegistros <= $this->_indFinal) {
                    $this->_linkProximo = "Pr&oacute;xima&gt;&gt;";
                } else {
                    $this->_linkProximo = "<a href=\"" . $this->_nomePagina . "?" . $this->_linkProximo . "&paginacaoIndiceInicio=" . ( $this->_indFinal + 1 ) . "&paginacaoIndiceFinal=" . ($this->_indFinal + $this->_qtdPorPagina) . "&paginacaoQtdPorPagina=" . $this->_qtdPorPagina . "\">Pr&oacute;xima&gt;&gt;</a>";
                }
            } else {
                $this->_linkAnterior = "<a href=\"" . $this->_nomePagina . "?" . $this->_linkAnterior . "&paginacaoIndiceInicio=" . ( $this->_indInicio - $this->_qtdPorPagina ) . "&paginacaoIndiceFinal=" . ( $this->_indInicio - 1 ) . "&paginacaoQtdPorPagina=" . $this->_qtdPorPagina . "\">&lt;&lt;Anterior</a>";

                if ($this->qtdRegistros <= $this->_indFinal) {
                    $this->_linkProximo = "Pr&oacute;xima&gt;&gt;";
                } else {
                    $this->_linkProximo = "<a href=\"" . $this->_nomePagina . "?" . $this->_linkProximo . "&paginacaoIndiceInicio=" . ( $this->_indFinal + 1 ) . "&paginacaoIndiceFinal=" . ( $this->_indFinal + $this->_qtdPorPagina ) . "&paginacaoQtdPorPagina=" . $this->_qtdPorPagina . "\">Pr&oacute;xima&gt;&gt;</a>";
                }
            }

            $qtdPagina = 0;
            $numPagina = 0;
            if ($this->_qtdPorPagina > 0) {
                $qtdPagina = round($this->qtdRegistros / $this->_qtdPorPagina); //N�mero de p�ginas
                $numPagina = round($this->_indFinal / $this->_qtdPorPagina); //N�mero da p�gina
            }

            if ($this->_qtdPorPagina > $this->_indFinal) {
                $this->_qtdPorPagina = $this->_indFinal;
            }

            $this->_msgPaginacao = " Exibindo de <b>"
                    . $this->_indInicio . " a "
                    . $this->_indFinal
                    . "</b>.<br> Registro(s) por p&aacute;gina <input type='text' name='paginacaoQtdPorPagina' size='3' maxlength='4' value='"
                    . $this->_qtdPorPagina
                    . "' style='border: 1 solid black; font-size: 8pt; font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; color: Black; text-align: center' onBlur=\"javascript: (isNaN(this.value)?alert('Somente n&uacute;meros'):(this.value >= "
                    . $this->qtdRegistros
                    . "?location.href='"
                    . $this->_nomePagina
                    . "?"
                    . $this->_strLink
                    . "&paginacaoIndiceInicio=1&paginacaoIndiceFinal="
                    . $this->qtdRegistros
                    . "&paginacaoQtdPorPagina="
                    . $this->qtdRegistros
                    . "':location.href='"
                    . $this->_nomePagina
                    . "?"
                    . $this->_strLink
                    . "&paginacaoIndiceInicio=1&paginacaoIndiceFinal=' + (this.value>0?this.value:"
                    . $this->_qtdPorPagina . ") + '&paginacaoQtdPorPagina=' + (this.value>0?this.value:"
                    . $this->_qtdPorPagina . ")));\">&nbsp;&nbsp;"
                    . $this->_linkAnterior . "&nbsp;&nbsp;&nbsp;"
                    . $this->_linkProximo;
        }
    }

    /* ==============================================================================
      ' Name: Sub montaLinks
      ' Input:
      ' Output:
      ' Purpose: Este m&eacute;todo tem por objetivo remontar os par�metros enviados via p�gina
      '          de busca por GET ou POST.
      ' Visibility: Private
      ' Remarks:
      '============================================================================= */

    function _montaLinks() {
        $Key = null;
        $Value = null;
        $temp = "";

        $this->_strLink = "";

        $request = $_POST + $_GET;

        foreach ($request as $Key => $Value) {

            if (($Key != "paginacaoIndiceInicio") && ($Key != "paginacaoIndiceFinal") && ($Key != "paginacaoQtdPorPagina")) {

                if ($this->_strLink != "") {
                    $this->_strLink .= "&";
                }

                $temp = $Value;
                if ($temp == "%") {
                    $temp = "%25";
                }

                $this->_strLink .= $Key . "=" . $temp;
            }
        }

        if (isset($request["paginacaoQtdPorPagina"]) && $request["paginacaoQtdPorPagina"] != "") {
            $this->_qtdPorPagina = $request["paginacaoQtdPorPagina"];
        }

        $this->_linkAnterior = $this->_strLink;
        $this->_linkProximo = $this->_strLink . '&frag=fragment-4';
    }

    /* ==============================================================================
      ' Name: _preencheNomePagina
      ' Input:
      ' Output:
      ' Purpose: Pegar o nome da p�gina que est� efetuando a busca.
      ' Visibility: Private
      ' Remarks:
      '============================================================================= */

    function _preencheNomePagina() {
        $pagina = null;
        $pagina = strrev($_SERVER["PATH_INFO"]);
        $pagina = substr($pagina, 0, (strpos($pagina, "/")));
        $pagina = strrev($pagina);
        $this->_nomePagina = $pagina;
    }

    /* ==============================================================================
      ' Name: Property Get getMsgPaginacao
      ' Input:
      ' Output:
      '   msgPaginacao - Mensagem a ser mostrada na pagina��o.
      ' Purpose: M&eacute;todo para pegar - Mensagem da pagina��o.
      ' Remarks:
      '============================================================================= */

    function getMsgPaginacao() {
        return $this->_msgPaginacao;
    }

}

?>