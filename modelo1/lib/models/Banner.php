<?php

class Banner {

    private $diretorio = "../../images/";
    public $diretorio_g = "../../images/banners/";

    /**
     * Persiste multiplas imagens
     * @param array $file
     * @param int $menu_id
     * @param int $banner_id
     */
    private function addImagens(array $file, $menu_id, $banner_id, $edit = false) {

        $path = $this->diretorio_g . 'cliente_' . PESSOA_ID . '/';
        $path = $this->diretorio_g . 'cliente_' . PESSOA_ID . '/';


        if (!empty($file)) {

            $options = array(
                'post_data' => null,
                'system' => '3heads',
                'path' => 'images/banners/cliente_' . PESSOA_ID . '/',
                'path_img_larger' => 'images/banners/cliente_' . PESSOA_ID . '/',
                'path_img_thumb' => 'images/banners/cliente_' . PESSOA_ID . '/thumbs/',
                'thumb_width' => null,
                'thumb_heigth' => null,
            );

            $result = PostFileCURL::setPostFileCURL($file, $options);
            if ($edit)
                Imagem::deleteUploadImagens($menu_id, $banner_id);

            foreach ($result->file as $key => $imagem) {
                $destaque = 0;
                if ($key == 0)
                    $destaque = 1;

                Imagem::_addUploadImagem($menu_id, $banner_id, $imagem->img_larger, $imagem->img_thumb, $destaque);
            }
        }
    }

    public function add() {
        extract($_REQUEST);

        try {

            $sql = "INSERT INTO banner (";
            $sql.= " banner_categoria_id,";
            $sql.= " nome,";
            $sql.= " link,";
            $sql.= " ativo,";
            $sql.= " descricao";
            $sql.= ")";
            $sql.= "VALUES (";
            $sql.= "'" . $banner_categoria_id . "',";
            $sql.= "'" . addslashes($nome) . "',";
            $sql.= "'" . $link . "',";
            $sql.= "'" . $ativo . "',";
            $sql.= "'" . $descricao . "'";
            $sql.= ")";


            DBSql::getExecute($sql);
            $banner_id = DBSql::getLastId();

            if (!empty($_FILES['tv']['name'])) {
                $this->addImagens($_FILES['tv'], 9, $banner_id);
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

            $sql = "UPDATE banner SET";
            $sql.= " banner_categoria_id = '" . $banner_categoria_id . "',";
            $sql.= " nome = '" . addslashes($nome) . "',";
            $sql.= " link = '" . $link . "',";
            $sql.= " ativo = '" . $ativo . "',";
            $sql.= " descricao = '" . $descricao . "'";
            $sql.="WHERE";
            $sql.="	id = " . $id;

            DBSql::getExecute($sql);
            if (!empty($_FILES['tv']['name'])) {
                $this->addImagens($_FILES['tv'], 9, $id, FALSE);
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

            $sql = "DELETE FROM banner ";
            $sql.= "WHERE";
            $sql.= "	id = " . $id;

            DBSql::getExecute($sql);

            return true;
        } catch (Exception $e) {

            DBSql::getMsgErro($sql);
        }

        return false;
    }

    public function getColecaoBanner($id = null, $banner_categoria_id = null, $nome = null, $link = null, $ativo = null, $descricao = null) {

        $sql = "SELECT";
        $sql.= "	 id, ";
        $sql.= "	 banner_categoria_id, ";
        $sql.= "	 nome, ";
        $sql.= "	 link, ";
        $sql.= "	 ativo, ";
        $sql.= "	 descricao ";
        $sql.= "FROM ";
        $sql.= "	banner ";
        $sql.= "WHERE 1=1 ";
        if (!empty($id))
            $sql.= "	 AND id = '" . $id . "'";
        if (!empty($banner_categoria_id))
            $sql.= "	 AND banner_categoria_id = '" . $banner_categoria_id . "'";
        if (!empty($nome))
            $sql.= "	 AND nome = '" . $nome . "'";
        if (!empty($link))
            $sql.= "	 AND link = '" . $link . "'";
        if (!empty($ativo))
            $sql.= "	 AND ativo = '" . $ativo . "'";
        if (!empty($descricao))
            $sql.= "	 AND descricao = '" . $descricao . "'";
        $sql.= "ORDER BY id";

        return DBSql::getCollection($sql);
    }

    public function getBanner($id = null, $banner_categoria_id = null) {


        $sql = "SELECT";
        $sql.= "	 id, ";
        $sql.= "	 banner_categoria_id, ";
        $sql.= "	 nome, ";
        $sql.= "	 link, ";
        $sql.= "	 ativo, ";
        $sql.= "	 descricao ";
        $sql.= " FROM ";
        $sql.= "	banner";
        $sql.= " WHERE 1 = 1";
        if (!empty($id))
            $sql.= "	 AND id = '" . $id . "'";
        if (!empty($banner_categoria_id))
            $sql.= "	 AND banner_categoria_id = '" . $banner_categoria_id . "'";

        return DBSql::getArray($sql);
    }

}

?>