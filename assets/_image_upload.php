<?php   

    if (!empty($_FILES['formFuncionario-img-change']))
    {
        $ext    = pathinfo($_FILES['formFuncionario-img-change']['name'], PATHINFO_EXTENSION);
        $name   = $_POST['formFuncionario-img-matricula'].'.'.$ext ;
        $id     = intval($_POST['formFuncionario-img-matricula']); 

        try 
        {
            if (!move_uploaded_file($_FILES['formFuncionario-img-change']['tmp_name'], '../img/perfil/'.$_POST['formFuncionario-img-matricula'].'.'.$ext))
            {
                throw new Exception('Could not move file');
            }


            include_once '_conexao.php';
            $pdo = Conexao::getInstance();
            $query = $pdo->prepare("UPDATE funcionarios SET img = '{$name}' WHERE matricula = '{$matricula}'");        
            $query->execute();

            $response['status'] = true;
            $response['img_link'] = $_POST['formFuncionario-img-matricula'].'.'.$ext;
            header('Content-Type: application/json');
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
       
        }
        catch (Exception $e) 
        {
            $response['status'] = false;
            $response['error'] = $e->getMessage();
            header('Content-Type: application/json');
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            //die ('File did not upload: ' . $e->getMessage());
        }

     
    }

?>
