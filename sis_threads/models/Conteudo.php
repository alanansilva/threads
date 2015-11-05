<?php

class Conteudo {

    private $diretorio = "../../images/";
    public $diretorio_g = "../../images/conteudo/";

    /**
     * Persiste multiplas imagens
     * @param array $file
     * @param int $menu_id
     * @param int $banner_id
     */
    private function addImagens(array $file, $menu_id, $conteudo_id, $edit = false) {

        $path = $this->diretorio_g . 'cliente_' . PESSOA_ID . '/';
        $path = $this->diretorio_g . 'cliente_' . PESSOA_ID . '/';


        if (!empty($file)) {

            $options = array(
                'post_data' => null,
                'system' => '3heads',
                'path' => 'images/conteudo/cliente_' . PESSOA_ID . '/',
                'path_img_larger' => 'images/conteudo/cliente_' . PESSOA_ID . '/',
                'path_img_thumb' => 'images/conteudo/cliente_' . PESSOA_ID . '/thumbs/',
                'thumb_width' => null,
                'thumb_heigth' => null,
            );

            $result = PostFileCURL::setPostFileCURL($file, $options);
            if ($edit)
                Imagem::deleteUploadImagens($menu_id, $conteudo_id);

            foreach ($result->file as $key => $imagem) {
                $destaque = 0;
                if ($key == 0)
                    $destaque = 1;

                Imagem::_addUploadImagem($menu_id, $conteudo_id, $imagem->img_larger, $imagem->img_thumb, $destaque);
            }
        }
    }

    public function add() {
        extract($_REQUEST);

        try {

            $sql = "INSERT INTO conteudo (";
            $sql.= " conteudo_categoria_id,";
            $sql.= " titulo,";
            $sql.= " subtitulo,";
            $sql.= " descricao,";
            $sql.= " descricao_breve,";
            $sql.= " ordem,";
            $sql.= " ativo,";
            $sql.= " valor,";
            $sql.= " nome,";
            $sql.= " cargo,";
            $sql.= " funcao,";
            $sql.= " icone_bootstrap_id";
            $sql.= ")";
            $sql.= "VALUES (";
            $sql.= "'" . $conteudo_categoria_id . "',";
            $sql.= "'" . addslashes($titulo) . "',";
            $sql.= "'" . addslashes($subtitulo) . "',";
            $sql.= "'" . addslashes($descricao) . "',";
            $sql.= "'" . addslashes($descricao_breve) . "',";
            $sql.= "'" . $ordem . "',";
            $sql.= "'" . $ativo . "',";
            $sql.= "'" . UtilString::formataValor($valor) . "',";
            $sql.= "'" . $nome . "',";
            $sql.= "'" . $cargo . "',";
            $sql.= "'" . $funcao . "',";
            $sql.= "'" . $icone_bootstrap_id . "'";
            $sql.= ")";


            DBSql::getExecute($sql);
            $conteudo_id = DBSql::getLastId();

            if (!empty($_FILES['foto']['name'])) {
                $this->addImagens($_FILES['foto'], 7, $conteudo_id);
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

            $sql = "UPDATE conteudo SET";
            $sql.= " conteudo_categoria_id = '" . $conteudo_categoria_id . "',";
            $sql.= " titulo = '" . addslashes($titulo) . "',";
            $sql.= " subtitulo = '" . addslashes($subtitulo) . "',";
            $sql.= " descricao = '" . addslashes($descricao) . "',";
            $sql.= " descricao_breve = '" . addslashes($descricao_breve) . "',";
            $sql.= " ordem = '" . $ordem . "',";
            $sql.= " ativo = '" . $ativo . "',";
            $sql.= " valor = '" . UtilString::formataValor($valor) . "',";
            $sql.= " nome = '" . $nome . "',";
            $sql.= " cargo = '" . $cargo . "',";
            $sql.= " funcao = '" . $funcao . "',";
            $sql.= " icone_bootstrap_id = '" . $icone_bootstrap_id  . "'";
            $sql.="WHERE";
            $sql.="	id = " . $id;
            
            DBSql::getExecute($sql);

            if (!empty($_FILES['foto']['name'])) {
                $this->addImagens($_FILES['foto'], 7, $id, FALSE);
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

            $sql = "DELETE FROM conteudo ";
            $sql.= "WHERE";
            $sql.= "	id = " . $id;

            DBSql::getExecute($sql);

            return true;
        } catch (Exception $e) {

            DBSql::getMsgErro($sql);
        }

        return false;
    }

    public function getColecaoConteudo($id = null, $conteudo_categoria_id = null, $titulo = null) {

        $sql = "SELECT";
        $sql.= "	 id, ";
        $sql.= "	 conteudo_categoria_id, ";
        $sql.= "	 titulo, ";
        $sql.= "	 subtitulo, ";
        $sql.= "	 descricao, ";
        $sql.= "	 descricao_breve, ";
        $sql.= "	 ordem, ";
        $sql.= "	 ativo, ";
        $sql.= "	 valor, ";
        $sql.= "	 nome,";
        $sql.= "	 cargo, ";
        $sql.= "	 funcao, ";
        $sql.= "	 icone_bootstrap_id ";
        $sql.= "FROM ";
        $sql.= "	conteudo ";
        $sql.= "WHERE 1=1 ";
        if (!empty($id))
            $sql.= "	 AND id = '" . $id . "'";
        if (!empty($conteudo_categoria_id))
            $sql.= "	 AND conteudo_categoria_id = '" . $conteudo_categoria_id . "'";
        if (!empty($titulo))
            $sql.= "	 AND titulo = '" . $titulo . "'";
        $sql.= "ORDER BY id";

        return DBSql::getCollection($sql);
    }

    public function getConteudo($id = null, $conteudo_categoria_id = null) {


        $sql = "SELECT";
        $sql.= "	 id, ";
        $sql.= "	 conteudo_categoria_id, ";
        $sql.= "	 titulo, ";
        $sql.= "	 subtitulo, ";
        $sql.= "	 descricao, ";
        $sql.= "	 descricao_breve, ";
        $sql.= "	 ordem, ";
        $sql.= "	 ativo, ";
        $sql.= "	 valor, ";
        $sql.= "	 nome, ";
        $sql.= "	 cargo, ";
        $sql.= "	 funcao, ";
        $sql.= "	 icone_bootstrap_id ";
        $sql.= " FROM ";
        $sql.= "	conteudo";
        $sql.= " WHERE 1=1";
        if (!empty($id))
            $sql.= "	 AND id = '" . $id . "'";
        if (!empty($conteudo_categoria_id))
            $sql.= "	 AND conteudo_categoria_id = '" . $conteudo_categoria_id . "'";
        return DBSql::getArray($sql);
    }

}

?>