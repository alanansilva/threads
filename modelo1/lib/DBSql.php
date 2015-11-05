<?php

class DBSql {

    private static $rs;
    private static $objDb;

    public function __construct() {
        
    }

    /**
     * Retorna objeto de bando
     * @return ADOConnection
     */
    public static function getObjDb() {
        self::$objDb = $GLOBALS['objDb'];
        return self::$objDb;
    }

    /**
     * RETORNA UM EXECUTE
     * @param String $sql
     * @param Boolean $debug
     * @param boolean $transaction
     * @param boolean $auditar
     * @return self::$objDb
     */
    public static function getExecute($sql, $debug = false, $transaction = false, $auditar = true) {
        if ($debug) {
            if ($transaction)
                self::getObjDb()->CompleteTrans();

            die($sql);
        }

        $obj = self::getObjDb()->query($sql);

        return $obj;
    }

    /**
     * Inicia uma transação
     */
    public static function StartTrans() {
        self::getObjDb()->StartTrans();
    }

    /**
     * Completa uma transação
     */
    public static function CompleteTrans() {
        self::getObjDb()->CompleteTrans();
    }

    /**
     * Retorna o último Id persistido
     * @return type
     */
    public static function getLastId() {
        return self::getObjDb()->lastInsertId();
    }

    /**
     * 
     * RETORNA O CAMPO FORMATADO COM BASE NO TIPO E NA AÇÃO
     * @param String $key
     * @param Array $optionsField
     * @param Array $value
     * @param Integer $action ação do formulário
     * @return String
     */
    public static function getFormatField($key, $optionsField, $value, $action = 4) {
        if ($optionsField[$key]['type'] == 'date') {
            if ($action == 4) {
                $fieldValue = DataHora::getVisualisaDataSql($value);
            } elseif ($action == 1 || $action == 2) {
                $fieldValue = DataHora::getFormataDataSql($value);
            }
        } elseif ($optionsField[$key]['type'] == 'datetime') {
            if ($action == 4) {
                $fieldValue = DataHora::getVisualisaDataSql($value, '-', 2);
            } elseif ($action == 1 || $action == 2) {
                $fieldValue = DataHora::getFormataDataSql($value, 1);
            }
        } elseif ($optionsField[$key]['type'] == 'moeda') {
            $fieldValue = UtilString::formataValor($value, 2);
        }

        return $fieldValue;
    }

    /**
     * 
     * Execulta uma consulta sql e retorna uma coleção
     * @param String $sql
     * @param Array $optionsField
     * @param Boolean $debug
     * @return Collection()
     */
    public static function getCollection($sql, $optionsField = '', $debug = false) {
        try {
            self::$rs = self::getExecute($sql)->fetchAll(PDO::FETCH_ASSOC);
            
            $colecao = new Collection();
            foreach (self::$rs as $row) {
                $obj = array();

                foreach ($row as $key => $value) {
                    /**
                     * VERIFICA SE EXISTE OPÇÕES PARA O CAMPO
                     */
                    if (!empty($optionsField) && !empty($value)) {
                        if (array_key_exists($key, $optionsField) && !empty($value))
                            $fieldValue = self::getFormatField($key, $optionsField, $value);
                        else
                            $fieldValue = $value;

                        $obj[$key] = $fieldValue;
                    } else
                        $obj[$key] = $value;
                }

                if (!empty($debug))
                    self::getDebugArray($obj, $debug);

                $colecao->Add($obj);
            }

            unset($optionsField);
            unset($key);
            unset($value);
            unset($sql);
            unset($obj);

            return $colecao;
        } catch (Exception $e) {
            self::getMsgErro($sql);
        }
    }

    /**
     * 
     * Execulta uma consulta sql e retorna um array
     * @param String $sql
     * @param Array $optionsField
     * @param Boolean $debug
     * @return Array
     */
    public static function getArray($sql, $optionsField = '', $debug = false) {
        try {
            self::$rs = self::getExecute($sql)->fetch(PDO::FETCH_ASSOC);

            foreach (self::$rs as $key => $value) {
                /**
                 * VERIFICA SE EXISTE OPÇÕES PARA O CAMPO
                 */
                if ($optionsField != '') {
                    if (array_key_exists($key, $optionsField) && !empty($value))
                        $fieldValue = self::getFormatField($key, $optionsField, $value);
                    else
                        $fieldValue = $value;

                    $obj[$key] = $fieldValue;
                } else
                    $obj[$key] = $value;
            }

            if (!empty($debug))
                self::getDebugArray($obj, $debug);

            unset($optionsField);
            unset($key);
            unset($value);
            unset($sql);

            return $obj;
        } catch (PDOException $e) {
            self::getMsgErro($sql);
        }
    }

