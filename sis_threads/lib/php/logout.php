<?php
	//INICIALIZANDO A SESS�O
	session_start();
	
	//DESTRUINDO AS VARI�VEIS
	unset($_SESSION);
	session_unset();
	
	//Redirecionando para a p�gina de login
	header("location:../../index.jsp");
?>