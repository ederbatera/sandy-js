<?php

include_once '_conexao.php';
$pdo = Conexao::getInstance();

    if(isset($_POST['card']) && !empty($_POST['card']) && is_numeric($_POST['card'])):
        $card =  intval($_POST['card']);
    else:
        $card = false;
    endif;

    if(isset($_GET['card']) && !empty($_GET['card']) && is_numeric($_GET['card'])):
        $card =  intval($_GET['card']);
    endif;

    if(isset($_GET['card']) && !empty($_GET['card']) && !is_numeric($_GET['card'])):
        $card = false;
    endif;



    if($card):
        
        $query = $pdo->prepare("SELECT * from funcionarios  WHERE cartao = ?");        
        $query->bindParam(1, $card);
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
        $funcionario['error'] = "Permitcardo somente Números";
    endif;


    header('Content-Type: application/json');
    echo json_encode($funcionario, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>