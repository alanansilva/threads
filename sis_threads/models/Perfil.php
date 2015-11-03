<?php

class Perfil {

    private $rs;
    private $objDb;

    public function __construct() {
        
    }

    public function add() {

        try {
            $sql = " INSERT INTO perfil(nome, pessoa_id) ";
            $sql.= " VALUES('" . $_REQUEST['nome'] . "', '" . $_SESSION['dados']['pessoa']['id'] . "')";

            if (!DBSql::getExecute($sql, true)) {
                throw new PDOException;
            }

            //Pega Id do perfil
            $perfil_id = DBSql::getLastId();

            $arrayItens = explode('#', substr($_SESSION['carrinhoPerfilItem'], 0, -1));

            //Insert em Permissões
            foreach ($arrayItens as $value) {

                $arrayPermissoes = explode('#', $value);

                $sql = " INSERT INTO permissao(perfil_id, menu_id) ";
                $sql.= " VALUES(" . $perfil_id . ", " . $arrayPermissoes[0] . ")";

                if (!DBSql::getExecute($sql)) {
                    throw new PDOException;
                }
            }
            unset($_SESSION['carrinhoPerfilItem']);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function edit() {
        try {
            $sql = "DELETE FROM permissao WHERE perfil_id=" . $_REQUEST['id'];

            if (!DBSql::getExecute($sql)) {
                throw new PDOException;
            }

            $arrayItens = explode('#', substr($_SESSION['carrinhoPerfilItem'], 0, -1));

            foreach ($arrayItens as $value) {

                $arrayPermissoes = explode('#', $value);

                $sql = " INSERT INTO permissao(perfil_id, menu_id) ";
                $sql.= " VALUES(" . $_REQUEST['id'] . ", " . $arrayPermissoes[0] . ")";

                if (!DBSql::getExecute($sql)) {
                    throw new PDOException;
                }
            }

            $sql = " UPDATE perfil SET ";
            $sql.= " nome  = '" . $_REQUEST['nome'] . "'";
            $sql.= " WHERE id=" . $_REQUEST['id'];

            if (!DBSql::getExecute($sql)) {
                throw new PDOException;
            }

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * DELETA O PAIS
     *
     * @return Bollean
     */
    public function delete() {
        try {

            $sql = "DELETE FROM perfil WHERE id=" . $_REQUEST['id'];
            if (!DBSql::getExecute($sql)) {
                throw new PDOException;
            }

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

//#######################################################################
//                              RETORNOS				#
//#######################################################################	

    /**
     * RETorna uma colecao de paises
     *
     * @return Collection
     */
    public function getColecaoPerfil($pessoa_id) {

        $sql = "SELECT id, nome,pessoa_id FROM perfil WHERE 1=1";
        
        if ($pessoa_id != 1) {
            $sql.="	AND pessoa_id = " . $pessoa_id;
        }

        if ($_REQUEST['nome'] != '') {
            $sql.= " AND nome LIKE '%" . $_REQUEST['nome'] . "%'";
        }

        $sql.= " ORDER BY pessoa_id, nome";
        
        return DBSql::getCollection($sql);
    }

    /**
     * RETorna uma colecao de paises
     *
     * @return Collection
     */
    public function getPerfil($id) {

        $sql = "SELECT id, nome,pessoa_id FROM perfil WHERE id=" . $id;
        return DBSql::getArray($sql);
    }

    /**
     * RETorna uma colecao
     *
     * @return Collection
     */
    public function getColecaoPerfilPermissao() {

        $sql = "SELECT ";
        $sql.= "	p.id, ";
        $sql.= "	p.nome, ";
        $sql.= "	pm.acao_inserir, ";
        $sql.= "	pm.acao_alterar, ";
        $sql.= "	pm.acao_excluir, ";
        $sql.= "	m.id as menu_id, ";
        $sql.= "	m.descricao as menu_descricao ";
        $sql.= " FROM ";
        $sql.= "	perfil p INNER JOIN permissao pm ON (p.id = pm.perfil_id)";
        $sql.= "	inner join menu m on (pm.menu_id = m.id)";
        $sql.= " WHERE p.id = " . $_REQUEST['id'];

        return DBSql::getCollection($sql);
    }

//###############################################################################
//									COMBO										#
//###############################################################################

    /**
     * RETORNA UM COMBO COM O PERFIL
     *
     * @param Integer $perfil_id
     * @return UtilCombo->getComboOptions
     */
    public function getComboPerfil($perfil_id) {

        $objCombo = new UtilCombo();

        $objCombo->SETObjDb($this->objDb);

        $sql = "SELECT ";
        $sql.= "   id, ";
        $sql.= "   nome ";
        $sql.= " FROM ";
        $sql.= "   perfil ";
        $sql.= "  WHERE 1=1 ";
        if ($_SESSION['dados']['pessoa']['id'] == 1) {
            $sql.= "  AND pessoa_id = " . $_SESSION['dados']['pessoa']['id'];
        } elseif ($_SESSION['dados']['pessoa']['id'] != 1) {
            $sql.= "  AND id NOT IN (1,42) ";
        };
        $sql.= " ORDER BY nome ";
        echo $sql;
        $objCombo->SETQuery($sql);

        return $objCombo->getComboOptions("id", "nome", $perfil_id, false);

        $objCombo = "";
    }

//###############################################################################
//								FINALIZADOR										#
//###############################################################################

    /**
     * Finalizador da classe.
     *
     */
    public function fecharConn() {
        $this->rs = null;
        $this->objDb->Close();
    }

}

?>