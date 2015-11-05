<?php

class IconeBootstrap {

    public function add() {
        extract($_REQUEST);

        try {

            $sql = "INSERT INTO icone_bootstrap (";
            $sql.= " classe";
            $sql.= ")";
            $sql.= "VALUES (";
            $sql.= "'" . $classe . "'";
            $sql.= ")";


            DBSql::getExecute($sql);

            return true;
        } catch (Exception $e) {

            DBSql::getMsgErro($sql);
        }

        return false;
    }

    public function edit() {
        extract($_REQUEST);

        try {

            $sql = "UPDATE icone_bootstrap SET";
            $sql.= " classe = '" . $classe . "'";
            $sql.="WHERE";
            $sql.="	id = " . $id;

            DBSql::getExecute($sql);

            return true;
        } catch (Exception $e) {

            DBSql::getMsgErro($sql);
        }

        return false;
    }

    public function delete() {
        extract($_REQUEST);

        try {

            $sql = "DELETE FROM icone_bootstrap ";
            $sql.= "WHERE";
            $sql.= "	id = " . $id;

            DBSql::getExecute($sql);

            return true;
        } catch (Exception $e) {

            DBSql::getMsgErro($sql);
        }

        return false;
    }

    public function getColecaoIconeBootstrap($id = null) {

        $sql = "SELECT";
        $sql.= "	 id, ";
        $sql.= "	 classe ";
        $sql.= "FROM ";
        $sql.= "	icone_bootstrap ";
        $sql.= "WHERE 1=1 ";
        if (!empty($id))
            $sql.= "	 AND id = '" . $id . "'";
        $sql.= "ORDER BY id";

        return DBSql::getCollection($sql);
    }

    public function getIconeBootstrap($id) {


        $sql = "SELECT";
        $sql.= "	 id, ";
        $sql.= "	 classe ";
        $sql.= " FROM ";
        $sql.= "	icone_bootstrap";
        $sql.= " WHERE ";
        $sql.= "	id = " . $id;
        return DBSql::getArray($sql);
    }

}

?>