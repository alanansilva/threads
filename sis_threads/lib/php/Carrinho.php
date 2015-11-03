<?php

/** 
 * @author Joelson
 * 
 * 
 */
class Carrinho {
	
	private $nomeSessao;
	
	/**
	 * CONTRUTOR DA CLASSE PASSANDO O NOME DA SESSÂO
	 * @param $nomeSessão
	 */
	function __construct($nomeSessao) {
		$this->nomeSessao = $nomeSessao;
	}
	
	
	/**
	 * INSERE O ITEM NO CARRINHO
	 * @param $stringItem
	 */
	public function insereCarrinho($stringItem){
		$arrayProduto = explode('#', substr($stringItem, 0, -1));
		$arraySession = explode('#', substr($_SESSION[$this->nomeSessao], 0, -1));
		
		$diferenca = array_diff($arrayProduto, $arraySession);
		$produto = '';
		if (count($diferenca) > 0) {
			foreach ($diferenca as $value) {
				$produto.= $value . '#';
			}
			$_SESSION[$this->nomeSessao].= $produto;
		}
	}


	/**
	 * RETORNA UMA COLEÇÂO COM OS PRODUTOS DO CARRINHO
	* @param $nomeIndiceArraySessao (É importante que esse parâmetro tenha a mesma ordem do da string)
	 * @return Collection();
	 */
	public function getCarrinho($nomeIndiceArraySessao){
		$colecao = new Collection();
		$arraySession  = explode('#', substr($_SESSION[$this->nomeSessao], 0, -1));
				
		$arrayItem = array();
		if (count($arraySession) > 0){
			foreach ($arraySession as $key => $value) {
				if($value != ''){
					$arrayItem = explode('|', $value);
					foreach ($nomeIndiceArraySessao as $keySecundario => $value) {
						$item[$value]   = $arrayItem[$keySecundario];
					}
					
					$item['key'] = $key;				
					$colecao->Add($item);
				}
			}
		}
		return $colecao;
	}
	
	/**
	 * 
	 * EDITA CARRINHO
	 * @param Collection $arrayCollection
	 * @param Array $nomeIndiceArraySessao
	 */

	public function editCarrinho($arrayCollection, $nomeIndiceArraySessao){
		//remove a sessao de conteudo do carrinho
		unset($_SESSION[$this->nomeSessao]);
		//quantidade de indices do array
		$i = count($nomeIndiceArraySessao);	
		while($arrayCollection->Proximo()){	
			$alternativa = $arrayCollection->getItem();
			$stringItem = '';	
			//contagem de qual indice está
			$j = 1;
				
			foreach ($nomeIndiceArraySessao as $value){
				$stringItem .= $alternativa[$value];
				if($j < $i){
					$stringItem .= '|';
				}
				$j++;
			}
			
			$stringItem.='#';
			//adiciona ao carrinho
			$this->insereCarrinho($stringItem);
		}
	}

	/**
	 * REMOVE O ITEM DO CARRINHO
	 * @param integer $key
	 */
	public function removeCarrinho($key){
		$arraySession   = explode('#', substr($_SESSION[$this->nomeSessao], 0, -1));
		unset($arraySession[$key]);
		sort($arraySession);
		
		$_SESSION[$this->nomeSessao] = '';
		if (count($arraySession) > 0) {
			foreach ($arraySession as $value) {
				$produto .= $value . '#';
			}
			$_SESSION[$this->nomeSessao] .= $produto;		
		}
	}
		
}

?>