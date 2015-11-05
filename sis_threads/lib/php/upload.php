<?php
class Upload {

	var $arquivo = "";
	var $erro = array ( "0" => "upload executado com sucesso!","1" => "O arquivo &eacute; maior do que o permitido pelo Servidor","2" => "O arquivo é maior que o permitido pelo formulario","3" => "O upload do arquivo foi feito parcialmente", "4" => "N&atilde;o foi feito o upload do arquivo");


	//########################  Função para imagem JPG ###########################
	
	/**
	 * Verifica se altura ? maior que a largura
	 *
	 * @param $_FILES $img
	 * @return unknown
	 */
	
	function verificaLargura( $img, $largura = 344, $altura = 179 ){
	
		list($width, $height) = getimagesize($img["tmp_name"]);
				
		if( ($width < $height ) or ($width < $largura ) or ( $height < $altura ) ) {
			return false;
		} 
		else {
			return true;
		}
	}
	
	/**
	 * Verifica o tamanho da imagem em bytes
	 *
	 * @param $_FILES $img
	 * @param int $sizeMax
	 * @return bollean
	 */
	function verificaSize( $img ){
		$sizeMax = 500000;
		
		if($img["size"] > $sizeMax) {
			return false;
		} 
		else {
			return true;
		}
	}	
	
	
	function reduz_imagem_jpg($img, $max_x, $max_y, $nome_foto) {

		
		//pega o tamanho da imagem ($original_x, $original_y)
		list($width, $height) = getimagesize($img);

		$original_x = $width;
		$original_y = $height;
	

		// se a largura for maior que altura
		if($original_x > $original_y) {
			$porcentagem = (100 * $max_x) / $original_x;
		} 
		else {
			$porcentagem = (100 * $max_y) / $original_y;
		}
		
		$tamanho_x = $original_x * ( $porcentagem / 100 );
		$tamanho_y = $original_y * ( $porcentagem / 100 );
		
		if( $tamanho_y < $max_y ){
			$porcentagem2 = (100 * $max_y) / $original_y;
		
			$tamanho_x = $original_x * ( $porcentagem2 / 100 );
			$tamanho_y = $original_y * ( $porcentagem2 / 100 );
		}
		
		$image_p = imagecreatetruecolor($tamanho_x, $tamanho_y);
		$image   = imagecreatefromjpeg($img);

		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $tamanho_x, $tamanho_y, $width, $height);
		//imagecopy( $image_p, $image, 0, 0, $x, $y, $tamanho_x, 234 );

