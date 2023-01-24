<?php
require '../../dbConnection.php';
session_start();
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
        <title>Alunos</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../../CSS/Responsavel/styles.css" rel="stylesheet" />
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
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="index.php">Voltar Atrás</a>
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
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
                                        <a class="dropdown-item" href="#!">Ver Perfil</a>
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
                <table class="table table-bordered table-striped">
                    <tr>
                        <td>
                            <h1>Alunos</h1>
                            <div class="form-group">
                                <label>Importar Alunos</label>
                            </div>
                            <div class="form-group">
                            <form action="responsavelController.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" style="height: 100px;"
                                        required />
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="importar-alunos" class="btn btn-primary">
                                        Submeter
                                    </button>
                                </div>
                            </form>
                                <a href="importAlunos.php" class="btn btn-secondary ml-2">Cancelar</a>
                        </div>
                        </td>
                        <td>
                        
                        </td>
                    </tr>

                </table>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Numero</th>
                            <th>Nome</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                        $query = "SELECT * FROM aluno";
                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $aluno) {
                        ?>
                    
                        <tr>
                            <td><?= $aluno['id']; ?></td>
                            <td><?= $aluno['numero']; ?></td>
                            <td><?= $aluno['nome']; ?></td>
                            <td><?= $aluno['email']; ?></td>
                        </tr>
                    
                        <?php
                            }
                        }
                        ?>                       
                    </tbody>
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