<?php
$estoque = [];

include_once '_conexao.php';
$pdo = Conexao::getInstance();

    $limit = isset($_POST['limit']) && !empty($_POST['limit']) && $_POST['limit'] != "false" ? $_POST['limit'] : false;

    if($limit):
        
        $query = $pdo->prepare("SELECT A.id AS id, B.razao AS fornecedor, A.data_atualizacao AS data_atualizacao, A.data_cadastro AS data_cadastro, A.quantidade AS quantidade
                                from estoque A  
                                INNER JOIN fornecedores B
                                ON A.codigo_fornecedor = B.id
                                ORDER BY A.data_cadastro DESC LIMIT {$limit}");        
        //$query->bindParam(1, $limit);
        $query->execute();
        $number_of_rows = $query->rowCount();
        if($number_of_rows > 0):
        while($funcionario = $query->fetch(PDO::FETCH_ASSOC)){
            //$estoque[$funcionario["id"]] = $funcionario;
            $estoque[] = $funcionario;
        }
            
        endif;
        
    else:    
        $query = $pdo->prepare("SELECT A.id AS id, B.razao AS fornecedor, A.data_atualizacao AS data_atualizacao, A.data_cadastro AS data_cadastro, A.quantidade AS quantidade
                                from estoque A  
                                INNER JOIN fornecedores B
                                ON A.codigo_fornecedor = B.id
                                ORDER BY A.data_cadastro DESC");
        $query->execute();
        while($funcionario = $query->fetch(PDO::FETCH_ASSOC)){
                //$estoque[$funcionario["id"]] = $funcionario;
                $estoque[] = $funcionario;
            }    
    endif;


    header('Content-Type: application/json');
    echo json_encode($estoque, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
//      var_dump($estoque);
?>
