<?php

include_once "../configs/load_env.php";
$token = $_ENV['WEBSOCKET_TOKEN'];
function sendWebSocket($array, $token) {

    $countedValues = array_count_values($array);
    $removidos = isset($countedValues[0]) ? $countedValues[0] : 0;
    $adicionados = isset($countedValues[1]) ? $countedValues[1] : 0;

    $postData = array(
        'type' => 'update-user',
        'message' => 'Disponibilização de saldo em massa por USER',
        'payload' => [
            'removidos' => $removidos,
            'adicionados' => $adicionados
        ]

    );

    $postUrl = 'https://socket.agudos.digital/update';
    //$postUrl = 'https://mqtt.agudos.net/teste';

    $ch = curl_init($postUrl);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'token: '.$token
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Executar o POST sem esperar por uma resposta
    curl_exec($ch);

    // Fechar a conexão cURL
    curl_close($ch);
}



header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ( isset($_POST['userSaldo']) ) {
        $userSaldos = $_POST['userSaldo'];

        function toInt($value)
        {
            return is_numeric($value) ? (int)$value : 0;
        }

        // Convertendo para arrays se não forem
        $userSaldos = is_array($userSaldos) ? $userSaldos : [$userSaldos];

        // Convertendo para inteiros se forem strings
        $sanitizedUserSaldos = array_map('toInt', $userSaldos);

        // Ajustando 'userSaldo' para 0 se não for 1
        $sanitizedUserSaldos = array_map(function ($saldo) {
            return $saldo == 1 ? 1 : 0;
        }, $sanitizedUserSaldos);


        $dsn = 'mysql:host=10.0.0.7;dbname=sandy_dev';
        $username = 'ederbatera';
        $password = 'Mion@03122022';
        
        // var_dump($sanitizedUserIds[$index]);
        // echo '<br>';
        // var_dump($sanitizedUserSaldos[$index]);
        
        // print_r($sanitizedUserSaldos);
        // echo '<br>';
        try {
            $db = new PDO($dsn, $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $db->beginTransaction();

            $query = "UPDATE funcionarios SET saldo = :saldo WHERE id = :id";
            $statement = $db->prepare($query);

              foreach ($sanitizedUserSaldos as $userId => $saldo) {
                // var_dump($userId);
                // echo '<br>';
                // var_dump($saldo);
                $statement->bindParam(':id', $userId, PDO::PARAM_INT);
                $statement->bindParam(':saldo', $saldo, PDO::PARAM_INT);
                $statement->execute();
            }

            $db->commit();

            $response = array('success' => true, 'message' => 'Dados atualizados com sucesso');
            echo json_encode($response);
        } catch (PDOException $e) {
            $db->rollback();

            $response = array('success' => false, 'message' => 'Erro ao atualizar dados: ' . $e->getMessage());
            echo json_encode($response);
        }
    } else {
        $response = array('success' => false, 'message' => 'Dados ausentes no formulário');
        echo json_encode($response);
    }
    sendWebSocket($sanitizedUserSaldos, $token);
} else {
    $response = array('success' => false, 'message' => 'Método de requisição inválido');
    echo json_encode($response);
}

?>