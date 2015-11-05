<?php

class UtilCombo {
    /* ==============================================================================
      ' Name: UtilCombo
      ' Purpose:
      ' Remarks:
      ' Functions:
      ' Properties:
      ' Methods:
      ' Author: FoxQuiz (foxquiz@yahoo.com.br).
      ' Started:
      ' Modified:
      '============================================================================= */

//###############################################################################
//#                                 ATRIBUTOS                                   #
//###############################################################################
    /* ==============================================================================
      ' Name: _rs
      ' Input:
      ' Output:
      '   ResultSet - result set da consulta
      ' Purpose:
      ' Remarks:
      '============================================================================= */
    var $_rs;

    /* ==============================================================================
      ' Name: _query
      ' Input:
      ' Output:
      '   String - query que virï¿½ dos arquivos de cada sistema
      ' Purpose:
      ' Remarks:
      '============================================================================= */
    var $_query;

    /* ==============================================================================
      ' Name: _objDb
      ' Input:
      ' Output:
      '   Conexao - Objeto de banco de dados
      ' Purpose:
      ' Remarks:
      '============================================================================= */
    var $_objDb;

//###############################################################################
//#                                 CONTROLADORES                               #
//###############################################################################

    /* ==============================================================================
      ' Name: Function getComboOptions
      ' Input:
      '   campoValue - Nome do campo no RecordSet que serï¿½ o value.
      '   campoText - Nome do campo no RecordSet que serï¿½ o Text.
      '   default - Valor do RecordSet para colocar o option marcado por default.
      ' Output:
      '   String - Options baseados no resultado da query prï¿½ setada.
      ' Purpose:
      ' Remarks:
      '============================================================================= */
    function getComboOptions($campoValue, $campoText, $default) {

        $options = null;
        $selected = "";

        $this->_rs = $this->_objDb->Execute($this->_query);


        if (!$this->_rs->EOF) {
            while (!$this->_rs->EOF) {

                if (!is_array($default)) {
                    if ($this->_rs->fields[$campoValue] == $default) {
                        $selected = "selected";
                    }
                } else {
                    if (in_array($campoValue, $default)) {
                        $selected = "selected";
                    }
                }

                $options .= "<option value='" . str_replace("'", " ", $this->_rs->fields[$campoValue]) . "' $selected>" . str_replace("'", " ", $this->_rs->fields[$campoText]) . "</option>";

                $selected = "";
                $this->_rs->MoveNext();
            }
        } else {
            $options = "<option value=''>.::Sem Registros::.</option>";
        }

        return $options;
        $this->_rs = null;
    }

    /**
     * 
     * @param type $query
     * @param type $campoValue
     * @param type $campoText
     * @param type $default
     * @return string
     */
    public function _getComboOptions($query, $campoValue, $campoText, $default = null) {
        $options = null;
        $selected = "";

        $this->_rs = DBSql::getCollection($query);

        if ($this->_rs->Count() > 0) {
            $key = 0;
            while ($this->_rs->Proximo()) {
                $obj = $this->_rs->getItem();

                if (!is_array($default)) {
                    if ($obj[$campoValue] == $default) {
                        $selected = "selected";
                    }
                } else {
                    if (in_array($obj[$campoValue], $default)) {
                        $selected = "selected";
                    }
                }

                $options .= "<option value='" . str_replace("'", " ", $obj[$campoValue]) . "' $selected>" . str_replace("'", " ", $obj[$campoText]) . "</option>";

                $selected = "";
                $key++;
            }
        } else {
            $options = "<option value=''>.::Sem Registros::.</option>";
        }

        $this->_rs = null;
        return $options;
    }

    /**
     *  RETORNA UM COMBO SIMPLES SEM CONEXAO COM BANCO
     * @param int $from
     * @param int $to
     * @param string $default
     * @param array $option_default array('lable'=>'', 'value'=>'')
     * @param array $formatacao array('formato' => '%02d')
     * @return string
     */
    public static function getComboSimple($from, $to, $default = null, $option_default = array(), $formatacao = array('formato')) {
        if (!empty($option_default))
            $option ='<option value="' . $option_default['value'] . '">' . $option_default['label'] . '</option>';
        
        while ($from <= $to) {
            if ($default == $from) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            
            if (!empty($formatacao['formato']))
                $from = sprintf($formatacao['formato'], $from);

            $option.='<option value="' . $from . '"' . $selected . '>' . $from . '</option>';
            $from++;
        }

        return $option;
    }

