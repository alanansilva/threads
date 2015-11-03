<?php

class Pessoa {

    private $diretorio = "../../images/";
    public $diretorio_g = "../../images/conteudo/";

    /**
     * Persiste multiplas imagens
     * @param array $file
     * @param int $menu_id
     * @param int $banner_id
     */
    private function addImagens(array $file, $menu_id, $pessoa_id, $edit = false) {

        $path = $this->diretorio_g . 'cliente_' . PESSOA_ID . '/';
        $path = $this->diretorio_g . 'cliente_' . PESSOA_ID . '/';


        if (!empty($file)) {

            $options = array(
                'post_data' => null,
                'system' => '3heads',
                'path' => 'images/pessoa/cliente_' . PESSOA_ID . '/',
                'path_img_larger' => 'images/pessoa/cliente_' . PESSOA_ID . '/',
                'path_img_thumb' => 'images/pessoa/cliente_' . PESSOA_ID . '/thumbs/',
                'thumb_width' => null,
                'thumb_heigth' => null,
            );

            $result = PostFileCURL::setPostFileCURL($file, $options);
            if ($edit)
                Imagem::deleteUploadImagens($menu_id, $pessoa_id);

            foreach ($result->file as $key => $imagem) {
                $destaque = 0;
                if ($key == 0)
                    $destaque = 1;

                Imagem::_addUploadImagem($menu_id, $pessoa_id, $imagem->img_larger, $imagem->img_thumb, $destaque);
            }
        }
    }

    public function add() {
        extract($_REQUEST);

        try {

            $sql = "INSERT INTO pessoa (";
            $sql.= " pessoa_id,";
            $sql.= " tipo_pessoa_id,";
            $sql.= " cpf_cnpj,";
            $sql.= " nome,";
            $sql.= " email,";
            $sql.= " endereco,";
            $sql.= " data_insercao,";
            $sql.= " fisica_juridica,";
            $sql.= " telefone,";
            $sql.= "	 ativo, ";
            $sql.= "	 excluido, ";
            $sql.= " mapa_localizacao";
            $sql.= ")";
            $sql.= "VALUES (";
            $sql.= "'" . PESSOA_ID . "',";
            $sql.= "'" . $tipo_pessoa_id . "',";
            $sql.= "'" . $cpf_cnpj . "',";
            $sql.= "'" . $nome . "',";
            $sql.= "'" . $email . "',";
            $sql.= "'" . $endereco . "',";
            $sql.= "'" . date('Y-m-d') . "',";
            $sql.= "'" . $fisica_juridica . "',";
            $sql.= "'" . $telefone . "',";
            $sql.= "'" . $ativo . "',";
            $sql.= "'" . $excluido . "',";
            $sql.= "'" . $mapa_localizacao . "'";
            $sql.= ")";

            DBSql::getExecute($sql);

            $pessoa_id = DBSql::getLastId();

            if (!empty($_FILES['logomarca']['name'])) {
                $this->addImagens($_FILES['logomarca'], 5, $pessoa_id);
            }
            return true;
        } catch (Exception $e) {

            DBSql::getMsgErro($sql);
        }

        return false;
    }

    public function edit() {
        extract($_REQUEST);

        try {

            $sql = "UPDATE pessoa SET";
            $sql.= " pessoa_id = '" . PESSOA_ID . "',";
            $sql.= " tipo_pessoa_id = '" . $tipo_pessoa_id . "',";
            $sql.= " cpf_cnpj = '" . $cpf_cnpj . "',";
            $sql.= " nome = '" . $nome . "',";
            $sql.= " email = '" . $email . "',";
            $sql.= " endereco = '" . $endereco . "',";
            $sql.= " data_insercao = '" . $data_insercao . "',";
            $sql.= " fisica_juridica = '" . $fisica_juridica . "',";
            $sql.= " telefone = '" . $telefone . "',";
            $sql.= " ativo = '" . $ativo . "',";
            $sql.= " excluido = '" . $excluido . "',";
            $sql.= " mapa_localizacao = '" . $mapa_localizacao . "'";
            $sql.=" WHERE";
            $sql.="	id = " . $id;

            DBSql::getExecute($sql);

            if (!empty($_FILES['logomarca']['name'])) {
                $this->addImagens($_FILES['logomarca'], 5, $id, FALSE);
            }

            return true;
        } catch (Exception $e) {

            DBSql::getMsgErro($sql);
        }

        return false;
    }

    public function delete() {
        extract($_REQUEST);

        try {

            $sql = "DELETE FROM pessoa ";
            $sql.= "WHERE";
            $sql.= "	id = " . $id;

            DBSql::getExecute($sql);

            return true;
        } catch (Exception $e) {

            DBSql::getMsgErro($sql);
        }

        return false;
    }

    public function getColecaoPessoa($pessoa_id = null, $tipo_pessoa_id = null, $nome = null, $excluido = null, $ativo = null) {

        $sql = "SELECT";
        $sql.= "	 id, ";
        $sql.= "	 pessoa_id, ";
        $sql.= "	 tipo_pessoa_id, ";
        $sql.= "	 cpf_cnpj, ";
        $sql.= "	 nome, ";
        $sql.= "	 email, ";
        $sql.= "	 endereco, ";
        $sql.= "	 data_insercao, ";
        $sql.= "	 fisica_juridica, ";
        $sql.= "	 telefone, ";
        $sql.= "	 ativo, ";
        $sql.= "	 excluido, ";
        $sql.= "	 mapa_localizacao ";
        $sql.= "FROM ";
        $sql.= "	pessoa ";
        $sql.= "WHERE 1=1 ";

        if (!empty($pessoa_id))
            $sql.= "	 AND pessoa_id = '" . $pessoa_id . "'";

        if (!empty($tipo_pessoa_id))
            $sql.= "	 AND tipo_pessoa_id = '" . $tipo_pessoa_id . "'";

        if (!empty($nome))
            $sql.= "	 AND nome LIKE '%" . $nome . "%'";

        if (!empty($excluido))
            $sql.= "	 AND excluido = '" . $excluido . "'";

        if (!empty($ativo))
            $sql.= "	 AND ativo = '" . $ativo . "'";

        $sql.= "ORDER BY nome";

        return DBSql::getCollection($sql);
    }

    public function getPessoa($id = null, $pessoa_id = null) {


        $sql = "SELECT";
        $sql.= "	 id, ";
        $sql.= "	 pessoa_id, ";
        $sql.= "	 tipo_pessoa_id, ";
        $sql.= "	 cpf_cnpj, ";
        $sql.= "	 nome, ";
        $sql.= "	 email, ";
        $sql.= "	 endereco, ";
        $sql.= "	 data_insercao, ";
        $sql.= "	 fisica_juridica, ";
        $sql.= "	 telefone, ";
        $sql.= "	 ativo, ";
        $sql.= "	 excluido, ";
        $sql.= "	 mapa_localizacao ";
        $sql.= " FROM ";
        $sql.= "	pessoa";
        $sql.= " WHERE 1=1";
        if (!empty($id))
            $sql.= "	 AND id = '" . $id . "'";

        if (!empty($pessoa_id))
            $sql.= "	 AND pessoa_id = '" . $pessoa_id . "'";
        return DBSql::getArray($sql);
    }

}

?>