    /**
     * 
     * RETORNA UMA COLECAO DE TABELAS DA BASE CONECTADA
     * @param string $driver
     * @param string $dbName
     * @return Ambigous <Collection(), Collection>
     */
    public static function getCollectionTable($driver, $dbName = '') {
        if ($driver == 'mssql') {

            $sql = " SELECT  ";
            $sql.= "	t.name AS id ";
            $sql.= "    ,t.name AS nome ";
            $sql.= "FROM  ";
            $sql.= "	sys.tables AS t ";
            $sql.= "ORDER BY t.name ";

            $collection = self::getCollection($sql);
        } elseif ($driver == 'pgsql') {

            $sql = " SELECT";
            $sql.= "	 t.table_name AS id";
            $sql.= "    ,t.table_name  AS nome";
            $sql.= " FROM";
            $sql.= "	information_schema.tables t";
            $sql.= " WHERE";
            $sql.= "	t.table_schema   = 'public'";
            $sql.= "	AND t.table_type = 'BASE TABLE' ";
            $sql.= " ORDER BY t.table_name";

            $collection = self::getCollection($sql);
        } elseif ($driver == 'mysql') {
            $sql = " SHOW TABLES ";
            $collunName = 'Tables_in_' . $dbName;

            $collection = self::getCollection($sql);
        }

        return $collection;
    }

    /**
     * 
     * RETORNA UMA COLECAO COM OS CAMPOS DA TABELA
     * @param string $table
     * @param string $driver
     * @return Ambigous <Collection(), Collection>
     */
    public static function getCollectionFieldTable($table, $driver = 'mssql') {
        if ($driver == 'mssql') {
            $sql = "SELECT ";
            $sql.= " 	  column_name ";
            $sql.= "    , data_type ";
            $sql.= "    , character_maximum_length ";
            $sql.= "    , is_nullable ";
            $sql.= "FROM information_schema.columns ";
            $sql.= "WHERE table_name =  '" . $table . "'";

            $collection = self::getCollection($sql);
        } elseif ($driver == 'pgsql') {
            $sql = " SELECT ";
            $sql.= "	c.column_name ";
            $sql.= "    ,c.data_type";
            $sql.= " FROM ";
            $sql.= "	information_schema.columns c";
            $sql.= " WHERE ";
            $sql.= "	c.table_schema   = 'public' ";
            $sql.= "    AND c.table_name = '" . $table . "'";

            $collection = self::getCollection($sql);
        } elseif ($driver == 'mysql') {
            $sql = " SHOW COLUMNS FROM " . $table;
            $collection = self::getCollection($sql);
        }

        return $collection;
    }

    /**
     * 
     * RETORNA UMA STRING COM UMA DML DO TIPO (INSERT)
     * @param string $table Nome da tabela
     * @param array $arrayValues Valores para inserção 
     * @param array  $arrayFieldRole Regras específicas para determinado(s) campo(s) array('id'=>array('disabled'=>true, 'type'=>'int', 'format'=>'int'))
     * @param string $driver Driver do SGDB
     * @return string
     */
    public static function createInsert($table, $arrayValues, $arrayFieldRole = array('id' => array('disabled' => true, 'type' => 'int', 'format' => 'int')), $driver = 'mssql') {

        $objCollection = self::getCollectionFieldTable($table, $driver);

        while ($objCollection->Proximo()) {
            $objField = $objCollection->getItem();

            foreach ($objField as $key => $fieldName) {
                if ($key == 'column_name') {
                    if (!$arrayFieldRole[$fieldName]['disabled']) {
                        $strField.= $fieldName . ',';
                        if (!empty($arrayValues[$fieldName]))
                            $strFieldValue.= "'" . $arrayValues[$fieldName] . "',";
                        else
                            $strFieldValue.= "NULL,";
                    }
                }
            }
        }

        $sql = "INSERT INTO " . $table . "(";
        $sql.= substr($strField, 0, -1);
        $sql.= ")";
        $sql.= "VALUES (";
        $sql.= substr($strFieldValue, 0, -1);
        $sql.= ")";

        return $sql;
    }

    /**
     * 
     * Método estático que mostra a estrutura do array ...
     * @param array $objArray
     * @param boolean $debug
     */
    private static function getDebugArray($objArray = array(), $debug) {
        if ($debug) {
            echo '<pre>';
            echo '<h1>DEBUG:</h1>';
            print_r($objArray);
            echo '</pre>';
        }
    }

    /**
     * RETORNA A MENSAGEM DE ERRO DA EXCEÇÃO
     * @param type $sql
     * @param type $msg
     * @param type $transaction
     */
    public static function getMsgErro($sql, $msg, $transaction = false) {
        if (empty($msg))
            $msg = self::getObjDb()->errorInfo();

        UtilString::pr($msg);
    }

}
