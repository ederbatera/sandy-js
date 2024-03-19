<?php  

include_once "../configs/load_env.php";

            
    function sendWebSocket($obj) {

        $postData = array(
            'type' => 'update-user',
            'message' => 'Alteração de saldo de Usuário',
            'payload' => [
                'action' => $obj['operacao'],
                'userid' => $obj['userid']
            ]

        );

        $postUrl = 'https://socket.agudos.digital/update';

        $ch = curl_init($postUrl);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'token: '.$_ENV['WEBSOCKET_TOKEN']
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Executar o POST sem esperar por uma resposta
        curl_exec($ch);

        // Fechar a conexão cURL
        curl_close($ch);
    }


if (isset($_POST['operacao']) && is_numeric($_POST['userid'])) 
    {
        $id         = intval($_POST['userid']);
        $operacao   = $_POST['operacao'];
        $response   = [];
        include_once '_conexao.php';
        $pdo = Conexao::getInstance();

        switch ($operacao) { 
            case 'adicionar':
                try {
                    $pdo->beginTransaction();           
                    if(!$pdo->exec('UPDATE funcionarios SET saldo = 1 WHERE id = \''.$id.'\'')){
                        $pdo->rollback();
                        throw new Exception();
                    }
                    try {
                        $pdo->commit();
                    } catch (Exception $err) {
                        $response['error']      = true;
                        $response['message']    = 'Erro ao salvar no banco de dados:<br>'.$err->getMessage();
                        die(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));  
                    }
                    $response['error']      = false;
                    $response['message']    = 'Saldo adicionado com sucesso';
                    header('Content-Type: application/json');
                    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                    sendWebSocket($_POST);
                }
                catch (Exception $e) {
                    $response['error']      = true;
                    $response['message']    = 'Erro ao salvar no banco de dados:<br>'.$e->getMessage();
                    die(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                }

                break;

            case 'remover':
                try {
                    $pdo->beginTransaction();           
                    if(!$pdo->exec('UPDATE funcionarios SET saldo = 0 WHERE id = \''.$id.'\'')){
                        $pdo->rollback();
                        throw new Exception();
                    }
                    try {
                        $pdo->commit();
                    } catch (Exception $err) {
                        $response['error']      = true;
                        $response['message']    = 'Erro ao salvar no banco de dados:<br>'.$err->getMessage();
                        die(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));  
                    }
                    $response['error']      = false;
                    $response['message']    = 'Saldo removido com sucesso';
                    header('Content-Type: application/json');
                    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                    sendWebSocket($_POST);
                }
                catch (Exception $e) {
                    $response['error']      = true;
                    $response['message']    = 'Erro ao salvar no banco de dados:<br>'.$e->getMessage();
                    die(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                }
                break;
        }
     
    }
else
    {
        $response['error']      = true;
        $response['message']    = 'Operação inválida';
        header('Content-Type: application/json');
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

?>