    public static function getComboArray($arrayValue, $default = null, $option_default = array()) {
        
         if (!empty($option_default))
            $option ='<option value="' . $option_default['value'] . '">' . $option_default['label'] . '</option>';
         
        foreach ($arrayValue as $key => $value) {
            if ($default == $key) {
                $selected = "selected";
            } else {
                $selected = "";
            }

            $option.='<option value="' . $key . '"' . $selected . '>' . $value . '</option>';
        }

        return $option;
    }

    /**
     * Retorna um combo com base em um Collection ou Array
     * @param type $objCollection
     * @param array $options
     * @example $options = array(
            'type' => 'option',
            'name' => 'tur_pacote_viagem_id',
            'id' => 'tur_pacote_viagem_id',
            'value' => 'id',
            'label' => array('nome', 'id'),
            'validation' => array('is_validation' => false, 'msg' => null),
            'selected' => array('field' => 'null', 'value' => null),
            'class' => array(),
            'multiple' => false,
            'option_default' => array('label' => '* Selecione', 'value' => null),
            'javascript' => array(
                'onchange' => array('alert("Teste")', 'alert("Teste 2")'),
                'onclick' => array('alert("Teste")', 'alert("Teste 2")'),
            ),
            'style' => array('width' => '100px'),
            'other_attribute' => array('attr_teste'=>'true'),
      );

      $array = array(
        array('id'=> 1, 'nome' => 'teste 1'),
        array('id'=> 2, 'nome' => 'teste 2'),
        array('id'=> 3, 'nome' => 'teste 3'),
        array('id'=> 4, 'nome' => 'teste 4'),
        array('id'=> 5, 'nome' => 'teste 5')
      );
      echo UtilCombo::getComboCollectionOrArray($array    , $options);

      $objColPacoteViagem = $turPacoteViagem->getColecaoTurPacoteViagemNewTodos($_SESSION['dados']['pessoa']['id']);
      echo UtilCombo::getComboCollectionOrArray($objColPacoteViagem, $options);
     * @return UtilCombo 
     */
    public static function getComboCollectionOrArray($objCollection, array $options) {
        if (empty($options))
            $options = array(
                'type' => 'option',
                'name' => 'combo_name',
                'id' => 'combo_id',
                'value' => 'nome',
                'label' => array('id'),
                'validation' => array('is_validation' => false, 'msg' => null),
                'selected' => array('field' => null, 'value' => null),
                'class' => array(),
                'multiple' => false,
                'option_default' => array('label' => '* Selecione', 'value' => null, 'use' => true),
                'javascript' => array(
                    'onchange' => array('alert("Teste")', 'alert("Teste 2")'),
                    'onclick' => array('alert("Teste")', 'alert("Teste 2")'),
                ),
                'style' => array('width' => '100px'),
                'other_attribute' => array('attr'=>'true'),
            );

        if (empty($options['option_default']) && $options['option_default']['use'])
            $options['option_default'] = array('label' => '* Selecione', 'value' => null);

        if (!isset($options['type'])) {
            $combo .= '<select ';
            $combo .= ' name="' . $options['name'] . '"';
            $combo .= ' id="' . $options['id'] . '"';

            if ($options['validation']['is_validation']) {
                $required = 'required ';
                if (!empty($options['validation']['msg']))
                    $combo .= ' title="' . $options['validation']['msg'] . '"';
            }

            if (!empty($options['class']))
                foreach ($options['class'] as $key => $value)
                    $class.= $value . ' ';

            if (!empty($required) || !empty($class))
                $combo .= ' class="' . $required . substr($class, 0, -1) . '"';

            if ($options['multiple'])
                $combo .= ' multiple ';

            if (!empty($options['style'])) {
                foreach ($options['style'] as $key_css => $value_css)
                    $style.= $key_css . ':' . $value_css . ';';
                $combo.= ' style="' . substr($style, 0, -1) . '"';
            }

            if (!empty($options['other_attribute'])) {
                foreach ($options['other_attribute'] as $key_other_attribute => $value_other_attribute)
                    $other_attribute.= $key_other_attribute . '="' . $value_other_attribute . '" ';
                $combo.= substr($other_attribute, 0, -1);
            }

            /**
             * Implementa métodos e ações javascript
             */
            $js = null;
            $i = null;
            if (!empty($options['javascript']))
                foreach ($options['javascript'] as $event_js => $value_js) {
                    $i++;
                    $js.= $event_js . '=\'';
                    foreach ($value_js as $value_function_js)
                        $js.= $value_function_js . ';';

                    if ($i >= 1)
                        $js.= '\'';
                }

            $combo .= $js;
            $combo .= '>';
        }

        /**
         * Final da tag
         */
        if (!empty($options['option_default'])) {
            $combo .= '<option value="' . $options['option_default']['value'] . '"' . $selected . '>';
            $combo .= $options['option_default']['label'];
            $combo .='</option>';
        }

        /**
         * SE FOR UM COLLECTION
         */
        if (is_object($objCollection)) {

            /**
             * Tratamento de selected
             */
            if (!empty($options['selected']['value']) && is_object($options['selected']['value'])) {
                unset($objSelected);
                while ($options['selected']['value']->Proximo()) {
                    $objItemSelected = $options['selected']['value']->getItem();
                    $objSelected[] = $objItemSelected[$options['selected']['field']];
                }
            }

            while ($objCollection->Proximo()) {
                $objItem = $objCollection->getItem();

                $selected = null;
                if (is_object($options['selected']['value'])) {

                    if (in_array($objItem[$options['value']], $objSelected))
                        $selected = 'selected="selected"';
                    elseif ($objItem[$options['selected']['field']] == $options['selected']['value'])
                        $selected = 'selected="selected"';
                    
                } elseif (!empty($options['selected']['field'])) {
                    if ($objItem[$options['selected']['field']] == $options['selected']['value'])
                        $selected = 'selected';
                }

                $combo .= '<option value="' . $objItem[$options['value']] . '"' . $selected . '>';
                $label = null;
                if (is_array($options['label'])) {
                    foreach ($options['label'] as $key => $value)
                        $label .= $objItem[$value] . ' - ';

                    $label = substr($label, 0, -3);
                } else
                    $label = $objItem[$options['label']];


                $combo .= $label;
                $combo .='</option>';
            }
        } elseif (is_array($objCollection)) {
            foreach ($objCollection as $key => $objItem) {
                $selected = null;
                if (isset($options['selected']['field']))
                    if ($objItem[$options['selected']['field']] == $options['selected']['value'])
                        $selected = 'selected';

                $combo .= '<option value="' . $objItem[$options['value']] . '"' . $selected . '>';

                $label = null;
                if (is_array($options['label'])) {
                    foreach ($options['label'] as $key => $value)
                        $label .= $objItem[$value] . ' - ';

                    $label = substr($label, 0, -3);
                } else
                    $label = $objItem[$options['label']];


                $combo .= $label;
                $combo .='</option>';
            }
        }
        
        if (!isset($options['type']))
            return $combo .= '</select>';
        else
            return $combo;
    }

//###############################################################################
//#                                 PROPRIEDADES                                #
//###############################################################################
    /* ==============================================================================
      ' Name: Property Let setObjDb
      ' Input:
      '   newObjDb as Conexao - Instï¿½ncia de conexï¿½o com o banco
      ' Output:
      ' Purpose: Mï¿½todo para setar - Instï¿½ncia de conexï¿½o com o banco
      ' Remarks:
      '============================================================================== */
    function setObjDb($newObjDb) {
        $this->_objDb = $newObjDb;
    }

    /* ==============================================================================
      ' Name: Property Let setQuery
      ' Input:
      '   $newQry as Variant - Query para consulta do dados do combo
      ' Output:
      ' Purpose: Mï¿½todo para setar - Query para consulta do dados do combo
      ' Remarks:
      '============================================================================= */

    function setQuery($newQry) {
        $this->_query = $newQry;
    }

    /* ==============================================================================
      ' Name: Property Get getQuery
      ' Input:
      '   $newQry as Variant - Query para consulta do dados do combo
      ' Output:
      ' Purpose: Mï¿½todo para setar - Query para consulta do dados do combo
      ' Remarks:
      '============================================================================= */

    function getQuery() {
        return $this->_query;
    }

}

?>