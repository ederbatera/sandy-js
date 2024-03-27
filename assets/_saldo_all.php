<?php

include_once "../configs/load_env.php";
$db_user = $_ENV['DB_USER'];
$db_pass = $_ENV['DB_PASS'];
$db_name = $_ENV['DB_NAME'];
$db_host = $_ENV['DB_HOST'];

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


        $dsn = 'mysql:host='.$db_host.';dbname='.$db_name;
        
        // var_dump($sanitizedUserIds[$index]);
        // echo '<br>';
        // var_dump($sanitizedUserSaldos[$index]);
        
        // print_r($sanitizedUserSaldos);
        // echo '<br>';
        try {
            $db = new PDO($dsn, $db_user, $db_pass);
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
} else {
    $response = array('success' => false, 'message' => 'Método de requisição inválido');
    echo json_encode($response);
}

?>