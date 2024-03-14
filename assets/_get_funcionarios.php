<?php
$funcionarios = [];

include_once '_conexao.php';
$pdo = Conexao::getInstance();

    $search = isset($_POST['search']) && !empty($_POST['search']) && $_POST['search'] != "false" ? $_POST['search'] : false;

    if($search):
        
        $query = $pdo->prepare("SELECT * from funcionarios  WHERE nome LIKE '%{$search}%' OR matricula LIKE '%{$search}%' ORDER BY nome ASC");        
        //$query->bindParam(1, $search);
        $query->execute();
        $number_of_rows = $query->rowCount();
        if($number_of_rows > 0):
        while($funcionario = $query->fetch(PDO::FETCH_ASSOC)){
            //$funcionarios[$funcionario["id"]] = $funcionario;
            $funcionarios[] = $funcionario;
        }
            
        endif;
        
    else:    
        $query = $pdo->prepare("SELECT * from funcionarios ORDER BY nome ASC");
        $query->execute();
        while($funcionario = $query->fetch(PDO::FETCH_ASSOC)){
                //$funcionarios[$funcionario["id"]] = $funcionario;
                $funcionarios[] = $funcionario;
            }    
    endif;


    header('Content-Type: application/json');
    header("Access-Control-Allow-Origin: *");
    echo json_encode($funcionarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
//      var_dump($funcionarios);
?>