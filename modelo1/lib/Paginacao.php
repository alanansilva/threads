<?php

class Paginacao {
    /* ==============================================================================
      ' Name: Paginacao
      ' Purpose: Componente criado para prover paginação nas páginas de consulta do
      '          Framework a partir de uma coleção.
      ' Remarks:
      ' Functions:
      ' Properties:
      ' Methods:
      ' Author:
      ' Started:
      ' Modified:
      '============================================================================= */

//IMPLEMENTAÇÃO DO OBJETO: Paginação
//############################################################################
//#								ATRIBUTOS									 #
//############################################################################

    /* ==============================================================================
      ' Name: colecao
      ' Input:
      ' Output:
      '   Collection - Coleção de registros
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
      ' Purpose: Quantidade de registros que serão exibidos na tela por página.
      ' Visibility: Private
      ' Remarks:
      '============================================================================= */
    var $_qtdPorPagina;

    /* ==============================================================================
      ' Name: _msgPaginacao
      ' Input:
      ' Output:
      ' Purpose: Mensagem que será mostrada na tela referente a paginação, nesta mensagem
      '          aparecerão os índices inicial e final de cada página, um input com a
      '          possibilidade de alterar a quantidade de registros por página e os links
      '          de Anterior e Próximo.
      ' Visibility: Private
      ' Remarks:
      '============================================================================= */
    var $_msgPaginacao;

    /* ==============================================================================
      ' Name: _indInicio
      ' Input:
      ' Output:
      ' Purpose: Número do registro inicial para a página corrente.
      ' Visibility: Private
      ' Remarks:
      '============================================================================= */
    var $_indInicio;

    /* ==============================================================================
      ' Name: _indFinal
      ' Input:
      ' Output:
      ' Purpose: Número do registro final para a página corrente.
      ' Visibility: Public
      ' Remarks:
      '============================================================================= */
    var $_indFinal;

    /* ==============================================================================
      ' Name: _strLink
      ' Input:
      ' Output:
      ' Purpose: Todas as variáveis que foram passadas atrav&eacute;s de POST ou GET pela
      '          página de busca.
      ' Visibility: Private
      ' Remarks:
      '============================================================================= */
    var $_strLink;

    /* ==============================================================================
      ' Name: _linkProximo
      ' Input:
      ' Output:
      ' Purpose: Link chamando a página de busca adicionando os parâmetros necessários
      '          à paginação.
      ' Visibility: Public
      ' Remarks:
      '============================================================================= */
    var $_linkProximo;

    /* ==============================================================================
      ' Name: _linkAnterior
      ' Input:
      ' Output:
      ' Purpose: Link chamando a página de busca adicionando os parâmetros necessários
      '          à paginação.
      ' Visibility: Private
      ' Remarks:
      '============================================================================= */
    var $_linkAnterior;

    /* ==============================================================================
      ' Name: _nomePagina
      ' Input:
      ' Output:
      ' Purpose: Nome da página que está efetuando a busca.
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
      ' Purpose: Construtor do componente onde são efetuadas as atribuições padrão.
      ' Visibility: Public
      ' Remarks:
      '============================================================================= */
    function Paginacao($objCollection, $qtdPaginas = 20) {
        $this->_preencheNomePagina();
        $this->_qtdPorPagina = $qtdPaginas; //'Valor Padrão		
        $this->_montaLinks();
        $this->_preencheColecao($objCollection);
    }

    /* ==============================================================================
      ' Name:
      ' Input:
      '   objCollection as Collection - Coleção contendo os dados da busca
      ' Output:
      ' Purpose: Neste m&eacute;todo &eacute; preparada uma nova coleção para preenchimento dos dados
      '          necessários à exibição da tela de acordo com os índices final e inicial,
      '          montando tamb&eacute;m a mensagem que deverá ser exibida na tela.
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
                $qtdPagina = round($this->qtdRegistros / $this->_qtdPorPagina); //Número de páginas
                $numPagina = round($this->_indFinal / $this->_qtdPorPagina); //Número da página
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
      ' Purpose: Este m&eacute;todo tem por objetivo remontar os parâmetros enviados via página
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
      ' Purpose: Pegar o nome da página que está efetuando a busca.
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
      '   msgPaginacao - Mensagem a ser mostrada na paginação.
      ' Purpose: M&eacute;todo para pegar - Mensagem da paginação.
      ' Remarks:
      '============================================================================= */

    function getMsgPaginacao() {
        return $this->_msgPaginacao;
    }

}

?>