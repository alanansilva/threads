<?php

class QuemSomos {

    public function add() {
        extract($_REQUEST);

        try {

            $sql = "INSERT INTO quem_somos (";
            $sql.= " titulo,";
            $sql.= " subtitulo,";
            $sql.= " imagem";
            $sql.= ")";
            $sql.= "VALUES (";
            $sql.= "'" . $titulo . "',";
            $sql.= "'" . $subtitulo . "',";
            $sql.= "'" . $imagem . "'";
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

            $sql = "UPDATE quem_somos SET";
            $sql.= " titulo = '" . $titulo . "',";
            $sql.= " subtitulo = '" . $subtitulo . "',";
            $sql.= " imagem = '" . $imagem . "'";
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

            $sql = "DELETE FROM quem_somos ";
            $sql.= "WHERE";
            $sql.= "	id = " . $id;

            DBSql::getExecute($sql);

            return true;
        } catch (Exception $e) {

            DBSql::getMsgErro($sql);
        }

        return false;
    }

    public function getColecaoQuemSomos() {

        $sql = "SELECT";
        $sql.= "	 id, ";
        $sql.= "	 titulo, ";
        $sql.= "	 subtitulo, ";
        $sql.= "	 imagem ";
        $sql.= "FROM ";
        $sql.= "	quem_somos ";
        $sql.= "WHERE 1=1 ";
        $sql.= "ORDER BY id";

        return DBSql::getCollection($sql);
    }

    public function getQuemSomos($id) {


        $sql = "SELECT";
        $sql.= "	 id, ";
        $sql.= "	 titulo, ";
        $sql.= "	 subtitulo, ";
        $sql.= "	 imagem ";
        $sql.= " FROM ";
        $sql.= "	quem_somos";
        $sql.= " WHERE ";
        $sql.= "	id = " . $id;
        return DBSql::getArray($sql);
    }

}

?>