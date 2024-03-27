<?php

include_once '_conexao.php';
$pdo = Conexao::getInstance();

if (isset($_POST['card']) && !empty($_POST['card']) && is_numeric($_POST['card'])):
    $card = intval($_POST['card']);
else:
    $card = false;
endif;

$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : false;
$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : false;

header('Content-Type: application/json');

if ($card && $user_id && $user_name):

    // Query para decrementar o saldo em 1, mas garantindo que não fique negativo
    $decrement = "UPDATE estoque 
    SET quantidade = CASE WHEN quantidade > 0 
    THEN quantidade - 1 
    ELSE quantidade END
    WHERE id = (SELECT MAX(id) FROM estoque)";

    $query = $pdo->prepare("SELECT * from funcionarios  WHERE cartao = ?");
    $query->bindParam(1, $card);
    $query->execute();
    $number_of_rows = $query->rowCount();

    if ($number_of_rows > 0):
        $funcionario = $query->fetch(PDO::FETCH_OBJ);
        $funcionario->localizado = 1;

        if ($funcionario->saldo > 0):

            // BAIXA O ESTOQUE
            if (!$pdo->exec($decrement) === TRUE) {
                $funcionario->localizado = 1;
                $funcionario->error = true;
                $funcionario->msg = "O estoque de cestas está vazio!";
                die(json_encode($funcionario, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            } 

            try {
                $pdo->beginTransaction();
                if (!$pdo->exec('UPDATE funcionarios SET saldo = 0 WHERE cartao = \'' . $card . '\'') || !$pdo->exec("INSERT INTO log_retiradas (id_funcionario, id_user) VALUES ( {$funcionario->id} , {$user_id} )")) {
                    $pdo->rollback();
                    throw new Exception();
                }
                try {
                    $pdo->commit();
                    $funcionario->localizado = 1;
                    $funcionario->error = false;
                    $funcionario->saldo = 0;
                    $funcionario->msg = "Entrega realizada com sucesso!";
                    echo json_encode($funcionario, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                } catch (Exception $err) {
                    $funcionario->localizado = 1;
                    $funcionario->error = true;
                    $funcionario->msg = 'Erro ao salvar no banco de dados:<br>' . $err->getMessage();
                    die(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                }

                //sendWebSocket($_POST);
            } catch (Exception $e) {
                $funcionario->localizado = 1;
                $funcionario->error = true;
                $funcionario->msg = 'Erro ao salvar no banco de dados:<br>' . $e->getMessage();
                die(json_encode($funcionario, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }
        else:
            $funcionario->localizado = 1;
            $funcionario->error = true;
            $funcionario->msg = "Cartão sem saldo";
            die(json_encode($funcionario, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        endif;


    else:
        $funcionario['error'] = true;
        $funcionario['localizado'] = 0;
        $funcionario['msg'] = "Cartão não cadastrado!";
        die(json_encode($funcionario, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    endif;

else:
    $funcionario['error'] = true;
    $funcionario['localizado'] = 0;
    $funcionario['msg'] = "Parâmetros errados ou ausentes";
    die(json_encode($funcionario, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
endif;