		return imagejpeg( $image_p, $nome_foto, 70 );
	}


	//########################  Função para imagem GIF ###########################

	function reduz_imagem_gif($img, $max_x, $max_y, $nome_foto) {
		
		//pega o tamanho da imagem ($original_x, $original_y)
		list($width, $height) = getimagesize($img);

		$original_x = $width;
		$original_y = $height;
		
		// se a largura for maior que altura
		if($original_x > $original_y) {
			$porcentagem = (100 * $max_x) / $original_x;
		} 
		else {
			$porcentagem = (100 * $max_y) / $original_y;
		}
		
		$tamanho_x = $original_x * ( $porcentagem / 100 );
		$tamanho_y = $original_y * ( $porcentagem / 100 );
		
		if( $tamanho_y < $max_y ){
			$porcentagem2 = (100 * $max_y) / $original_y;
		
			$tamanho_x = $original_x * ( $porcentagem2 / 100 );
			$tamanho_y = $original_y * ( $porcentagem2 / 100 );
		}		
		
		$image_p = imagecreatetruecolor($tamanho_x, $tamanho_y);
		$image   = imagecreatefromgif($img);
		
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $tamanho_x, $tamanho_y, $width, $height);
		
		return imagegif($image_p, $nome_foto, 70);
	}


	//########################  Função para imagem PNG ###########################
	function reduz_imagem_png($img, $max_x, $max_y, $nome_foto) {
		
		//pega o tamanho da imagem ($original_x, $original_y)
		list($width, $height) = getimagesize($img);
		
		$original_x = $width;
		$original_y = $height;
		
		// se a largura for maior que altura
		if($original_x > $original_y) {
			$porcentagem = ( 100 * $max_x ) / $original_x;
		} 
		else 
		{
			$porcentagem = (100 * $max_y) / $original_y;
		}
		
		$tamanho_x = $original_x * ($porcentagem / 100);
		$tamanho_y = $original_y * ($porcentagem / 100);
		
		if( $tamanho_y < $max_y ){
			$porcentagem2 = (100 * $max_y) / $original_y;
		
			$tamanho_x = $original_x * ( $porcentagem2 / 100 );
			$tamanho_y = $original_y * ( $porcentagem2 / 100 );
		}		
		
		$image_p = imagecreatetruecolor($tamanho_x, $tamanho_y);
		$image   = imagecreatefrompng($img);
		
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $tamanho_x, $tamanho_y, $width, $height);
		
		return imagepng($image_p, $nome_foto, 70);
	}


	function gera_fotos($diretorio, $diretorio_g, $diretorio_p, $width_img, $height_img, $width_thumb, $height_thumb ) {

		if(!file_exists($diretorio)) {
			mkdir($diretorio);
		}
		if(!file_exists($diretorio_g)) {
			mkdir($diretorio_g);
		}
		if(!file_exists($diretorio_p)) {
			mkdir($diretorio_p);
		}
		
		$get2 = getimagesize($this->arquivo['tmp_name']); /* Vai servir para verificar se eh GIF ou JPG ou PNG*/
		$aux_tipo_imagem = $get2["mime"]; /* Vai servir para verificar se eh GIF ou JPG ou PNG*/
		
		if ($aux_tipo_imagem == "image/jpeg") {

			$nome_foto  = "imagem_".date("Ymd").time() . ".jpg"; // variavel para BD
			$nome_thumb = "thumb_".date("Ymd").time() . ".jpg"; // variavel para BD REDUZIDA

			//determino uma resolucao maxima e se a imagem for maior ela sera reduzida
			$this->reduz_imagem_jpg($this->arquivo['tmp_name'], $width_img, $height_img, $diretorio_g.$nome_foto);
			//passo o tamanho da thumbnail
			$this->reduz_imagem_jpg($this->arquivo['tmp_name'], $width_thumb, $height_thumb, $diretorio_p.$nome_thumb);
		}

		if ($aux_tipo_imagem == "image/gif") {
			$nome_foto  = "imagem_".date("Ymd").time().".gif";
			$nome_thumb = "thumb_".date("Ymd").time().".gif";
			//determino uma resolucao maxima e se a imagem for maior ela sera reduzida
			$this->reduz_imagem_gif($this->arquivo['tmp_name'],  $width_img, $height_img, $diretorio_g.$nome_foto);
			//passo o tamanho da thumbnail
			$this->reduz_imagem_gif($this->arquivo['tmp_name'],$width_thumb, $height_thumb, $diretorio_p.$nome_thumb);
		}

		if ($aux_tipo_imagem == "image/png") {
			$nome_foto  = "imagem_".date("Ymd").time().".png";
			$nome_thumb = "thumb_".date("Ymd").time().".png";
			//determino uma resolucao maxima e se a imagem for maior ela sera reduzida
			$this->reduz_imagem_png($this->arquivo['tmp_name'], $width_img, $height_img, $diretorio_g.$nome_foto);
			//passo o tamanho da thumbnail
			$this->reduz_imagem_png($this->arquivo['tmp_name'], $width_thumb, $height_thumb, $diretorio_p.$nome_thumb);
		}

		if($this->erro[$this->arquivo['error']] != 0){
			$msg = "<span style=\"color: white; border: solid 1px; background: purple;\">".$this->erro[$this->arquivo['error']]."</span>";
			return $msg;
		}
		else{
			return $nome_foto . "|" . $nome_thumb;
		}
	}

	function enviarArquivo($img, $diretorio, $diretorio_g, $diretorio_p, $width_img, $height_img, $width_thumb, $height_thumb ) {

		$this->arquivo = $img;

		if(!is_uploaded_file($this->arquivo['tmp_name'])){
			$msq = "<span style=\"color: white; border: solid 1px; background: red;\">".$this->erro[$this->arquivo['error']]."</span>";
			return $msg;
		}
		else{
			$img = $this->gera_fotos($diretorio, $diretorio_g, $diretorio_p, $width_img, $height_img, $width_thumb, $height_thumb );
			return $img;
		}
	}

}
?>

