<?php

session_start();

if (!isset ($_SESSION['key']) or $_SESSION['key'] != 'KLnNolTydrt56787897hggfs6tkjc3fv2va65fd'):
    header("Location: logar.php");
    die();

    if ($_SESSION['permissao'] == 1) {
        header("Location: /delivery");
    }

$user_nome = isset ($_SESSION['nome']) ? $_SESSION['nome'] : 'UNKNOW';
$user_id = $_SESSION['id'];
$permissao = $_SESSION['permissao'];

setcookie('user_name_sandy', $user_nome);
setcookie('user_id_sandy',$user_id);

include_once 'configs/load_env.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sandy | Cestas Básicas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-tabs-x@1.3.5/css/bootstrap-tabs-x-bs4.min.css" media="all"
        type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="css/tabs.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <?php echo '<script type="text/javascript"> var username="'.$user_nome.'"; var userid="'.$user_id.'"; </script>'; ?>
</head>

<body class="fs-6">

    <div class="container-fluid">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto align-self-start">
                <img src="../img/logo/logo.png" class="rounded" alt="..." style="width: 40px; height: 40px">
                <span class="fs-4">Gerenciamento de Cestas Básicas </span>
            </div>
            <div class="col-auto border rounded text-start">
                <span class="text-muted pl-2">Servidor: </span>
                <span id="server-status"></span>
                <span id="timestamp"><span>
            </div>
            <div class="col-auto border rounded">
                <span class="text-muted pl-2">Usuários Online: </span>
                <span class="badge bg-warning fw-bold fs-6 ml-3">
                    <span id="usersWS"> ? </span>
                </span>
            </div>
            <div class="col-auto border rounded">
                <span class="text-muted pl-2">Estoque: </span>
                <span class="badge bg-warning fw-bold fs-6 ml-3">
                    <span id="estoqueAll"> ? </span>
                </span>
            </div>
            <div class="col-4 border rounded">
                <span class="text-muted pl-2">Último evento: </span>
                <span class="badge bg-light text-primary fs-6 ml-3">
                    <span id="eventWS">Aguardando...</span>
                </span>
            </div>
            <div class="col-1 text-end px-1 text-primary">
                <!-- <button class="btn btn-sm btn-secondary" type="button">
                    <i class="fa-regular fa-user fa-xl p-1"></i>
                </button> -->
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle text-danger pr-2 text-decoration-none" id="menuUser"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <strong>
                            <?php echo $user_nome; ?>
                        </strong>
                    </button>
                    <div class="dropdown-menu dropdown-menu-dark dropdown-menu-right" aria-labelledby="menuUser">
                        <a class="dropdown-item" type="button" id="btnEditPerfil" data-bs-toggle="modal"
                            data-bs-target="#modalChangePerfil" onclick="getUsuario(userid)"
                            style="cursor:pointer;">Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" onclick="window.location.href='assets/_logout.php'">Sair</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>

    <div id="exTab3" class="container-fluid">
        <nav class="navbar navbar-expand-lg sticky-top">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-warning"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-start" id="navbarNav">

                <ul class="navbar-nav nav nav-tab nav-pills" id="kv-1" role="tablist">

                    <li class="nav-item" role="presentation">
                        <a class="nav-link px-3 active" style="cursor:pointer;" data-bs-target="#tab-dashboard"
                            role="tab" data-bs-toggle="tab" aria-controls="tab-dashboard" aria-selected="true">
                            <i class="fa-solid fa-chart-line fa-xl"></i>
                            <span class="">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link px-3" style="cursor:pointer;" data-bs-target="#tab-funcionarios" role="tab"
                            data-bs-toggle="tab" aria-controls="tab-funcionarios" aria-selected="true">
                            <i class="fa-solid fa-user-tag fa-xl"></i>
                            <span class="">Funcionários</span>
                        </a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link px-3" style="cursor:pointer;" data-bs-target="#tab-cestas" role="tab"
                            data-bs-toggle="tab" aria-controls="tab-cestas" aria-selected="false">
                            <i class="fa-solid fa-utensils fa-xl"></i>
                            <span class="ml-1">Cestas</span>
                        </a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link px-3" style="cursor:pointer;" data-bs-target="#tab-estoque" role="tab"
                            data-bs-toggle="tab" aria-controls="tab-estoque" aria-selected="false">
                            <i class="fa-solid fa-boxes-stacked fa-xl"></i>
                            <span class="ml-1">Estoque</span>
                        </a>
                    </li>

                    <!-- <li class="nav-item" role="presentation">
                        <a class="nav-link px-3" style="cursor:pointer;" data-bs-target="#tab-cartoes" role="tab"
                            data-bs-toggle="tab" aria-controls="tab-cartoes" aria-selected="false">
                            <i class="fa-regular fa-id-card fa-xl"></i>
                            <span class="ml-1">Cartões</span>
                        </a>
                    </li> -->

                    <li class="nav-item" role="presentation">
                        <a class="nav-link px-3" style="cursor:pointer;" data-bs-target="#tab-fornecedores" role="tab"
                            data-bs-toggle="tab" aria-controls="tab-fornecedores" aria-selected="false">
                            <i class="fa-solid fa-truck-fast fa-xl"></i>
                            <span class="ml-1">Fornecedores</span>
                        </a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link px-3" style="cursor:pointer;" data-bs-target="#tab-usuarios" role="tab"
                            data-bs-toggle="tab" aria-controls="tab-usuarios" aria-selected="false">
                            <i class="fa-solid fa-user fa-lg"></i>
                            <span class="ml-1">Usuários</span>
                        </a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link px-3" style="cursor:pointer;" data-bs-target="#tab-registros" role="tab"
                            data-bs-toggle="tab" aria-controls="tab-registros" aria-selected="false">
                            <i class="fa-solid fa-list-ul fa-lg"></i>
                            <span class="ml-1">Registros</span>
                        </a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link px-3" style="cursor:pointer;" data-bs-target="#tab-configuracoes" role="tab"
                            data-bs-toggle="tab" aria-controls="tab-configuracoes" aria-selected="false">
                            <i class="fa-solid fa-gears fa-lg"></i>
                            <span class="ml-1">Configurações</span>
                        </a>
                    </li>
        </nav>

        <div id="myTabContent" class="tab-content rounded">
            <?php
            include_once "tabs/dashboard.php";
            include_once "tabs/funcionarios.php";
            include_once "tabs/cestas.php";
            include_once "tabs/estoque.php";
            include_once "tabs/cartoes.php";
            include_once "tabs/fornecedores.php";
            include_once "tabs/usuarios.php";
            include_once "tabs/registros.php";
            include_once "tabs/configuracoes.php";
            ?>
        </div>



    </div>




    <?php
    include_once "modal.php";
    include_once "modal_altera_senha.php";
    include_once "modal_change_perfil.php";
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.6.0.min.js"><\/script>')</script>
    <script src="https://cdn.socket.io/4.7.2/socket.io.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-tabs-x@1.3.5/js/bootstrap-tabs-x.min.js"></script>
    <script src="https://kit.fontawesome.com/226defac37.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.0/dist/js.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.2/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/gets.js"></script>
    <script src="js/funcionarios.js"></script>
    <script src="js/cestas.js"></script>
    <script src="js/js.js"></script>
    <script src="js/main.js"></script>
    <script src="js/ws.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.fancytable/dist/fancyTable.min.js"></script>
    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script src="https://momentjs.com/downloads/moment-timezone-with-data.min.js"></script>

</body>

</html>