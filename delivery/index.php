<?php

session_start();

if (!isset ($_SESSION['key']) or $_SESSION['key'] != 'KLnNolTydrt56787897hggfs6tkjc3fv2va65fd'):
    header("Location:logar.php");
    die();
endif;


$user_nome = isset ($_SESSION['nome']) ? $_SESSION['nome'] : 'UNKNOW';
$user_id = $_SESSION['id'];

// setcookie('user_name_katrina', $user_nome);
// setcookie('user_id_katrina',$user_id);
include_once '../configs/load_env.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="Cache-Control" content="no-cache">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Sandy - Agudos/SP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <style>
    </style>
</head>

<body style="background-color: darkcyan;">

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
        <div class="toast-container" id="liveAlertPlaceholder"></div>
    </div>

    <div class="container-fluid mt-1">
        <div class="row justify-content-between align-items-start">
            <div class="col">
                <img src="../../img/logo/logo.png" width="60px" height="60px" alt="PREFEITURA MUNICIPAL DE AGUDOS">
            </div>
            <div class="col">
                <h3 class="text-center mt-n1"> Delivery de Cestas Básicas</h3>
            </div>
            <div class="col text-end">
                <span>
                    <?php echo $user_nome; ?>
                </span>
                <a class="btn btn-primary">Sair</a>
            </div>
        </div>


        <!-- <center>
            <img src="../../img/logo/logo.png" width="100px" height="100px" alt="PREFEITURA MUNICIPAL DE AGUDOS">
        </center>
        <h3 class="text-center mt-n1"> Delivery de Cestas Básicas</h3> -->

        <div class="row mt-3 justify-content-center">
            <div class="col-2">
                <input class="form-control form-control-lg" type="password" placeholder="CARTÃO" id="input_cartao">
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="card text-bg-info" style="width: 50rem;">
                <div class="card-header placeholder-glow">
                    <span class="placeholder col-3"></span>
                </div>
                <div class="card-body">
                    <h5 class="card-title placeholder-glow">
                        <span class="placeholder col-6"></span>
                    </h5>
                    <p class="card-text placeholder-glow">
                        <span class="placeholder col-7"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-4"></span>
                    </p>
                </div>
            </div>
        </div>

    </div>

    <div class="container-fluid pt-4">
        <div class="row overflow-auto ps-3" style="width:100%; max-height: 470px">
            
                <div class="card text-bg-secondary mb-2">
                    <div class="card-header text-bg-secondary text-dark">
                        123456
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0 text-dark">
                            <p>EDER MACHADO</p>
                            <footer class="blockquote-footer text-white-50">
                                Entrega de cesta em:
                                <cite title="Source Title">22/01/2024 14:35</cite>
                            </footer>
                        </blockquote>
                    </div>
                </div>
                <div class="card text-bg-secondary mb-2">
                    <div class="card-header text-bg-secondary text-dark">
                        123456
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0 text-dark">
                            <p>EDER MACHADO</p>
                            <footer class="blockquote-footer text-white-50">
                                Entrega de cesta em:
                                <cite title="Source Title">22/01/2024 14:35</cite>
                            </footer>
                        </blockquote>
                    </div>
                </div>
                <div class="card text-bg-secondary mb-2">
                    <div class="card-header text-bg-secondary text-dark">
                        123456
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0 text-dark">
                            <p>EDER MACHADO</p>
                            <footer class="blockquote-footer text-white-50">
                                Entrega de cesta em:
                                <cite title="Source Title">22/01/2024 14:35</cite>
                            </footer>
                        </blockquote>
                    </div>
                </div>
        </div>
    </div>


        <div class="footer fixed-bottom text-white-50 font-weight-light text-center bg-dark shadow-lg">

            <div class="card-header align-items-center">
                <div class="h6 text-white font-weight-light">&copy;
                    <?php echo date('Y') . " Delivery de Cestas - Prefeitura de Agudos/SP"; ?>
                </div>
                <div class="h6 text-white-50 font-weight-light" style="margin-top: -0.5em;">Vesão
                    <?php echo $_ENV['VERSION']; ?>
                </div>
            </div>

        </div>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/226defac37.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.0/dist/js.cookie.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.2/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script src="https://cdn.socket.io/4.7.4/socket.io.min.js"></script>
        <script src="https://momentjs.com/downloads/moment.min.js"></script>
        <script src="https://momentjs.com/downloads/moment-timezone-with-data.min.js"></script>
        <script src="ws.js"></script>

        <?php echo '<script type="text/javascript"> var username="' . $user_nome . '"; var userid="' . $user_id . '"; </script>'; ?>


</body>

</html>