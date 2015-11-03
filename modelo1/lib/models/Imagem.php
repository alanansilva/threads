<?php

class Imagem {

    private $rs;
    private $objDb;
    private $diretorio = "../../images/";
    private $diretorio_c = "../../images/";
    private $diretorio_g = "../../images/grandes/";
    private $diretorio_p = "../../images/thumbs/";
    public $relacionamento_id;

    public function __construct() {
//		$GLOBALS["conn"]->Conectar();
        $this->objDb = $GLOBALS['objDb'];
    }

    public function getDiretorio_g() {
        return $this->diretorio_g;
    }

    public function getDiretorio_p() {
        return $this->diretorio_p;
    }

//	'############################################################################
//	'#		                PERSISTÊNCIA                                #
//	'############################################################################


    public function add() {
        //ini_set('display_errors', 1);
        $dbRetorno = true;
        $imagemCrop = new ImagemCrop();

        extract($_REQUEST);

        $cliente = 'cliente_' . $_SESSION['dados']['pessoa']['id'] . '/';

        @mkdir('../../images/' . $caminho . '/', 0774);
        @mkdir('../../images/' . $caminho . '/' . $cliente, 0774);
        if ($caminho2 != '') {
            @mkdir('../../images/' . $caminho . '/' . $cliente . '/' . $caminho2, 0774);
        }
        $caminho2 .= '/';
        $imagemCrop->setDiretorio_g('../../images/' . $caminho . '/' . $cliente . $caminho2 . 'grandes/');
        $imagemCrop->setDiretorio_p('../../images/' . $caminho . '/' . $cliente . $caminho2 . 'thumbs/');

        $imagemCrop->relacionamento_id = $relacionamento_id;
        $imagemCrop->add($menu_id, $destaque);

        return $dbRetorno;
    }

    /**
     * Persiste as imagens na tabela imagem
     * @param int $menu_id
     * @param int $relacionamento_id
     * @param string $nome_img
     * @param string $nome_thumb
     * @param int $destaque
     */
    public static function _addUploadImagem($menu_id, $relacionamento_id, $nome_img = null, $nome_thumb = null, $destaque = 0) {
        try {
            $sql = " INSERT INTO imagem(menu_id, relacionamento_id, titulo, nome_img, nome_thumb, destaque) ";
            $sql.= " VALUES(" . $menu_id . "," . $relacionamento_id . ",";
            $sql.= " null,";
            $sql.= "'" . $nome_img . "','" . $nome_thumb . "','" . $destaque . "'";
            $sql.= ")";
            DBSql::getExecute($sql);
        } catch (Exception $e) {
            DBSql::getMsgErro($sql);
        }
    }

