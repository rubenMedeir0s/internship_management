<?php
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
            break;
        case "EMPRESA":
            header("Location: ../Empresa/index.php");
            break;
        case "DOCENTE":
            header("Location: ../Docente/index.php");
            break;
        case "ALUNO":
            header("Location: ../Aluno/index.php");
            break;
        default:
            header("Location: ../../index.php");
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
    <title>Responsável</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../CSS/Responsavel/styles.css" rel="stylesheet" />
    <link href="../../CSS/Responsavel/box.css" rel="stylesheet" />
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
                    href="importAlunos.php">Alunos</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                    href="alterarDocente.php">Docentes</a>
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
                            <li class="nav-item"><a class="nav-link" href="propostas.php">Propostas
                                    <?php
                                    $sqli = "SELECT COUNT(*) AS total_Propostas_Docente FROM proposta_docente WHERE status = 0";
                                    $result1 = mysqli_query($conn, $sqli);
                                    $sqli = "SELECT COUNT(*) AS total_Propostas_Empresa FROM proposta_empresa WHERE status = 0";
                                    $result2 = mysqli_query($conn, $sqli);
                                    $sqli = "SELECT COUNT(*) AS total_Propostas_Aluno FROM proposta_aluno WHERE status = 0";
                                    $result3 = mysqli_query($conn, $sqli);
                                    $data1 = mysqli_fetch_array($result1);
                                    $data2 = mysqli_fetch_array($result2);
                                    $data3 = mysqli_fetch_array($result3);
                                    $total_propostas_docente = $data1['total_Propostas_Docente'];
                                    $total_propostas_empresa = $data2['total_Propostas_Empresa'];
                                    $total_propostas_aluno = $data3['total_Propostas_Aluno'];
                                    $nPropostas = $total_propostas_docente + $total_propostas_empresa + $total_propostas_aluno;
                                    if ($nPropostas > 0 && $nPropostas <= 9) {
                                        ?>
                                        <div class='box red'>
                                            <?php
                                            echo $nPropostas;
                                            ?>
                                        </div>
                                        <?php
                                    } elseif ($nPropostas > 9) {
                                        ?>
                                        <div class='box red'>
                                            <?php
                                            echo "+9";
                                            ?>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class='box green'></div>
                                        <?php
                                    }
                                    ?>
                                </a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php
                                    // Check if the 'username' key is set
                                    if (isset($_SESSION['username'])) {
                                        // 'username' key is set, retrieve the username
                                        $username = $_SESSION['userLoginType'];
                                    } else {
                                        echo "ERRO";
                                    }
                                    ?>
                                    <div class="sidebar-heading border-bottom bg-light">
                                        <?php if (isset($_SESSION['userLoginType'])): ?>
                                            <p>
                                                <strong>
                                                    <?php echo $username; ?>
                                                </strong>
                                            </p>
                                        <?php endif ?>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="perfil.php">Ver Perfil</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../../logout.php">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page content-->
            <div class="container-fluid">
                <img src="../../assets/images/responsavel.png"
                    style="width:50%; display: block; margin-left: auto; margin-right: auto;">
            </div>
        </div>
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