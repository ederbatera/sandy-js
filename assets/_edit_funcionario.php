<?php  

if (isset($_POST["operacao"])) 
    {
        $operacao   = $_POST["operacao"];
        $response   = [];
        include_once '_conexao.php';
        $pdo = Conexao::getInstance();

        switch ($operacao) { 
            case 'adicionar':
                $cartao = !empty($_POST["cartao"]) ? "'".$_POST["cartao"]."'" : "NULL" ;
                $celular = !empty($_POST["celular"]) ? "'".$_POST["celular"]."'" : "NULL" ;
                try {
                    $pdo->beginTransaction();           
                    if(!$pdo->exec("INSERT into funcionarios
                        (matricula, cartao, nome, vinculo, lotacao, local_trabalho, cargo, folha, secretaria, email, celular, direito_cesta, opcao_cesta, obs, ativo)

                        VALUES (
                            '{$_POST["matricula"]}',
                            $cartao,
                            '{$_POST["nome"]}',
                            '{$_POST["vinculo"]}',
                            '{$_POST["lotacao"]}',
                            '{$_POST["local_trabalho"]}',
                            '{$_POST["cargo"]}',
                            '{$_POST["folha"]}',
                            '{$_POST["secretaria"]}',
                            '{$_POST["email"]}',
                            {$celular},
                            '{$_POST["direito_cesta"]}',
                            '{$_POST["opcao_cesta"]}',
                            '{$_POST["obs"]}',
                            '{$_POST["ativo"]}'
                        )")){
                        $pdo->rollback();
                        throw new Exception();
                    }
                    try {
                        $pdo->commit();
                    } catch (Exception $err) {
                        $response['error']      = true;
                        $response['message']    = $err->getMessage();
                        die(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));  
                    }
                    $response['error']      = false;
                    $response['message']    = $_POST["nome"].' cadastrado!';
                    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                }
                catch (Exception $e) {
                    $response['error']      = true;
                    $response['message']    = $e->getMessage();
                    die(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                }

                break;

            case 'editar': 
                $cartao = !empty($_POST["cartao"]) ? "'".$_POST["cartao"]."'" : "NULL" ;
                $celular = !empty($_POST["celular"]) ? "'".$_POST["celular"]."'" : "NULL" ;
                $direito = intval($_POST["direito_cesta"]);
                try {
                    $pdo->beginTransaction();           
                    if(!$pdo->exec("UPDATE funcionarios SET 
                        matricula = '{$_POST["matricula"]}', 
                        cartao = {$cartao}, 
                        nome = '{$_POST["nome"]}', 
                        vinculo = '{$_POST["vinculo"]}', 
                        lotacao = '{$_POST["lotacao"]}', 
                        local_trabalho = '{$_POST["local_trabalho"]}', 
                        cargo = '{$_POST["cargo"]}', 
                        folha = '{$_POST["folha"]}', 
                        secretaria = '{$_POST["secretaria"]}', 
                        email = '{$_POST["email"]}', 
                        celular = {$celular}, 
                        direito_cesta = {$direito}, 
                        opcao_cesta = {$_POST["opcao_cesta"]},  
                        obs = '{$_POST["obs"]}', 
                        ativo = {$_POST["ativo"]}
                        WHERE id = {$_POST["id"]}
                    ")){
                        $pdo->rollback();
                        throw new Exception();
                    }
                    try {
                        $pdo->commit();
                    } catch (Exception $err) {
                        $response['error']      = true;
                        $response['message']    = $err->getMessage();
                        die(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));  
                    }
                    $response['error']      = false;
                    $response['message']    = 'Alterações salvas!';
                    echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                }
                catch (Exception $e) {
                    $response['error']      = true;
                    $response['message']    = $e->getMessage();
                    die(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                }
                break;
        }
     
    }
else
    {
        $response['error']      = true;
        $response['message']    = 'Invalid operacao';
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

?>