<?php
require '../../emailSender.php';
session_start();
require '../../dbConnection.php';

if (!isset($_SESSION['userLoginType'])) {
    header("Location: ../../index.php");
    return;
}

if ($_SESSION['userLoginType']) {
    $loginType = strtoupper($_SESSION['userLoginType']);
    switch ($loginType) {
        case "ADMIN":
            header("Location: ../Admin/index.php");
            break;
        case "RESPONSAVEL":
            header("Location: ../Responsavel/index.php");
            break;
        case "EMPRESA":
            header("Location: ../Empresa/index.php");
            break;
        case "DOCENTE":
            header("Location: ../Docente/index.php");
            break;
        case "ALUNO":
            break;
        default:
            header("Location: ../../index.php");
            break;
    }
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Aluno</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../CSS/Aluno/styles.css" rel="stylesheet" />
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading border-bottom bg-light">
                <?php if (isset($_SESSION['username'])): ?>
                    <p>
                        Bem vindo
                        <strong>
                            <?php echo $_SESSION['username']; ?>
                        </strong>
                    </p>
                <?php endif ?>
            </div>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                    href="propostasAluno.php">Propostas</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="verProposta.php">Ver
                    Proposta Candidatada</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="../Propostas/viewPropostasAluno.php">Criar propostas</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                    href="../../changePassword.php">Alterar Senha</a>
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                <h1>Página Inicial</h1>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><span
                            class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="sidebar-heading border-bottom bg-light">
                                        <?php if (isset($_SESSION['userLoginType'])): ?>
                                            <p>
                                                <strong>
                                                    <?php echo $_SESSION['userLoginType']; ?>
                                                </strong>
                                            </p>
                                        <?php endif ?>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="verPerfil.php">Perfil</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../../logout.php" name="logout">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page content-->
            <img src="../../assets/images/aluno3.jpg"
                        style="width:50%; display: block; margin-left: auto; margin-right: auto;">
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../../JS/Responsavel/scripts.js"></script>
</body>

</html>
<?php
session_abort();
?>