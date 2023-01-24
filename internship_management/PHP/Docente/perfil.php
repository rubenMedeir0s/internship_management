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
            header("Location: ../Responsavel/index.php");
            break;
        case "EMPRESA":
            header("Location: ../Empresa/index.php");
            break;
        case "DOCENTE":
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
        <title>Ver Perfil</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../../CSS/Docente/styles.css" rel="stylesheet" />
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light">
                    <?php  if (isset($_SESSION['username'])) : ?>
                    <p>
                    <strong>
                        <?php echo $_SESSION['username']; ?>
                    </strong>
                    </p>
                    <?php endif ?>
                </div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" 
                        href="index.php">Voltar Atrás</a>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                    <h1>Ver Perfil</h1>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                                aria-expanded="false" aria-label="Toggle navigation"><span 
                                class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="sidebar-heading border-bottom bg-light">
                                        <?php  if (isset($_SESSION['userLoginType'])) : ?>
                                        <p>
                                        <strong>
                                            <?php echo $_SESSION['userLoginType']; ?>
                                        </strong>
                                        </p>
                                        <?php endif ?>
                                    </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#">Perfil</a>
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
                </table>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <?php
                        $id = $_SESSION['idLogin'];
                            $query = "SELECT * FROM docente WHERE autenticacao_id = '$id'";
                            $query_run = mysqli_query($conn, $query);
                            

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $docente) {
                            ?>
                            <tr>
                                <th>Número</th>
                                <thead>
                                <tbody>
                                    <td><?= $docente['numero']; ?></td>
                                </tbody>
                                <thead>
                                    <th>Nome</th>
                                <tbody>
                                    <td><?= $docente['nome']; ?></td>
                                </tbody>
                                <thead>
                                    <th>Email</th>
                                <tbody>
                                    <td><?= $docente['email']; ?></td>
                                </tbody>
                                <thead>
                                <th>Ações</th>
                                <tbody>
                                <td>
                                    <a href="atualizarPerfil.php" class="btn btn-danger btn-sm-12-12">Atualizar Perfil</a>
                                    <a href="../../changePassword.php" class="btn btn-info btn-sm-12-12">Alterar Pasword</a>
                                </td>
                                </tbody>
                            </tr>
                        </thead>
                    </tr>
                    
                        <?php
                            }
                        }
                        ?>  
                </table>
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