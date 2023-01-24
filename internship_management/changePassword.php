<?php
session_start();
require 'dbConnection.php';

if (!isset($_SESSION['userLoginType'])) {
    header("Location: index.php");
    return;
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Alterar Password</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="CSS/Docente/styles.css" rel="stylesheet" />
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
                    href="PHP/Docente/perfil.php">Voltar Atrás</a>   
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                <h2>Alterar Password</h2>
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
                                    <a class="dropdown-item" href="PHP/Docente/perfil.php">Perfil</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php" name="logout">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page content-->
            <div class="container-fluid">
                <!-- Campos Necessários para mudar a password: 
                    - Password antiga (Confirmar)
                    - Nova password 
                    - Confirmarm nova password 
                -->
                <form action="changePasswordHandler.php" method="post">
                    <table>
                        <tr>
                            <td>
                                <label>Password antiga: </label>&nbsp;&nbsp;
                            </td>
                            <td>
                                <input class="form-control" type="password"  name="oldPassword" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Nova password: </label>&nbsp;&nbsp;
                            </td>
                            <td>
                                <input class="form-control" type="password" name="newPassword" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Confirmar password: </label>&nbsp;&nbsp;
                            </td>
                            <td>
                                <input class="form-control" type="password" name="confirmNewPassword" required>
                            </td>
                        </tr>
                    </table>       
                    <br>
                        <button type="submit" name="atualizar-password" class="btn btn-primary">Atualizar Password</button>
                        <p id="erro"></p>                   
                </form>
            </div>
        </div>
    </div>
</body>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="JS/Responsavel/scripts.js"></script>
</html>
<?php
session_abort();