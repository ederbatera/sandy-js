<?php  

include_once "../configs/load_env.php";
include_once '_conexao.php';
            
    function sendWebSocket($type, $obj) {
        $postData = array(
            'type' => $type,
            'message' => $obj['message'],
            'payload' => [
                'action' => $obj['operacao'],
                'userid' => $obj['userid']
            ]

        );
        $postUrl = 'https://socket.agudos.digital/sandy';
        $ch = curl_init($postUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'token: '.$_ENV['WEBSOCKET_TOKEN']
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }

    
    
    
    function setLog($type, $values) {
        $pdo = Conexao::getInstance();
        $query = "";
        switch ($type) {
            // case 'fornecedores':
            //     $query = "INSERT INTO log_fornecedores (id_funcionario, id_usuario, local_retirada, estoque_retirada) values ()";
            //     break;
            // case 'funcionarios':
            //     $query = "INSERT INTO log_funcionarios (id_funcionario, id_usuario, local_retirada, estoque_retirada) values ()";
            //     break;
            case 'retiradas':
                $query = "INSERT INTO log_retiradas (id_funcionario, id_user, local_retirada, estoque_retirada) values ( {$values['id_funcionario']}, {$values['id_user']}, {$values['local_retirada']}, {$values['estoque_retirada']})";
                break;
            case 'usuarios':
                $query = "INSERT INTO log_usuarios (id_user, msg) values ({$values['id_user']},{$values['msg']})";
                break; 
            default:
                $response['error']      = true;
                $response['message']    = 'Tipo de log inválido';
                die(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));  
        }

        try {
            $pdo->beginTransaction();           
            if(!$pdo->exec($query)){
                $pdo->rollback();
                throw new Exception();
            }
            try {
                $pdo->commit();
            } catch (Exception $err) {
                $response['error']      = true;
                $response['message']    = 'Erro ao salvar o log:<br>'.$err->getMessage();
                die(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));  
            }
            $response['error']      = false;
            $response['message']    = 'Log gravado';
            header('Content-Type: application/json');
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
        catch (Exception $e) {
            $response['error']      = true;
            $response['message']    = 'Erro ao salvar o log:<br>'.$e->getMessage();
            die(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

    }