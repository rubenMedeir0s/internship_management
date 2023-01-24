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
            header("Location: ../Aluno/index.php");
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
    <title>Criar Docentes</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../CSS/Admin/styles.css" rel="stylesheet" />
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
                    href="viewDocentes.php">Voltar Atrás</a>
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <h1>Criar Docentes</h1>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                                <a class="dropdown-item" href="../../logout.php" name="logout">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page content-->
            <div class="container-fluid">
                <form action="personregisterhandler.php" method="POST">
                <table>
                        <tr>
                            <td>
                                Nome:
                            </td>
                            <td>
                                <input type="text" name="name" id="name" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>
                            Numero:
                            </td>
                            <td>
                                <input type="text" name="number" id="number" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>
                            Email:
                            </td>
                            <td>
                                <input type="text" name="email" id="email" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>
                            Username:
                            </td>
                            <td>
                                <input type="text" name="username" id="username" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>
                            Password:
                            </td>
                            <td>
                                <input type="password" name="password" id="password" class="form-control">
                            </td>
                        </tr>
                    </table>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info btn-sm">Criar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="../../JS/Responsavel/scripts.js"></script>

</html>
<?php
session_abort();