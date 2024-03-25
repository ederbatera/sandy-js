<?php

session_start();


// if(isset($_SESSION['key']) &&  $_SESSION['key'] == 'KLnNolTydrt56787897hggfs6tkjc3fv2va65fd'):
// 	header("Location: /");
// endif;


// Recebe os dados do formulário
$email = addslashes((isset($_POST['email'])) ? $_POST['email'] : '') ;
$hPass = addslashes((isset($_POST['senha'])) ? $_POST['senha'] : '');
$salt = 'n0ssUS3rv1d0Rb@L@';
$senha = hash('sha512', $hPass . $salt);
$ip = $_POST['ip'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)):
		$_SESSION['msg'] = 'Formato do e-mail inválido';
		$_SESSION['status'] = false ;
		header("Location: ../logar.php");

endif;




// Require da classe de conexão
require_once '_conexao.php';

// Instancia Conexão PDO
$conexao = Conexao::getInstance();

//  Válida os dados do usuário com o banco de dados
$sql = 'SELECT * FROM usuarios WHERE email = ? AND status = ?';
$stm = $conexao->prepare($sql);
$stm->bindValue(1, $email);
$stm->bindValue(2, 'A');
$stm->execute();
$retorno = $stm->fetch(PDO::FETCH_OBJ);


//  Válida a senha utlizando a API Password Hash
if(!empty($retorno) && $senha == $retorno->senha):
	
	$_SESSION['id'] = $retorno->id;
	$name_exploded = explode(' ', $retorno->nome);
	$_SESSION['first_name'] = $name_exploded[0];
	$_SESSION['last_name'] = $name_exploded[1];
	$_SESSION['full_name']  = $retorno->nome;
	$_SESSION['nome'] = $retorno->nome;
	$_SESSION['permissao'] = $retorno->permissao;
	$_SESSION['email'] = $retorno->email;
	$_SESSION['cargo'] = $retorno->cargo;
	$_SESSION['matricula'] = $retorno->matricula;
	$_SESSION['key'] = 'KLnNolTydrt56787897hggfs6tkjc3fv2va65fd';
	setcookie('@Sandy:user_name', $retorno->nome, time()+(3600*24)*30, '/');
	setcookie('@Sandy:user_id', $retorno->id, time()+(3600*24)*30, '/');

	$sql2 = "INSERT INTO log_login (usuario,ip,metodo) VALUES ('{$retorno->id}','{$ip}','Password')";
	$stm2 = $conexao->prepare($sql2);
	$stm2->execute();

	//header("Location: /");
	switch ($retorno->permissao) {
        case 1:
            header("Location: ../delivery");
            break;
        case 2:
            header("Location: ../");
            break;

        default:
            header("Location: ../delivery");
    }
	
else:
	
	$_SESSION['msg'] = "Usuário e/ou senha inválido(s)" ;
	$_SESSION['status'] = false ;
	header("Location: ../logar.php");
	

endif;



?> 
