<?php

session_start();

if (isset ($_SESSION['key']) && $_SESSION['key'] == 'KLnNolTydrt56787897hggfs6tkjc3fv2va65fd'):

    switch ($_SESSION['permissao']) {
        case 1:
            header("Location: ../delivery");
            break;
        case 2:
            header("Location: ../");
            break;

        default:
            header("Location: ../delivery");
    }

endif;

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
        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-8">
                <center><img src="../../img/logo/logo.png" width="30%" height="30%"
                        alt="PREFEITURA MUNICIPAL DE AGUDOS"></center>
                <div class="h4 text-white text-center pb-3 pt-2">Entrega de cestas Básicas</div>
                <form id="form-login" role="form" action="/assets/_auth.php" method="post">
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Usuário"
                            required="required" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="senha" placeholder="Senha"
                            required="required" />
                    </div>
                    <input type="text" name="ip" placeholder="<?php echo $_SERVER['REMOTE_ADDR']; ?>"
                        value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" hidden />
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-danger h3 fs-bold text-center mt-3">
            <?php if (isset ($_SESSION['msg'])):
                echo $_SESSION['msg']; endif;
            unset($_SESSION['msg']); ?>
        </div>




    </div> <!-- FIM DO CONTAINER -->
</body>

</html>