<?php

class Usuario {

    private $rs;
    private $objDb;

    public function __construct() {
        $this->objDb = $GLOBALS['objDb'];
    }

    //'############################################################################
    //'#		                 		PERSISTÊNCIA              #
    //'############################################################################


    public function add() {
        extract($_REQUEST);

        try {
            $sql = "INSERT INTO usuario (";
            $sql.= " pessoa_id,";
            $sql.= " perfil_id,";
            $sql.= " login,";
            $sql.= " senha,";
            $sql.= " ativo,";
            $sql.= " atendimento_online,";
            $sql.= " nome";
            $sql.= " ,email";
            $sql.= ")";
            $sql.= "VALUES (";
            $sql.= "'" . $pessoa_id . "',";
            $sql.= "'" . $perfil_id . "',";
            $sql.= "'" . $login . "',";
            $sql.= "'" . MD5($senha) . "',";
            $sql.= "'" . $ativo . "',";
            $sql.= "'" . $atendimento_online . "',";
            $sql.= "'" . $nome . "'";
            $sql.= ",'" . $email . "'";
            $sql.= ")";

            DBSql::getExecute($sql);

            return true;
        } catch (Exception $e) {
            DBSql::getMsgErro($sql);
        }
    }

    public function edit() {

        extract($_REQUEST);

        try {
            $sql = "UPDATE usuario SET";
            $sql.= " perfil_id = '" . $perfil_id . "',";
            $sql.= " pessoa_id = " . $pessoa_id . ",";
            $sql.= " login = '" . $login . "',";

            if ($senha != '') {
                $sql.= " senha = '" . MD5($senha) . "',";
            }

            $sql.= " ativo = '" . $ativo . "',";
            $sql.= " atendimento_online = '" . $atendimento_online . "',";
            $sql.= " nome = '" . $nome . "',";
            $sql.= " email = '" . $email . "'";
            $sql.=" WHERE";
            $sql.="	id = $id";

            DBSql::getExecute($sql);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function edit2($resetar_senha = false) {

        try {
            extract($_REQUEST);

            $sql = "UPDATE usuario SET";
            $sql.= " email = '" . $email . "'";
            $sql.= " ,primeiro_acesso = NULL";

            if ($resetar_senha) {
                $senha = $this->getGerarSenhaUsuario();
                $sql.= " ,senha = MD5('" . $senha . "')";
            }

            $sql.=" WHERE";
            $sql.="     id = " . $id;

            if (DBSql::getExecute($sql) && $resetar_senha == 1)
                $this->setEnviarEmailSenhaUsuario($id, $senha);

            return true;
        } catch (Exeception $e) {
            DBSql::getMsgErro($sql);
        }

        return false;
    }

    /**
     * Método que enviar para o email do cliente a senha do mesmo
     * @param type $usuario_id
     * @param type $senha
     */
    public function setEnviarEmailSenhaUsuario($usuario_id, $senha) {

        $objUsuario = $this->getUsuario($usuario_id);

        require_once 'class.phpmailer.php';
        require_once 'emailResetarSenha.php';

        $out = ob_get_contents();
        ob_end_clean();

        $host = "webmail.motor-reserva.com.br";
        $userName = "mensagens@motor-reserva.com.br";
        $password = "F0c0_@#123**_.";
        $from = "mensagens@motor-reserva.com.br";

        $mail = new PHPMailer();

        $mail->IsSMTP(); // send via SMTP
        $mail->SMTPAuth = true; // 'true' para autenticacao
        $mail->CharSet = "ISO-8859-1";

        $mail->Host = $host;
        $mail->Username = $userName;
        $mail->Password = $password;
        $mail->From = $from;
        $mail->FromName = $userName;
        $mail->AddAddress($objUsuario['email'], $objUsuario['nome']);
        //$mail->AddCC('diego@focomultimidia.com', 'Diego');
        //$mail->AddCC('fabricio@focomultimidia.com', 'Fabricio');

        $mail->WordWrap = 64; // Definicao de quebra de linha
        $mail->IsHTML(true); // envio como HTML se 'true'

        $mail->Subject = 'Foco Multimídia - Alteração automática de senha ( ' . $objUsuario['nome'] . ' )';

        $mail->Body = $out;

        if (!$mail->Send())
            die($mail->ErrorInfo);
    }

    /**
     * Método que gerar uma senha randômica
     * @param int $length
     * @return string
     */
    public function getGerarSenhaUsuario($length = 6) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890!@#$%*()_+';
        $chars_length = (strlen($chars) - 1);

        $string = $chars{rand(0, $chars_length)};

        for ($i = 1; $i < $length; $i = strlen($string)) {
            $r = $chars{rand(0, $chars_length)};

            if ($r != $string{$i - 1})
                $string .= $r;
        }

        // Return the string
        return $string;
    }

    public function delete() {
        $dbRetorno = true;

        extract($_REQUEST);

        $sql = "DELETE FROM usuario ";
        $sql.= "WHERE";
        $sql.= "	id = " . $id;

        if (!$this->objDb->Execute($sql)) {
            $dbRetorno = false;
        }

        return $dbRetorno;
    }

    //#######################################################################
    //							  RETORNOS								  #
    //#######################################################################

    /**
     * 
     * @param type $pessoa_id
     * @param type $perfil_id
     * @return type
     */
    public function getColecaoUsuario($pessoa_id = null, $perfil_id = null) {

        $sql = "SELECT";
        $sql.= "	 id, ";
        $sql.= "	 pessoa_id, ";
        $sql.= "	 perfil_id, ";
        $sql.= "	 login, ";
        $sql.= "	 senha, ";
        $sql.= "	 ativo, ";
        $sql.= "	 atendimento_online, ";
        $sql.= "	 nome ";
        $sql.= "	 ,email ";
        $sql.= "	 ,primeiro_acesso ";
        $sql.= "FROM ";
        $sql.= "	usuario ";
        $sql.= "WHERE 1=1";

        if (empty($pessoa_id)) {
            if ($_SESSION['dados']['pessoa']['id'] != 1)
                $sql.= " AND pessoa_id = " . $_SESSION['dados']['pessoa']['id'];
        } else
            $sql.= " AND pessoa_id = " . $pessoa_id;

        if (!empty($perfil_id)) {
            $sql.= " AND perfil_id = " . $perfil_id;
        }


        if ($_REQUEST['nome'])
            $sql.= " AND nome LIKE '%" . $_REQUEST['nome'] . "%'";

        $sql.= " ORDER BY nome";

        return DBSql::getCollection($sql);
    }

    public function getUsuario($id) {


        $sql = "SELECT";
        $sql.= "	 id, ";
        $sql.= "	 pessoa_id, ";
        $sql.= "	 perfil_id, ";
        $sql.= "	 login, ";
        $sql.= "	 senha, ";
        $sql.= "	 ativo, ";
        $sql.= "	 atendimento_online, ";
        $sql.= "	 nome ";
        $sql.= "	 ,email ";
        $sql.= "	 ,primeiro_acesso ";
        $sql.= " FROM ";
        $sql.= "	usuario ";
        $sql.= " WHERE ";
        $sql.= "	id = " . $id;

        return DBSql::getArray($sql);
    }

    public function setAlterarSenhaUsuario() {

        extract($_REQUEST);

        $sql = "SELECT";
        $sql.= "	 id";
        $sql.= " FROM ";
        $sql.= "	usuario ";
        $sql.= " WHERE ";
        $sql.= "	login = '" . $login . "'";
        $sql.= "	AND senha = MD5('" . $senha . "')";
        $sql.= "	AND ativo = 1";

        $obj = DBSql::getArray($sql);

        if (empty($obj))
            return false;

        try {

            $sql = "UPDATE usuario SET";
            $sql.= " senha = MD5('" . $nova_senha . "'), ";
            $sql.= " primeiro_acesso = SYSDATE()";
            $sql.=" WHERE";
            $sql.="     id = " . $obj['id'];

            DBSql::getExecute($sql);

            return true;
        } catch (Exeception $e) {
            DBSql::getMsgErro($sql);
        }
        return false;
    }

    //###############################################################################
    //                              COMBO                                           #
    //###############################################################################


    public function getComboUsuario($pessoa_id, $perfil_id = null, $usuario_id = null) {
        $objCombo = new UtilCombo();

        $objCombo->SETObjDb($this->objDb);

        $sql = "SELECT";
        $sql.= "	 id ";
        $sql.= "	,nome ";
        $sql.= "FROM";
        $sql.= "	usuario ";
        $sql.= "WHERE";
        $sql.= "	pessoa_id     = " . $pessoa_id;

        if (!is_null($perfil_id))
            $sql.= " AND perfil_id IN (" . $perfil_id . ")";

        $sql.= " ORDER BY nome";
        $objCombo->SETQuery($sql);

        return $objCombo->getComboOptions('id', 'nome', $usuario_id, false);

        $objCombo = '';
    }

    //###############################################################################
    //				FINALIZADOR					    #
    //###############################################################################

    public function autenticaAtendimentoOnline($login, $senha, $pessoa_id) {

        $sql = "SELECT";
        $sql.= "	 id, ";
        $sql.= "	 pessoa_id, ";
        $sql.= "	 perfil_id, ";
        $sql.= "	 login, ";
        $sql.= "	 senha, ";
        $sql.= "	 ativo, ";
        $sql.= "	 atendimento_online, ";
        $sql.= "	 nome ";
        $sql.= "	 ,email ";
        $sql.= " FROM ";
        $sql.= "	usuario ";
        $sql.= " WHERE ";
        $sql.= "     login         = '" . $login . "'";
        $sql.= "     AND senha     = MD5('" . $senha . "')";
        $sql.= "     AND pessoa_id = " . $pessoa_id;
        $sql.= "     AND atendimento_online = 1";

        return DBSql::getArray($sql);
    }

    public function fecharConn() {
        $this->rs = null;
        $this->objDb->Close();
    }

}

?>