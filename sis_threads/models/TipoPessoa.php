<?php

class TipoPessoa {

    private $rs;
    private $objDb;

    public function __construct() {
        $this->objDb = $GLOBALS['objDb'];
    }

    //'############################################################################
    //'#		                 		PERSISTÊNCIA                              #
    //'############################################################################


    public function add() {
        extract($_REQUEST);

        try {
            $sql = "INSERT INTO tipo_pessoa (";
            $sql.= " 	nome";
            $sql.= ")";
            $sql.= "VALUES (";
            $sql.= "	'" . $nome . "'";
            $sql.= ")";

            if (DBSql::getExecute($sql) === false)
                throw new PDOException;

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function edit() {
        extract($_REQUEST);

        try {
            $sql = "UPDATE tipo_pessoa SET";
            $sql.= " 	nome = '" . $nome . "'";
            $sql.= " WHERE";
            $sql.= "	id   = $id";

            if (DBSql::getExecute($sql) === false)
                throw new PDOException;

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function delete() {

        try {
            $sql = "DELETE FROM tipo_pessoa ";
            $sql.= "WHERE";
            $sql.= "	id = " . $id;

            if (DBSql::getExecute($sql === false))
                throw new PDOException;

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    //#######################################################################
    //					RETORNOS			   #
    //#######################################################################


    public function getColecaoTipoPessoa() {

        $sql = " SELECT";
        $sql.= "	 id, ";
        $sql.= "	 nome ";
        $sql.= " FROM ";
        $sql.= "	tipo_pessoa ";
        $sql.= " WHERE 1=1";

        if (isset($_REQUEST['nome'])) {
            $sql.= "	AND	nome LIKE '%" . $_REQUEST['nome'] . "%'";
        }

        $sql.= " ORDER BY nome";

        return DBSql::getCollection($sql);
    }

    public function getTipoPessoa($id) {


        $sql = "SELECT";
        $sql.= "	 id, ";
        $sql.= "	 nome ";
        $sql.= " FROM ";
        $sql.= "	tipo_pessoa ";
        $sql.= " WHERE ";
        $sql.= "	id = " . $id;
        $sql.= " ORDER BY id";

        return DBSql::getArray($sql);
    }

    //###############################################################################
    //					COMBO					#
    //###############################################################################

    /**
     * Retorna um combo de tipo de pessoa
     * @param int $tipo_pessoa_id
     * @param type $perfil_id
     * @return UtilCombo
     */
    public function getComboTipoPessoa($tipo_pessoa_id = null, $perfil_id = null) {
        $objCombo = new UtilCombo();

        $objCombo->SETObjDb($this->objDb);

        $sql = "SELECT";
        $sql.= "	 id ";
        $sql.= "	,nome ";
        $sql.= "FROM";
        $sql.= "	tipo_pessoa ";
        $sql.= "WHERE 1=1 ";

        if ($perfil_id == 40)
            $sql.= " AND id = 3 ";

        $sql.= " ORDER BY nome";

        $objCombo->SETQuery($sql);

        return $objCombo->getComboOptions('id', 'nome', $tipo_pessoa_id, false);

        $objCombo = '';
    }

    //###############################################################################
    //								FINALIZADOR									  #
    //###############################################################################


    public function fecharConn() {
        $this->rs = null;
        $this->objDb->Close();
    }

}

?>