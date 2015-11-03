<?php

class PaginacaoLink extends Paginacao {

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
    function PaginacaoLink($objCollection, $qtdPaginas = 20, $link) {
        $this->_preencheNomePagina($link);
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

            while ($objCollection->Proximo()) {
                $indice = $indice + 1;
                $obj = $objCollection->getItem();
                if ($indice >= $this->_indInicio && $indice <= $this->_indFinal) {
                    $this->colecao->add($obj);
                }
                $obj = null;
            }

            if ($this->_indInicio == 1) {
                $this->_linkAnterior = "<a href='javascript:void(0)'>&larr; Anterior</a>";

                if ($this->qtdRegistros <= $this->_indFinal) {
                    $this->_linkProximo = "<a href='javascript:void(0)'>Próximo &rarr;</a>";
                } else {
                    $this->_linkProximo = "<a style='color:red; text-decoration:none;' href=\"" . $this->_nomePagina . "?" . $this->_linkProximo . "&paginacaoIndiceInicio=" . ( $this->_indFinal + 1 ) . "&paginacaoIndiceFinal=" . ($this->_indFinal + $this->_qtdPorPagina) . "&paginacaoQtdPorPagina=" . $this->_qtdPorPagina . "\">Próximo &rarr;</a>";
                }
            } else {
                $this->_linkAnterior = "<a style='color:red; text-decoration:none;' href=\"" . $this->_nomePagina . "?" . $this->_linkAnterior . "&paginacaoIndiceInicio=" . ( $this->_indInicio - $this->_qtdPorPagina ) . "&paginacaoIndiceFinal=" . ( $this->_indInicio - 1 ) . "&paginacaoQtdPorPagina=" . $this->_qtdPorPagina . "\">&larr; Anterior</a>";

                if ($this->qtdRegistros <= $this->_indFinal) {
                    $this->_linkProximo = "<a href='javascript:void(0)'>Próximo &rarr;</a>";
                } else {
                    $this->_linkProximo = "<a style='color:red; text-decoration:none;' href=\"" . $this->_nomePagina . "?" . $this->_linkProximo . "&paginacaoIndiceInicio=" . ( $this->_indFinal + 1 ) . "&paginacaoIndiceFinal=" . ( $this->_indFinal + $this->_qtdPorPagina ) . "&paginacaoQtdPorPagina=" . $this->_qtdPorPagina . "\">Próximo &rarr;</a>";
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
            $this->_nomePagina = 'app.php?';
            $this->_msgPaginacao = " Foi encontrado um total de <b class='paginacao_num'>" . $this->qtdRegistros . "</b> registro(s). <br>"
                    . "Exibindo de <b class='paginacao_num'>" . $this->_indInicio . "</b>"
                    . " a <b class='paginacao_num'>" . $this->_indFinal . "</b> registro(s)."
                    . "<span>Registro(s) por p&aacute;gina:</span> <input type='text' name='paginacaoQtdPorPagina' class='form-control input-small' "
                    . "size='3' maxlength='4' value='"
                    . $this->_qtdPorPagina . "'style='font-size: 8pt; text-align: center; display:inline; width:32px; height:22px; padding:1px; border-color: #f0ad4e; color: #f0ad4e; vertical-align: -webkit-baseline-middle;'"
                    . "onBlur=\"javascript: (isNaN(this.value)?alert('Somente n&uacute;meros'):(this.value >= "
                    . $this->qtdRegistros . "?window.location.href='" . $this->_nomePagina
                    . $this->_strLink
                    . "&paginacaoIndiceInicio=1&paginacaoIndiceFinal=" . $this->qtdRegistros
                    . "&paginacaoQtdPorPagina="
                    . $this->qtdRegistros . "':window.location.href='" . $this->_nomePagina
                    . $this->_strLink . "&paginacaoIndiceInicio=1&paginacaoIndiceFinal=' + "
                    . "(this.value>0?this.value:" . $this->_qtdPorPagina . ") + "
                    . "'&paginacaoQtdPorPagina=' + (this.value>0?this.value:" . $this->_qtdPorPagina . ")));\"><br/>"
                    . "<ul class='pager' style='margin-top: 3px;'>"
                    . "     <li>" . $this->_linkAnterior . "</li>"
                    . "     <li>" . $this->_linkProximo . "</li>"
                    . "</ul>";
//                                . $this->_linkAnterior . "&nbsp;&nbsp;&nbsp;" . $this->_linkProximo;
        }
    }

    /* ==============================================================================
      ' Name: _preencheNomePagina
      ' Input:
      ' Output:
      ' Purpose: Pegar o nome da página que está efetuando a busca.
      ' Visibility: Private
      ' Remarks:
      '============================================================================= */

    function _preencheNomePagina($link) {
        $this->_nomePagina = $link;
    }

}

?>