<?php

    include_once '_conexao.php';
    $pdo = Conexao::getInstance();


    $query = $pdo->prepare("SELECT id, nome, matricula, cargo, email, permissao, status FROM usuarios");
    $query->execute();

    $usuarios = array();
    while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
        $usuarios[] = $data;
    }

    header('Content-Type: application/json');
    echo  json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
