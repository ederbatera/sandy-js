
<?php
require "_conexao.php";

$quantidade = trim($_POST['quantidade']); 
$codigo_fornecedor = trim($_POST['codigo_fornecedor']);  
$id_usuario = trim($_POST['id_usuario']);
header('Content-Type: application/json');  

$pdo = conexao::getInstance();


    try {
        
            try {
                $sql = "INSERT INTO estoque (quantidade, codigo_fornecedor, id_usuario)VALUES('{$quantidade}', '{$codigo_fornecedor}', '{$id_usuario}')";
                $stm = $pdo->prepare($sql);
                $stm->execute();
                if ($stm):
                    echo '{"status" : "ok", "icon" : "success", "title" : "Sucesso!", "html" : "Estoque adicionado!"}';
                else: 
                    echo '{"status" : "erro", "icon" : "error", "title" : "Erro", "html" : "Erro inesperado"}';
                endif;                

                } catch (Exception $e) {
                  echo '{"status" : "erro", "icon" : "error", "title" : "Erro", "html" : "'.$e.'"}';
                  die();  
                }

    } catch (Exception $e) {
      echo '{"status" : "erro", "icon" : "error", "title" : "Error:", "html" : "'.$e.'"}';
      die();  
    }