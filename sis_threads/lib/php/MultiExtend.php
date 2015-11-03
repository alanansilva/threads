<?php

/**
 * Implementa herança múltipla
 *
 * @author Rafael A. R. Dias
 * @version 1.13.09.02
 * @link http://www.diasrafael.com.br/blog/artigo/Implementando_heranca_multipla_no_PHP
 */
abstract class MultiExtend {

    
// array contem as classes-extensões
    private $_exts = array();

    /**
     * 
     * @param type $object
     */
    public function addExt($object) {
        $this->_exts[] = $object;
    }

    /**
     * 
     * @param type $varname
     * @return type
     */
    public function __get($varname) {
        foreach ($this->_exts as $ext) {
            if (property_exists($ext, $varname))
                return $ext->$varname;
        }
    }

    /**
     * 
     * @param type $method
     * @param type $args
     * @return type
     * @throws Exception
     */
    public function __call($method, $args) {
        foreach ($this->_exts as $ext) {
            if (method_exists($ext, $method))
                return call_user_method_array($method, $ext, $args);
        }
        throw new Exception("Este Metodo {$method} nao existe!");
    }

}
?>