<?php

session_start();

if(isset($_SESSION['key']) &&  $_SESSION['key'] == 'KLnNolTydrt56787897hggfs6tkjc3fv2va65fd'):
	header("Location: ../");
endif;

// $cookieUser = isset($_COOKIE['userSession']) ? $_COOKIE['userSession'] : '';

// if(!empty($cookieUser)):

//             $cookieRecovery = "'".$_COOKIE['userSession']."'";
//             include_once 'assets/_conexao.php';
//             $conexao = Conexao::getInstance();
//             $sql = "SELECT COUNT(*) FROM cookies WHERE cookie = {$cookieRecovery}";
//             $stm = $conexao->prepare($sql);
//             $stm->execute();
//             $numRows = $stm->fetchColumn();
//             if ($numRows > 0):
//                 $sqlc = "SELECT * FROM cookies WHERE cookie = {$cookieRecovery}";
//                 $stmc = $conexao->prepare($sqlc);
//                 $stmc->execute();
//                 $retornoc = $stmc->fetch(PDO::FETCH_OBJ);
//                 $id = "'".$retornoc->usuario."'";
//                 $sql2 = "SELECT * FROM usuarios WHERE id = ".$id ;
//                 $stm2 = $conexao->prepare($sql2);
//                 $stm2->execute();
//                 $retorno2 = $stm2->fetch(PDO::FETCH_OBJ);

//                 $_SESSION['id'] = $retorno2->id;
//                 $name_exploded = explode(' ', $retorno2->nome);
//                 $_SESSION['first_name'] = $name_exploded[0];
//                 $_SESSION['last_name'] = $name_exploded[1];
//                 $_SESSION['full_name']  = $retorno2->nome;
//                 $_SESSION['nome'] = $retorno2->nome;
//                 $_SESSION['permissao'] = $retorno2->permissao;
//                 $_SESSION['email'] = $retorno2->email;
//                 $_SESSION['cargo'] = $retorno2->cargo;
//                 $_SESSION['matricula'] = $retorno2->matricula;
//                 $_SESSION['key'] = 'KLnNolTydrt56787897hggfs6tkjc3fv2va65fd';
//                 setcookie('user_name_katrina', $retorno2->nome, time()+(3600*24)*30, '/');
//                 setcookie('user_id_katrina', $retorno2->id, time()+(3600*24)*30, '/');

//                 $stma = $conexao->prepare("DELETE FROM cookies WHERE id = {$retorno2->id} AND validade < NOW()");
//                 $stma->execute();

//                 $ip = $_SERVER['REMOTE_ADDR'];                
//                 $sql3 = "INSERT INTO log_login (usuario, ip, metodo) VALUES ('{$retorno2->id}', '{$ip}', 'Cookie')";
//                 $stm3 = $conexao->prepare($sql3);
//                 $stm3->execute();

//                 if($stm3):                
//                     header("Location: ../");
//                 else:
//                     echo "Erro ao cadastrar log";
//                 endif;

//             endif;


// endif;

?>

<!DOCTYPE html>
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
     <script src="https://kit.fontawesome.com/226defac37.js" crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<title>Entrega de Cestas Básicas</title>
</head>
<body class="bg-secondary">
    <div class="container">
    


        <div style="padding-top: 20%;"></div>
        <div class="row justify-content-center" >
            <div class="col-lg-4 col-sm-8">
                <center><img src="../../img/logo/logo.png" width="30%" height="30%" alt="PREFEITURA MUNICIPAL DE AGUDOS"></center>                
                <div class="h4 text-white text-center pb-3 pt-2">Entrega de cestas Básicas</div>
                <form id="form-login" role="form" action="_auth.php" method="post">
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Usuário" required="required" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="senha" placeholder="Senha" required="required" />
                    </div>
                    <!-- <div class="form-group form-check">
                        <input class="form-check-input" type="checkbox" id="saveSession" name="saveSession">
                        <label class="form-check-label text-white-50" for="exampleCheck1">Manter-me logado</label>
                    </div> -->
                    <input type="text" name="ip" placeholder="<?php echo $_SERVER['REMOTE_ADDR']; ?>" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" hidden />
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-danger h3 fs-bold text-center mt-3"><?php if (isset($_SESSION['msg'])): echo $_SESSION['msg']; endif; unset($_SESSION['msg']); ?></div>




</div> <!-- FIM DO CONTAINER -->
</body>
</html>