<?php

include_once '_conexao.php';
$pdo = Conexao::getInstance();

if (isset ($_POST['card']) && !empty ($_POST['card']) && is_numeric($_POST['card'])):
    $card = intval($_POST['card']);
else:
    $card = false;
endif;

$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : false;
$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : false;

header('Content-Type: application/json');

if ($card && $user_id && $user_name):

    $query = $pdo->prepare("SELECT * from funcionarios  WHERE cartao = ?");
    $query->bindParam(1, $card);
    $query->execute();
    $number_of_rows = $query->rowCount();

    if ($number_of_rows > 0):
        $funcionario = $query->fetch(PDO::FETCH_OBJ);
        $funcionario->localizado = 1;

        if ($funcionario->saldo > 0):
            try {
                $pdo->beginTransaction();
                if ( !$pdo->exec('UPDATE funcionarios SET saldo = 0 WHERE cartao = \'' . $card . '\'') || !$pdo->exec("INSERT INTO log_retiradas (id_funcionario, id_user) VALUES ( {$funcionario->id} , {$user_id} )") ) {
                    $pdo->rollback();
                    throw new Exception();
                }
                try {
                    $pdo->commit();
                    $funcionario->localizado = 1;
                    $funcionario->error = false;
                    $funcionario->saldo = 0;
                    $funcionario->msg = "Entrega com sucesso!";
                } catch (Exception $err) {
                    $funcionario->localizado = 1;
                    $funcionario->error = true;
                    $funcionario->msg = 'Erro ao salvar no banco de dados:<br>' . $err->getMessage();
                    die (json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                }

                //sendWebSocket($_POST);
            } catch (Exception $e) {
                $funcionario->localizado = 1;
                $funcionario->error = true;
                $funcionario->msg = 'Erro ao salvar no banco de dados:<br>' . $e->getMessage();
                die (json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }
        else:
            $funcionario->localizado = 1;
            $funcionario->error = true;
            $funcionario->msg = "Cartão sem saldo";
        endif;


    else:
        $funcionario['error'] = true;
        $funcionario['localizado'] = 0;
        $funcionario['msg'] = "Não localizado funcionário vinculado a este cartão";
        die (json_encode($funcionario, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    endif;

else:
    $funcionario['error'] = true;
    $funcionario['localizado'] = 0;
    $funcionario['msg'] = "Parâmetros errados ou ausentes";
    die (json_encode($funcionario, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
endif;


header('Content-Type: application/json');
echo json_encode($funcionario, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);



// POST WEBSOCKET

// include_once "../configs/load_env.php";
// $postData = array(
//     'type' => 'delivery',
//     'message' => $funcionario->nome. ' retirou sua cesta em '. time(),
//     'payload' => [
//         'user_id' => $user_id,
//         'id' => $funcionario->id
//     ]

// );
// $postUrl = 'https://socket.agudos.digital/sandy';
// $ch = curl_init($postUrl);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//     'Content-Type: application/json',
//     'token: '.$_ENV['WEBSOCKET_TOKEN']
// ));
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_exec($ch);
// curl_close($ch);
