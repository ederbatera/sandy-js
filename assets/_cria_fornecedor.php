
<?php
require "_conexao.php";

$razao = trim($_POST['razao']); 
$codigo = trim($_POST['codigo']);  
$id_usuario = trim($_POST['id_usuario']);
header('Content-Type: application/json');  

$pdo = conexao::getInstance();


    try {
        
            try {
                $sql = "INSERT INTO fornecedores (razao, codigo, id_usuario)VALUES('{$razao}', '{$codigo}', '{$id_usuario}')";
                $stm = $pdo->prepare($sql);
                $stm->execute();
                if ($stm):
                    echo '{"status" : "ok", "icon" : "success", "title" : "Sucesso!", "html" : "Fornecedor adicionado!"}';
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