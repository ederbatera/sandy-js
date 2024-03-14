<?php  
  

    if (isset($_POST['formFuncionario-img-id']) && is_numeric($_POST['formFuncionario-img-id']))
    {
        $id = intval($_POST['formFuncionario-img-id']);

        try 
        {
            
            if (!array_map('unlink', glob("../img/perfil/".$id.".*")))
            {
                throw new Exception(':( Não foi possível deletar');
            }


            include_once '_conexao.php';
            $pdo = Conexao::getInstance();
            $query = $pdo->prepare("UPDATE funcionarios SET img = NULL WHERE id = '{$id}'");        
            $query->execute();

            $response['status'] = true;
            $response['img_link'] = 'null.jpg';
            header('Content-Type: application/json');
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
       
        }
        catch (Exception $e) 
        {
            $response['status'] = false;
            $response['error'] = $e->getMessage();
            header('Content-Type: application/json');
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        }

     
    }

?>
