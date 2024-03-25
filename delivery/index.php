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
        <!-- <div class="alert alert-success" style="width: 20rem;">Teste de mensagem!</div> -->
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
                <div class="input-group input-group-lg">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-id-card"></i></span>
                    <input type="text" class="form-control" id="input_cartao" placeholder="CARTÃO" aria-label="CARTÃO"
                        aria-describedby="basic-addon1">
                </div>
            </div>
        </div>

        <div id="card-display">
            <div class="row justify-content-center placeholder-glow mt-3" id="display-espera">
                <div class="card placeholder" style="width: 50rem; height: 10rem;">
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row justify-content-center placeholder-glow mt-3 visually-hidden-focusable" id="display-error">
            <div class="card bg-danger" style="width: 50rem; height: 10rem;">
            <div class="card-body text-light text-center display-4 d-flex align-items-center fw-bolder">
                    <p class="m-auto" id="card-text-error">...</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center placeholder-glow mt-3 visually-hidden-focusable" id="display-sucesso">
            <div class="card bg-success" style="width: 50rem; height: 10rem;">
                <div class="card-body text-light text-center display-4 d-flex align-items-center fw-bolder ">
                    <p class="m-auto" id="card-text-sucesso">...</p>
                </div>
            </div>
        </div>

    </div> -->

        <div class="container pt-4">
            <div id="card-list" class="row overflow-auto ps-3" style="width:100%; max-height: 470px">
            </div>
        </div>


        <div class="footer fixed-bottom text-white-50 font-weight-light text-center bg-dark shadow-lg">

            <div class="card-header align-items-center pt-1">
                <div class="h6 text-white font-weight-light">&copy;
                    <?php echo date('Y') . " Delivery de Cestas - Prefeitura de Agudos/SP"; ?>
                </div>
                <div class="h6 text-white-50 font-weight-light" style="margin-top: -0.5em;">Versão
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
        <script src="card.js"></script>

        <?php echo '<script type="text/javascript"> var username="' . $user_nome . '"; var userid="' . $user_id . '"; </script>'; ?>


</body>

</html>