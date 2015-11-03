<?php
	//INICIALIZANDO A SESSÃO
	session_start();
	
	//DESTRUINDO AS VARIÁVEIS
	unset($_SESSION);
	session_unset();
	
	//Redirecionando para a página de login
	header("location:../../index.jsp");
?>