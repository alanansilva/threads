<?php

ini_set('display_errors', 1);

ob_clean();

session_start();

$debug = 1;



$funcao = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";



if (function_exists($funcao)) {

    call_user_func($funcao);

}



function logar() {

    require_once 'conn.php';



    $nome = isset($_REQUEST["nome"]) ? addslashes($_REQUEST["nome"]) : "";

    $senha = isset($_REQUEST["senha"]) ? addslashes($_REQUEST["senha"]) : "";



    if (!empty($nome) && !empty($nome)) {



        $sql = "SELECT id FROM usuario WHERE login = '" . $nome . "' AND senha = MD5('" . $senha . "') AND ativo = 1";



        $rs = DBSql::getArray($sql);



        if (!empty($rs['id'])) {


            $sql = "SELECT ";
            $sql.= "    usu.id AS usuario_id ";
            $sql.= "   ,usu.nome ";
            $sql.= "   ,usu.login ";
            $sql.= "   ,usu.pessoa_id ";
            $sql.= "   ,usu.perfil_id ";
            $sql.= "   ,usu.email ";
            $sql.= "   ,p.nome AS pessoa ";
            $sql.= "   ,p.tipo_pessoa_id AS tipo_pessoa_id ";
            $sql.= "   ,p.pessoa_id AS rede_id";
            $sql.= "   ,per.nome AS perfil ";
            $sql.= "FROM usuario usu, pessoa p, perfil per ";
            $sql.= "WHERE ";
            $sql.= "	 usu.pessoa_id     = p.id ";
            $sql.= "	 AND usu.perfil_id = per.id ";
            $sql.= "     AND usu.id        = " . $rs['id'];

            $rs = DBSql::getArray($sql);
            
            $_SESSION['dados']['usuario']['id'] = $rs['usuario_id'];
            $_SESSION['dados']['usuario']['nome'] = $rs['nome'];
            $_SESSION['dados']['usuario']['login'] = $rs['login'];
            $_SESSION['dados']['usuario']['pessoa_id'] = $rs['pessoa_id'];
            $_SESSION['dados']['pessoa']['id'] = $rs['pessoa_id'];
            $_SESSION['dados']['pessoa']['nome'] = $rs['pessoa'];
            $_SESSION['dados']['pessoa']['perfil'] = $rs['perfil'];
            $_SESSION['dados']['pessoa']['perfil_id'] = $rs['perfil_id'];
            $_SESSION['dados']['pessoa']['tipo_pessoa_id'] = $rs['tipo_pessoa_id'];
            $_SESSION['dados']['pessoa']['pessoa_classificacao_id'] = $rs['pessoa_classificacao_id'];
            $_SESSION['dados']['pessoa']['liberar_acesso'] = $rs['liberar_acesso'];

            header("location: ../../sistema.php");
        } else {
            header("location: ../../index.php?Erro=Usuário ou senha incorretos!");
        }
    }
}
?>
