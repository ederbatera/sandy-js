<?php

include_once '_conexao.php';
$pdo = Conexao::getInstance();

    if(isset($_POST['rfidcard']) && !empty($_POST['rfidcard']) && is_numeric($_POST['rfidcard'])):
        $rfidcard =  intval($_POST['rfidcard']);
    else:
        $rfidcard = false;
    endif;

    if(isset($_GET['rfidcard']) && !empty($_GET['rfidcard']) && is_numeric($_GET['rfidcard'])):
        $rfidcard =  intval($_GET['rfidcard']);
    endif;

    if(isset($_GET['rfidcard']) && !empty($_GET['rfidcard']) && !is_numeric($_GET['rfidcard'])):
        $rfidcard = false;
    endif;



    if($rfidcard):
        //    $funcionario['localizado'] = 1;
        //    $funcionario['rfidcard'] = "O número é ".$rfidcard;

        
        $query = $pdo->prepare("SELECT * from funcionarios  WHERE cartao = ?");        
        $query->bindParam(1, $rfidcard);
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