<?php
class BannerCategoria{
	public function add(){
		extract($_REQUEST);

		try {

			$sql = "INSERT INTO banner_categoria (";
			$sql.= " nome";
			$sql.= ")";
			$sql.= "VALUES (";
			$sql.= "'" . $nome . "'";
			$sql.= ")";


			DBSql::getExecute($sql);

			return true;

		}catch (Exception $e){

			DBSql::getMsgErro($sql);

		}

		return false;

	}

	public function edit(){
		extract($_REQUEST);

		try {

			$sql = "UPDATE banner_categoria SET";
			$sql.= " nome = '" . $nome . "'";
			$sql.="WHERE";
			$sql.="	id = " . $id;

			DBSql::getExecute($sql);

			return true;

		}catch (Exception $e){

			DBSql::getMsgErro($sql);

		}

		return false;

	}

	public function delete(){
		extract($_REQUEST);

		try {

			$sql = "DELETE FROM banner_categoria ";
			$sql.= "WHERE";
			$sql.= "	id = " . $id;

			DBSql::getExecute($sql);

			return true;

		}catch (Exception $e){

			DBSql::getMsgErro($sql);

		}

		return false;

	}

	public function getColecaoBannerCategoria($id = null, $nome = null){

		$sql = "SELECT";
		$sql.= "	 id, ";
		$sql.= "	 nome ";
		$sql.= "FROM ";
		$sql.= "	banner_categoria ";
		$sql.= "WHERE 1=1 ";
		 if (!empty($id))
			 $sql.= "	 AND id = '" . $id . "'";
		 if (!empty($nome))
			 $sql.= "	 AND nome = '" . $nome . "'";
		$sql.= "ORDER BY id";

		return DBSql::getCollection($sql);

	}

	public function getBannerCategoria($id){


			$sql = "SELECT";
		$sql.= "	 id, ";
		$sql.= "	 nome ";
			$sql.= " FROM ";
			$sql.= "	banner_categoria";
			$sql.= " WHERE ";
			$sql.= "	id = " . $id;
		return DBSql::getArray($sql);

	}

}
?>