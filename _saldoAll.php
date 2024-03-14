<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ( /* isset($_POST['userId']) && */ isset($_POST['userSaldo'])) {
        //$userIds = $_POST['userId'];
        $userSaldos = $_POST['userSaldo'];

        function toInt($value)
        {
            return is_numeric($value) ? (int)$value : 0;
        }

        // Convertendo para arrays se não forem
        // = is_array($userIds) ? $userIds : [$userIds];
        $userSaldos = is_array($userSaldos) ? $userSaldos : [$userSaldos];

        // Convertendo para inteiros se forem strings
        // = array_map('toInt', $userIds);
        $sanitizedUserSaldos = array_map('toInt', $userSaldos);

        // Ajustando 'userSaldo' para 0 se não for 1
        $sanitizedUserSaldos = array_map(function ($saldo) {
            return $saldo == 1 ? 1 : 0;
        }, $sanitizedUserSaldos);

        // if (count($sanitizedUserIds) !== count($sanitizedUserSaldos)) {
        //     $response = array('success' => false, 'message' => 'Quantidade de IDs e saldos diferente');
        //     echo json_encode($response);
        //     exit;
        // }

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

//            $valuesToUpdate = array_combine($sanitizedUserIds, $sanitizedUserSaldos);

            //foreach ($valuesToUpdate as $userId => $saldo) {
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
} else {
    $response = array('success' => false, 'message' => 'Método de requisição inválido');
    echo json_encode($response);
}
?>