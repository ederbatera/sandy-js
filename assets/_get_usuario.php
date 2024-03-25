<?php
    header('Content-Type: text/html; charset=utf-8');

    include_once '_conexao.php';
    $pdo = Conexao::getInstance();


    $query = $pdo->prepare("SELECT id, nome, matricula, cargo, email, permissao, status FROM usuarios WHERE id = {$_POST['id']}");
    $query->execute();

  $data = $query->fetch(PDO::FETCH_OBJ);

    $data = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    echo $data;

?> 