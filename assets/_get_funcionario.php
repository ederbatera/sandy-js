<?php

include_once '_conexao.php';
$pdo = Conexao::getInstance();

    if(isset($_POST['id']) && !empty($_POST['id']) && is_numeric($_POST['id'])):
        $id =  intval($_POST['id']);
    else:
        $id = false;
    endif;

    if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])):
        $id =  intval($_GET['id']);
    endif;

    if(isset($_GET['id']) && !empty($_GET['id']) && !is_numeric($_GET['id'])):
        $id = false;
    endif;



    if($id):
        
        $query = $pdo->prepare("SELECT * from funcionarios  WHERE id = ?");        
        $query->bindParam(1, $id);
        $query->execute();
        $number_of_rows = $query->rowCount();

        if($number_of_rows > 0):
            $funcionario = $query->fetch(PDO::FETCH_OBJ);
            $funcionario->localizado = 1;
        else:
            $funcionario['localizado'] = 0;
            $funcionario['error'] = "Não localizado funcionário vinculado a este cartão";
        endif;
        
    else:
        $funcionario['localizado'] = 0;
        $funcionario['error'] = "Permitido somente Números";
    endif;


    header('Content-Type: application/json');
    echo json_encode($funcionario, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>