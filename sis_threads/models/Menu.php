<?php

class Menu {

    private $rs;
    private $objDb;

    public function __construct() {
        $this->objDb = $GLOBALS['objDb'];
    }

    //'############################################################################
    //'#		                 		PERSISTÊNCIA                                #
    //'############################################################################


    public function add() {

        try {
            extract($_REQUEST);

            $sql = "INSERT INTO menu (";
            $sql.= " 	menu_id";
            $sql.= ", 	descricao";
            $sql.= ", 	url";
            $sql.= ",	posicao";
            $sql.= ")";
            $sql.= "VALUES (";
            if ($menu_id_1 != '') {
                $sql.= "	'" . $menu_id_1 . "'";
            } else {
                $sql.= "	NULL";
            }

            if ($descricao != '') {
                $sql.= ",	'" . $descricao . "'";
            } else {
                $sql.= ",	NULL";
            }

            if ($url != '') {
                $sql.= ",	'" . $url . "'";
            } else {
                $sql.= ",	NULL";
            }

            $sql.= ",	'" . $posicao . "'";
            $sql.= ")";


            if (!DBSql::getExecute($sql)) {
                throw new PDOException;
            }

            return true;
        } catch (PDOException $e) {
            return true;
        }
    }

    public function edit() {

        try {
            extract($_REQUEST);

            $sql = "UPDATE menu SET";
            $sql.= " 	descricao 	= '" . $descricao . "'";
            if ($menu_id_1 != '') {
                $sql.= ", 	menu_id 	= '" . $menu_id_1 . "'";
            }
            if ($url != '') {
                $sql.= ", 	url 		= '" . $url . "'";
            }
            $sql.= ", 	posicao 	= '" . $posicao . "'";
            $sql.="WHERE";
            $sql.="	id = $id";

            if (!DBSql::getExecute($sql)) {
                throw new PDOException;
            }

            return true;
        } catch (PDOException $e) {
            return true;
        }
    }

    public function delete() {

        try {
            extract($_REQUEST);

            $sql = "DELETE FROM menu ";
            $sql.= "WHERE";
            $sql.= "	id = " . $id;

            if (!DBSql::getExecute($sql)) {
                throw new PDOException;
            }

            return true;
        } catch (PDOException $e) {
            return true;
        }
    }

    //#######################################################################
    //							  RETORNOS								  #
    //#######################################################################


    public function getColecaoMenu() {


        $sql = " SELECT";
        $sql.= "	id ";
        $sql.= ",	menu_id ";
        $sql.= ",	descricao ";
        $sql.= ",	url ";
        $sql.= ",	posicao ";
        $sql.= ",	iconCls ";
        $sql.= " FROM ";
        $sql.= "	menu ";
        $sql.= " WHERE 1 ";

        if ($_REQUEST['menu_id_1'] != '') {
            $sql.= "	AND menu_id = " . $_REQUEST['menu_id_1'];
        }

        if ($_REQUEST['descricao'] != '') {
            $sql.= "	AND descricao LIKE '%" . $_REQUEST['descricao'] . "%' ";
        }

        if ($_REQUEST['url'] != '') {
            $sql.= "	AND url LIKE '%" . $_REQUEST['url'] . "%' ";
        }

        if ($_REQUEST['posicao'] != '') {
            $sql.= "	AND posicao LIKE '%" . $_REQUEST['posicao'] . "%' ";
        }

        $sql.= " ORDER BY id ASC, menu_id ASC";

        return DBSql::getCollection($sql);
    }

    public function getMenu($id) {


        $sql = " SELECT";
        $sql.= "	id ";
        $sql.= ",	menu_id ";
        $sql.= ",	descricao ";
        $sql.= ",	url ";
        $sql.= ",	posicao ";
        $sql.= ",	iconCls ";
        $sql.= " FROM ";
        $sql.= "	menu ";
        $sql.= " WHERE ";
        $sql.= "	id = " . $id;
        $sql.= " ORDER BY id";

        return DBSql::getArray($sql);
    }

    //###############################################################################
    //									COMBO									    #
    //###############################################################################


    public function getComboMenu($menu_id_1 = null) {

        if ($_SESSION['dados']['pessoa']['id'] != 1) {
            $sql = " SELECT DISTINCT ";
            $sql.= "       mp.id ";
            $sql.= "      ,mp.descricao ";
            $sql.= " FROM menu mp, ";
            $sql.= "     menu mf, ";
            $sql.= "     permissao pm, ";
            $sql.= "     perfil pe ";
            $sql.= " WHERE ";
            $sql.= "     mf.menu_id 	   = mp.id ";
            $sql.= "     AND mf.id 		   = pm.menu_id ";
            $sql.= "     AND pm.perfil_id  = pe.id ";
            $sql.= "     AND pm.perfil_id   = " . $_SESSION['dados']['pessoa']['perfil_id'];
            $sql.= "     AND mp.menu_id IS NULL ";
            $sql.= " ORDER BY mp.descricao";
        } else {
            $sql = " SELECT DISTINCT ";
            $sql.= "       mp.id ";
            $sql.= "      ,mp.descricao ";
            $sql.= " FROM menu mp ";
            $sql.= " WHERE ";
            $sql.= "     mp.menu_id IS NULL ";
            $sql.= " ORDER BY mp.descricao";
        }

        return DBSql::getCollection($sql);
    }

    public function getComboMenuFilho($menu_id_1 = null) {


        if ($_SESSION['dados']['pessoa']['perfil_id'] != 1) {
            $sql = " SELECT DISTINCT";
            $sql.= "     m.id, ";
            $sql.= "     m.descricao, ";
            $sql.= "     m.url, ";
            $sql.= "     m.iconCls ";
            $sql.= " FROM menu m, ";
            $sql.= "     permissao pm, ";
            $sql.= "     perfil pe ";
            $sql.= " WHERE ";
            $sql.= "     m.id = pm.menu_id ";
            $sql.= "     AND pm.perfil_id = pe.id ";
            if (!is_null($menu_id_1))
                $sql.= "     AND m.menu_id    = " . $menu_id_1;
            $sql.= "     AND pe.id        = " . $_SESSION['dados']['pessoa']['perfil_id'];
            $sql.= " ORDER BY m.posicao";
        }else {
            $sql = " SELECT DISTINCT";
            $sql.= "     m.id, ";
            $sql.= "     m.descricao, ";
            $sql.= "     m.url, ";
            $sql.= "     m.iconCls ";
            $sql.= " FROM menu m";
            $sql.= " WHERE 1=1";
            if (!is_null($menu_id_1))
                $sql.= "    AND m.menu_id    = " . $menu_id_1;
            $sql.= " ORDER BY m.posicao";
        }

        return DBSql::getCollection($sql);
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