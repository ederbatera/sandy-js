<?php
$estoque = [];

include_once '_conexao.php';
$pdo = Conexao::getInstance();

$limit = isset($_GET['limit']) && !empty($_GET['limit']) && $_GET['limit'] != "false" ? intval($_GET['limit']) : false;

if ($limit):

    $query = $pdo->prepare("SELECT A.id AS id, A.codigo_fornecedor, B.razao AS fornecedor, U.nome as user_create, A.data_atualizacao AS data_atualizacao, A.data_cadastro AS data_cadastro, A.quantidade AS quantidade
                                from estoque A  
                                INNER JOIN fornecedores B
                                ON A.codigo_fornecedor = B.id
                                INNER JOIN usuarios U
                                ON A.id_usuario = U.id
                                ORDER BY A.data_cadastro DESC LIMIT {$limit}");
    $query->execute();
    $number_of_rows = $query->rowCount();
    if ($number_of_rows > 0):
        while ($funcionario = $query->fetch(PDO::FETCH_ASSOC)) {
            $estoque[] = $funcionario;
        }

    endif;

else:
    $query = $pdo->prepare("SELECT A.id AS id, A.codigo_fornecedor, B.razao AS fornecedor, U.nome as user_create, A.data_atualizacao AS data_atualizacao, A.data_cadastro AS data_cadastro, A.quantidade AS quantidade
                                from estoque A  
                                INNER JOIN fornecedores B
                                ON A.codigo_fornecedor = B.id
                                INNER JOIN usuarios U
                                ON A.id_usuario = U.id
                                ORDER BY A.data_cadastro DESC");
    $query->execute();
    while ($funcionario = $query->fetch(PDO::FETCH_ASSOC)) {
        $estoque[] = $funcionario;
    }
endif;


header('Content-Type: application/json');
echo json_encode($estoque, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>