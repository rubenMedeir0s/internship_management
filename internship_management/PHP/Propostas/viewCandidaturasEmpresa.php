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
            break;
        case "ALUNO":
            header("Location: ../Aluno/index.php");
            break;
        case "DOCENTE":
            header("Location: ../Docente/index.php");
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
    <title>Ver Candidaturas</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../CSS/Responsavel/styles.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
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
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="viewPropostasEmpresa.php">Voltar
                    Atrás</a>

            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <h1>Candidaturas</h1>
                <div class="container-fluid">
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
                                    <a class="dropdown-item" href="../Empresa/perfil.php">Perfil</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../../logout.php" name="logout">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page content-->
            <div class="container-fluid">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Numero</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $proposta_id = $_GET['id'];
                        $query = "SELECT * FROM aluno INNER JOIN candidaturas_empresa ON aluno.id = candidaturas_empresa.aluno_id WHERE candidaturas_empresa.proposta_empresa_id = '$proposta_id'";
                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $aluno) {
                                ?>

                                <tr>
                                    <td><?= $aluno['id']; ?></td>
                                    <td>
                                        <?= $aluno['numero']; ?>
                                    </td>
                                    <td><?= $aluno['nome']; ?></td>
                                    <td>
                                        <?= $aluno['email']; ?>
                                    </td>
                                    <td>


                                        <form action="propostasControllerEmpresa.php" method="POST" class="d-inline">
                                            <button type="submit" name="aceitar-candidatura"
                                                value="<?= strval($aluno['id']) . ";" . strval($proposta_id); ?>"
                                                class="btn btn-success btn-sm">Aceitar</button>
                                            <button type="submit" name="apagar-candidatura"
                                                value="<?= strval($aluno['id']) . ";" . strval($proposta_id); ?>"
                                                class="btn btn-danger btn-sm">Apagar</button>
                                        </form>
                                    </td>
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