<?php
$retiradas = [];

include_once '_conexao.php';
$pdo = Conexao::getInstance();

$limit = isset($_GET['limit']) && !empty($_GET['limit']) && $_GET['limit'] != "false" ? intval($_GET['limit']) : false;

if ($limit):

    $query = $pdo->prepare("SELECT R.id, R.estoque, R.data_retirada, F.razao as fornecedor, U.nome as usuario
                                FROM log_retiradas R  
                                INNER JOIN fornecedores F
                                ON R.codigo_fornecedor = F.id
                                INNER JOIN usuarios U
                                ON R.id_user = U.id
                                INNER JOIN estoque E
                                ON R.estoque = E.id
                                ORDER BY R.id DESC LIMIT {$limit}");
    $query->execute();
    $number_of_rows = $query->rowCount();
    if ($number_of_rows > 0):
        while ($retirada = $query->fetch(PDO::FETCH_ASSOC)) {
            $retiradas[] = $retirada;
        }

    endif;

else:
    $query = $pdo->prepare("SELECT R.id, R.estoque, R.data_retirada, FU.nome as funcionario, FU.matricula as matricula, FO.razao as fornecedor, U.nome as usuario
                                FROM log_retiradas R  
                                INNER JOIN fornecedores FO
                                ON R.codigo_fornecedor = FO.id
                                INNER JOIN usuarios U
                                ON R.id_user = U.id
                                INNER JOIN estoque E
                                ON R.estoque = E.id
                                INNER JOIN funcionarios FU
                                ON R.id_funcionario = FU.id
                                ORDER BY R.id DESC");
    $query->execute();
    while ($retirada = $query->fetch(PDO::FETCH_ASSOC)) {
        $retiradas[] = $retirada;
    }
endif;


header('Content-Type: application/json');
echo json_encode($retiradas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>