<?php

class ConteudoCategoria {

    public function add() {
        extract($_REQUEST);

        try {

            $sql = "INSERT INTO conteudo_categoria (";
            $sql.= " nome";
            $sql.= ")";
            $sql.= "VALUES (";
            $sql.= "'" . $nome . "'";
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

            $sql = "UPDATE conteudo_categoria SET";
            $sql.= " nome = '" . $nome . "'";
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

            $sql = "DELETE FROM conteudo_categoria ";
            $sql.= "WHERE";
            $sql.= "	id = " . $id;

            DBSql::getExecute($sql);

            return true;
        } catch (Exception $e) {

            DBSql::getMsgErro($sql);
        }

        return false;
    }

    public function getColecaoConteudoCategoria($id = null, $nome = null) {

        $sql = "SELECT";
        $sql.= "	 id, ";
        $sql.= "	 nome ";
        $sql.= "FROM ";
        $sql.= "	conteudo_categoria ";
        $sql.= "WHERE 1=1 ";
        if (!empty($id))
            $sql.= "	 AND id = '" . $id . "'";
        if (!empty($nome))
            $sql.= "	 AND nome = '" . $nome . "'";
        $sql.= "ORDER BY id";

        return DBSql::getCollection($sql);
    }

    public function getConteudoCategoria($id) {


        $sql = "SELECT";
        $sql.= "	 id, ";
        $sql.= "	 nome ";
        $sql.= " FROM ";
        $sql.= "	conteudo_categoria";
        $sql.= " WHERE ";
        $sql.= "	id = " . $id;
        return DBSql::getArray($sql);
    }

}

?>