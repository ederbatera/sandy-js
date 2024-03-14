<?php

include_once '_conexao.php';
$pdo = Conexao::getInstance();
        
$query_total_opcao_cesta = $pdo->prepare("SELECT COUNT(*) AS total from funcionarios  WHERE opcao_cesta = 1");        
$query_total_opcao_cesta->execute();
$total["opcao_cesta"] = $query_total_opcao_cesta->fetch(PDO::FETCH_OBJ);

$query_total_direito_cesta = $pdo->prepare("SELECT COUNT(*) AS total from funcionarios  WHERE direito_cesta = 1");        
$query_total_direito_cesta->execute();
$total["direito_cesta"] = $query_total_direito_cesta->fetch(PDO::FETCH_OBJ);

$query_total_saldo = $pdo->prepare("SELECT COUNT(*) AS total from funcionarios  WHERE saldo = 1");        
$query_total_saldo->execute();
$total["saldo"] = $query_total_saldo->fetch(PDO::FETCH_OBJ);
   
header('Content-Type: application/json');
echo json_encode($total, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
?>