    /**
     * Persite um upload de imagem
     * @param type $path
     * @param type $file
     * @param type $menu_id
     * @param type $relacionamento_id
     * @param type $destaque
     * @return boolean
     */
    public static function addUploadImagem($path, $file, $menu_id, $relacionamento_id, $destaque = 0) {

        try {
            UtilString::CreatePathPermission($path);

            $upload = new UploadFiles();
            $upload->upload($path, $file);

            $sql = " INSERT INTO imagem(menu_id, relacionamento_id, titulo, nome_img, nome_thumb, destaque) ";
            $sql.= " VALUES(" . $menu_id . "," . $relacionamento_id . ",";
            $sql.= " NULL,";
            $sql.= "'" . $upload->getNameFile() . "','" . $upload->getNameFile() . "','" . $destaque . "'";
            $sql.= ")";

            if (DBSql::getExecute($sql) === false)
                throw new Exception;

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * 
     * @param string $path
     * @param string $file
     * @param int $menu_id
     * @param int $relacionamento_id
     * @param int $destaque
     */
    public static function editUploadImagem($path, $file, $menu_id, $relacionamento_id, $destaque = 0) {
        try {
            $objImagem = Imagem::getImagem(null, $menu_id, $relacionamento_id, $destaque);
//            if (!empty($objImagem))
//                if (!self::deleteUploadImagem($objImagem['id'], $path . $objImagem['nome_img']))
//                    throw new Exception;

            if (!self::addUploadImagem($path, $file, $menu_id, $relacionamento_id, $destaque))
                throw new Exception;

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Deleta uma imagem
     * @param int $id
     * @param string $path_img
     */
    public static function deleteUploadImagem($id, $path_img = null) {
        try {
            $sql = "DELETE FROM imagem WHERE id = " . $id;

            if (DBSql::getExecute($sql) === false)
                throw new Exception;

            if (!empty($path_img))
                @unlink($path_img);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * 
     * @param type $menu_id
     * @param type $relacionamento_id
     * @param type $destaque
     * @return boolean
     * @throws Exception
     */
    public static function deleteUploadImagens($menu_id, $relacionamento_id, $destaque) {
        try {
            $sql = "DELETE FROM imagem WHERE "
                    . " menu_id = " . $menu_id
                    . " AND relacionamento_id = " . $relacionamento_id
                    . " AND destaque = " . $destaque;

            if (DBSql::getExecute($sql) === false)
                throw new Exception;

            if (!empty($path_img))
                @unlink($path_img);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * DELETA
     *
     * @return Bollean
     */
    public function delete($relacionamento_id = null) {
        try {
            $sql = " DELETE FROM imagem WHERE id = " . $relacionamento_id;

            DBSql::getExecute($sql);

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteExterno($relacionamento_id = '', $delTodasImagensArea = false, $arrayDirImg = array()) {
        $dbRetorno = true;
        extract($_REQUEST);

        $objCol = $this->getColecaoImagem(MENU_ID, $relacionamento_id);
        while ($objCol->Proximo()) {
            $objItem = $objCol->getItem();

            @unlink($arrayDirImg['dirGrande'] . $objItem['nome_img']);
            @unlink($arrayDirImg['dirThumb'] . $objItem['nome_thumb']);

            $sql = " DELETE FROM imagem WHERE id = " . $objItem['id'];

            if (!$this->objDb->Execute($sql)) {
                $dbRetorno = false;
            }
        }

        if ($delTodasImagensArea) {
            @rmdir($arrayDirImg['dirGrande']);
            @rmdir($arrayDirImg['dirThumb']);
            @rmdir($arrayDirImg['dirImgAerea']);
        }

        return $dbRetorno;
    }

//#######################################################################
//							  RETORNOS									#
//#######################################################################	

    /**
     * 
     * @param type $menu_id
     * @param type $relacionamento_id
     * @param type $destaque
     * @param type $limit
     * @return type
     */
    public function getColecaoImagem($menu_id = null, $relacionamento_id = null, $destaque = null, $limit = null) {

        $sql = " SELECT ";
        $sql.= "	SQL_CACHE";
        $sql.= "	id ";
        $sql.= "  	,relacionamento_id ";
        $sql.= "  	,titulo ";
        $sql.= "  	,menu_id ";
        $sql.= "  	,destaque ";
        $sql.= "   	,nome_img ";
        $sql.= "   	,nome_thumb ";
        $sql.= " FROM ";
        $sql.= "	imagem";
        $sql.= " WHERE 1=1 ";
        $sql.= " 	AND menu_id  		  = " . $menu_id;

        if (!empty($relacionamento_id))
            $sql.= " 	AND relacionamento_id = " . $relacionamento_id;

        if (!empty($_REQUEST['titulo']))
            $sql.= " AND titulo LIKE '%" . $_REQUEST['titulo'] . "%'";

        if (!empty($_REQUEST['ativo']))
            $sql.= " AND ativo = " . $_REQUEST['ativo'];

        if (!empty($destaque))
            $sql.= " AND destaque = " . $destaque;

        $sql.= " ORDER BY destaque ASC ";

        if (!empty($limit))
            $sql.= " LIMIT " . $limit;

        return DBSql::getCollection($sql);
    }

    /**
     * Retorna uma imagem
     * @param type $imagem_id
     * @param type $menu_id
     * @param type $relacionamento_id
     * @param type $destaque
     * @param type $rand
     * @return type  DBSql::getArray($sql);
     */
    public function getImagem($imagem_id = null, $menu_id = null, $relacionamento_id = null, $destaque = 0, $rand = false) {

        $sql = " SELECT ";
        $sql.= "	SQL_CACHE";
        $sql.= "	id ";
        $sql.= " 	,relacionamento_id ";
        $sql.= " 	,titulo ";
        $sql.= " 	,destaque ";
        $sql.= "  	,nome_img ";
        $sql.= "  	,nome_thumb";
        $sql.= " FROM ";
        $sql.= " 	imagem";
        $sql.= " WHERE 1=1";

        if (!empty($destaque))
            $sql.= "	AND destaque = " . $destaque;

        // $cliente = 'cliente_' . $_SESSION['dados']['pessoa']['id'] . '/';

        if (!empty($imagem_id))
            $sql.= "	AND id = " . $imagem_id;

        if (!empty($menu_id))
            $sql.= "	AND menu_id = " . $menu_id;

        if (!empty($relacionamento_id))
            $sql.= "	AND relacionamento_id = " . $relacionamento_id;

        if ($rand === true) {
            $sql.= " ORDER BY RAND() ";
        }

        //echo $sql . '<br>';
        return DBSql::getArray($sql);
    }

    /**
     *
     * @param type $id
     * @param type $menu_id
     * @return type 
     */
    public function getImagemDestaque($id, $menu_id) {
        $sql = "SELECT ";
        $sql .= "   id ";
        $sql .= "   ,relacionamento_id ";
        $sql .= "   ,menu_id ";
        $sql .= "   ,titulo ";
        $sql .= "   ,destaque ";
        $sql .= "   ,nome_img ";
        $sql .= "   ,nome_thumb";
        $sql .= " FROM ";
        $sql .= "    imagem";
        $sql .= " WHERE ";
        $sql .= "	relacionamento_id = " . $id;
        $sql .= " 	AND menu_id		  = " . $menu_id;
        $sql .= " 	AND destaque	  = 1";
        $sql .= " ORDER BY id DESC";
        return DBSql::getArray($sql);
    }

    /**
     * RETORNA UMA COLECAO DE IMAGENS
     *
     * @return Collection
     */
    public function getImagemCapa($id, $menu_id) {

        $sql = "SELECT ";
        $sql .= "   img.id, ";
        $sql .= "   img.relacionamento_id, ";
        $sql .= "   img.titulo, ";
        $sql .= "   img.ativo, ";
        $sql .= "   img.destaque, ";
        $sql .= "   img.nomeImg, ";
        $sql .= "   img.nomeThumb";
        $sql .= " FROM ";
        $sql .= "    imagens img";
        $sql .= " WHERE img.relacionamento_id = " . $id;
        $sql .= " AND img.menu_id			  = " . $menu_id;
        $sql .= " AND img.capa      		  = 1";

        return DBSql::getArray($sql);
    }

    /**
     * Retorna um botão para add mais imagens
     * @param int $menu_id
     * @param string $menu_nome
     * @param int $relacionamento_id
     * @param type $relacionamento_nome
     * @param int $width_img
     * @param int $height_img
     * @param int $width_thumb
     * @param int $height_thumb
     * @param string $caminho
     * @param string $caminho2
     * @return string
     */
    public function getBotaoMaisImagens($menu_id, $menu_nome, $relacionamento_id, $relacionamento_nome, $width_img, $height_img, $width_thumb, $height_thumb, $caminho, $caminho2) {

        /* 			
          $width_img    = 611;
          $height_img   = 337;
          $width_thumb  = 135;
          $height_thumb = 74;
          $caminho = 'empresa';
          $paramImg = "menu_id=".MENU_ID.
          "&menu_nome=".$app
         * ."&relacionamento_id=".$obj['id']
         * ."&relacionamento_nome=".$obj['nome']
         * ."&width_img=".$width_img
         * ."&height_img=".$height_img
         * ."&width_thumb=".$width_thumb
         * ."&height_thumb=".$height_thumb
         * ."&caminho=".$caminho;
         */
        $paramImg = "menu_id=" . $menu_id;
        $paramImg.= "&menu_nome=" . $menu_nome;
        $paramImg.= "&relacionamento_id=" . $relacionamento_id;
        $paramImg.= "&relacionamento_nome=" . $relacionamento_nome;
        $paramImg.= "&width_img=" . $width_img;
        $paramImg.= "&height_img=" . $height_img;
        $paramImg.= "&width_thumb=" . $width_thumb;
        $paramImg.= "&height_thumb=" . $height_thumb;
        $paramImg.= "&caminho=" . $caminho;
        $paramImg.= "&caminho2=" . $caminho2;

        $txt = '<a href="app.php?app=imagens/index&' . $paramImg . '">';
        $txt.= '    <img src="../../images/actions/img.png" title="Imagem" alt="" />';
        $txt.= '</a>';

        return $txt;
    }

//###############################################################################
//									COMBO										#
//###############################################################################
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