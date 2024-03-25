
<?php
require "_conexao.php";
session_start();


if(!isset($_SESSION['key']) OR $_SESSION['key'] != 'KLnNolTydrt56787897hggfs6tkjc3fv2va65fd'):
    header("Location: ../logar.php");
    exit();
endif;



$nome = trim($_POST['nome_add_usuario']); 
$sobrenome = trim($_POST['sobrenome_add_usuario']);  
$cargo = trim($_POST['cargo_add_usuario']);  
$matricula = trim($_POST['matricula_add_usuario']);  
$email = trim($_POST['email_add_usuario']);  
$hPass  = $_POST['senha_add_usuario'];
$salt = 'n0ssUS3rv1d0Rb@L@';
    $senha = hash('sha512', $hPass . $salt);
 //   $senha = password_hash(trim($_POST['senha']), PASSWORD_DEFAULT);

$userOn = $_SESSION['nome'];
$pdo = conexao::getInstance();


    try {
        
        $sql = 'SELECT * FROM usuarios WHERE id = ? AND status = ?';
        $stm = $pdo->prepare($sql);
        $stm->bindValue(1, $_POST['user_id_add_usuario']);
        $stm->bindValue(2, 'A');
        $stm->execute();
        $retorno = $stm->fetch(PDO::FETCH_OBJ);
        if(isset($retorno->permissao) && $retorno->permissao > 6 ):



            try {
                $sql = "INSERT INTO usuarios (nome, sobrenome, usuario, matricula, cargo, email, senha, permissao, status)VALUES('{$nome}', '{$sobrenome}', NULL, '{$matricula}', '{$cargo}', '{$email}', '{$senha}', '1', 'A')";
                $stm = $pdo->prepare($sql);
                $stm->execute();
                if ($stm):
                    
                    $sql2 = "INSERT INTO log_usuario (usuario, action) VALUES ('{$userOn}', 'ADICIONOU UM NOVO USUÁRIO DO SISTEMA: {$nome}.')";
                    $stm2 = $pdo->prepare($sql2);
                    $stm2->execute();
                    echo '{"status" : "ok", "icon" : "success", "title" : "Sucesso!", "html" : "Usuário '.$nome.' '.$sobrenome.' adicionado!"}';
                else: 
                    echo '{"status" : "erro", "icon" : "error", "title" : "Erro", "html" : "Erro inesperado"}';

                endif;                

                } catch (Exception $e) {
                  echo '{"status" : "erro", "icon" : "error", "title" : "Erro", "html" : "'.$e.'"}';
                  die();  
                }

        else:
            echo '{"status" : "erro", "icon" : "error", "title" : "Não adicionado", "html" : "Usuário sem permissão de adicionar usuário."}';
        endif;

    } catch (Exception $e) {
      echo '{"status" : "erro", "icon" : "error", "title" : "Error:", "html" : "'.$e.'"}';
      die();  
    }











 // ************************************************************************************************************************************************************************************************************************
