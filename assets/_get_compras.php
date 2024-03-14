<?php
$compras = [];

include_once '_conexao.php';
$pdo = Conexao::getInstance();

    $limit = isset($_POST['limit']) && !empty($_POST['limit']) && $_POST['limit'] != "false" ? $_POST['limit'] : false;

    if($limit):
        
        $query = $pdo->prepare("SELECT * from compras A 
                                INNER JOIN fornecedores B
                                ON A.codigo_fornecedor = B.id
                                ORDER BY A.data_cadastro DESC LIMIT {$limit}");        
        //$query->bindParam(1, $limit);
        $query->execute();
        $number_of_rows = $query->rowCount();
        if($number_of_rows > 0):
        while($funcionario = $query->fetch(PDO::FETCH_ASSOC)){
            //$compras[$funcionario["id"]] = $funcionario;
            $compras[] = $funcionario;
        }
            
        endif;
        
    else:    
        $query = $pdo->prepare("SELECT * from compras A 
                                INNER JOIN fornecedores B
                                ON A.codigo_fornecedor = B.id
                                ORDER BY A.data_cadastro DESC");
        $query->execute();
        while($funcionario = $query->fetch(PDO::FETCH_ASSOC)){
                //$compras[$funcionario["id"]] = $funcionario;
                $compras[] = $funcionario;
            }    
    endif;


    header('Content-Type: application/json');
    echo json_encode($compras, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
//      var_dump($compras);
?>