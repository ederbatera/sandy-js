<?php
$fornecedores = [];

include_once '_conexao.php';
$pdo = Conexao::getInstance();

    $search = isset($_POST['search']) && !empty($_POST['search']) && $_POST['search'] != "false" ? $_POST['search'] : false;

    if($search):
        
        $query = $pdo->prepare("SELECT * from fornecedores  WHERE razao LIKE '%{$search}%' OR codigo LIKE '%{$search}%' ORDER BY razao ASC");        
        //$query->bindParam(1, $search);
        $query->execute();
        $number_of_rows = $query->rowCount();
        if($number_of_rows > 0):
        while($funcionario = $query->fetch(PDO::FETCH_ASSOC)){
            //$fornecedores[$funcionario["id"]] = $funcionario;
            $fornecedores[] = $funcionario;
        }
            
        endif;
        
    else:    
        $query = $pdo->prepare("SELECT * from fornecedores ORDER BY razao ASC");
        $query->execute();
        while($funcionario = $query->fetch(PDO::FETCH_ASSOC)){
                //$fornecedores[$funcionario["id"]] = $funcionario;
                $fornecedores[] = $funcionario;
            }    
    endif;


    header('Content-Type: application/json');
    echo json_encode($fornecedores, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
//      var_dump($fornecedores);
?>