<?php  
  

    if (isset($_POST['formFuncionario-img-matricula']) && is_numeric($_POST['formFuncionario-img-matricula']))
    {
        $matricula = intval($_POST['formFuncionario-img-matricula']);

        try 
        {
            
            if (!array_map('unlink', glob("../img/perfil/".$matricula.".*")))
            {
                throw new Exception(':( Não foi possível deletar');
            }


            include_once '_conexao.php';
            $pdo = Conexao::getInstance();
            $query = $pdo->prepare("UPDATE funcionarios SET img = NULL WHERE matricula = '{$matricula}'");        
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
