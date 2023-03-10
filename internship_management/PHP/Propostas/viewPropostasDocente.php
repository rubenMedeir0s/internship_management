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
        case "ALUNO":
            header("Location: ../Aluno/index.php");
            break;
        case "DOCENTE":
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
    <title>Ver propostas</title>
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
                <a class="list-group-item list-group-item-action list-group-item-light p-3"
                    href="../Docente/index.php">Voltar Atr??s</a>

            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <h1>Propostas</h1>
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
                                    <a class="dropdown-item" href="../Docente/perfil.php">Perfil</a>
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
                    <tr>
                        <td>
                            <a href="createPropostasDocente.php" class="btn btn-success btn-sm">Criar nova proposta</a>
                        </td>
                    </tr>

                </table>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Titulo</th>
                            <th>Nome Docente</th>
                            <th>Aluno</th>
                            <th>Descri????o</th>
                            <th>??rea</th>
                            <th>PDF</th>
                            <th>Estado</th>
                            <th>A????es</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $query = "SELECT * FROM proposta_docente";
                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $proposta) {
                                ?>

                                <tr>
                                    <td><?= $proposta['id']; ?></td>
                                    <td>
                                        <?= $proposta['titulo']; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $sqli = "SELECT * FROM docente WHERE id = '$proposta[docente_id]'";
                                        $rs = mysqli_query($conn, $sqli);
                                        while ($row = mysqli_fetch_array($rs)) {
                                            echo '<option class="u-label u-label-3 u-border-1 u-border-black u-input u-input-rectangle">' . $row['nome'] . '</option>';
                                        }
                                        echo '</select>';
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $sqli = "SELECT * FROM aluno WHERE id = '$proposta[aluno_id]'";
                                        $rs = mysqli_query($conn, $sqli);
                                        while ($row = mysqli_fetch_array($rs)) {
                                            echo '<option class="u-label u-label-3 u-border-1 u-border-black u-input u-input-rectangle">' . $row['nome'] . '</option>';
                                        }
                                        echo '</select>';
                                        ?>
                                    </td>
                                    <td><?= $proposta['descricao']; ?></td>
                                    <td>
                                        <?php
                                        $sqli = "SELECT * FROM area WHERE id = '$proposta[area_id]'";
                                        $rs = mysqli_query($conn, $sqli);
                                        while ($row = mysqli_fetch_array($rs)) {
                                            echo '<option class="u-label u-label-3 u-border-1 u-border-black u-input u-input-rectangle">' . $row['name'] . '</option>';
                                        }
                                        echo '</select>';
                                        ?>
                                    </td>
                                    <td>
                                        <form action="propostasControllerDocente.php" method="POST" class="d-inline">
                                            <button type="submit" name="download-pdf" value="<?= $proposta['id']; ?>"
                                                class='btn btn-info btn-sm'>Download PDF</button>
                                        </form>
                                    </td>
                                    <td>
                                        <?php
                                        if ($proposta['status'] == 1) {
                                            echo '<b>Proposta Aprovada!</b>';
                                        } else {
                                            echo '<b>Proposta em Aprova????o!</b>';
                                        }
                                        ?>
                                    </td>
                                    <td>

                                        <a href="editPropostasDocente.php?id=<?= $proposta['id']; ?>"
                                            class="btn btn-info btn-sm">Atualizar</a>

                                        <form action="propostasControllerDocente.php" method="POST" class="d-inline">
                                            <button type="submit" name="apagar-proposta" value="<?= $proposta['id']; ?>"
                                                class="btn btn-danger btn-sm">Apagar</button>
                                            <a href="viewCandidaturasDocente.php?id=<?= $proposta['id']; ?>"
                                                class="btn btn-dark btn-sm">Candidaturas</a>
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
</body>

</html>

<?php
session_abort();
?>