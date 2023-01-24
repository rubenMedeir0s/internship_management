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
            header("Location: ../Docente/index.php");
            break;
        case "ALUNO":
            break;
        default:
            header("Location: ../../index.php");
    }
}

?>  
<!DOCTYPE html>
<html lang="pt">
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="../../JS/Aluno/popUpCand.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Propostas Aluno</title>
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


<h1>Propostas das Empresas</h1>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Titulo</th>
            <th>Nome Empresa</th>
            <th>Descrição</th>
            <th>Área</th>
            <th>PDF</th>
            <th>Estado</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>

    <?php
    $query = "SELECT * FROM proposta_empresa WHERE status = '1' AND aluno_id = 'null'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $proposta) {
            ?>
    
                <tr>
                    <td><?= $proposta['id']; ?></td>
                    <td><?= $proposta['titulo']; ?></td>
                    <td>
                        <?php
                        $sqli = "SELECT * FROM empresa WHERE id = '$proposta[empresa_id]'";
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
                    <form action="propostasAlunoController.php" method="POST" class="d-inline">
                                    <button type="submit" name="download-pdf-empresa" value="<?= $proposta['id']; ?>"
                                        class='btn btn-info btn-sm'>Download PDF</button>
                                </form>
                    </td>
                    <td>
                        <?php
                        if ($proposta['status'] == 1) {
                            echo '<b>Proposta Aprovada!</b>';
                        } else {
                            echo '<b>Proposta em Aprovação!</b>';
                        }
                        ?>
                    </td>
                    <td style="text-align: center;">
                    <form action="propostasAlunoController.php" method="post">
                        <div class="form-group">
                            <?php
                            if (isset($_SESSION['userLoginType'])) {
                                $proposta_id = $proposta['id'];
                                $authenticationId = $_SESSION['idLogin'];
                                $personId = -1;

                                $queryStudentId = "SELECT id FROM aluno WHERE autenticacao_id = '$authenticationId'";
                                $result = mysqli_query($conn, $queryStudentId);
                                while ($row = mysqli_fetch_array($result)) {
                                    $personId = $row['id'];
                                }

                                if ($personId == -1) {
                                    header("Location: propostasAluno.php");
                                    return;
                                }

                                $hasProposta = false;

                                $query = "SELECT id FROM proposta_docente WHERE aluno_id = '$personId'";
                                $query_run = mysqli_query($conn, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    $hasProposta = true;
                                }

                                if (!$hasProposta) {
                                    $query = "SELECT id FROM proposta_empresa WHERE aluno_id = '$personId'";
                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        $hasProposta = true;
                                    }
                                }

                                if (!$hasProposta) {
                                    $query = "SELECT id FROM proposta_aluno WHERE aluno_id = '$personId' AND status = '1'";
                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        $hasProposta = true;
                                    }
                                }

                                $queryContains = "SELECT * FROM candidaturas_empresa WHERE aluno_id = '$personId' AND proposta_empresa_id = '$proposta_id'";
                                $result = mysqli_query($conn, $queryContains);
                                if (mysqli_num_rows($result) == 0 && !$hasProposta): ?>
                                            <button type="submit" name="candidatar-empresa" value="<?= $proposta['id']; ?>" class="btn btn-primary">Candidatar-se</button>
                                            <?php
                                elseif (!$hasProposta): ?>
                                        <button type="submit" name="candidatar-remover-empresa" value="<?= $proposta['id']; ?>" class="btn btn-danger btn-primary">Remover candidatura</button>
                                    <?php endif;
                            }
                            ?>
                        </div>
                    </form>
                    </td>
                </tr>
    
                <?php
        }
    }
    ?>                       
    </tbody>
</table>

<h1>Propostas dos Docentes</h1>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Titulo</th>
            <th>Nome Docente</th>
            <th>Descrição</th>
            <th>Área</th>
            <th>PDF</th>
            <th>Estado</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>

    <?php
    $query = "SELECT * FROM proposta_docente WHERE status = '1' AND aluno_id = 'null'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $proposta) {
            ?>
    
                <tr>
                    <td><?= $proposta['id']; ?></td>
                    <td><?= $proposta['titulo']; ?></td>
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
                    <form action="propostasAlunoController.php" method="POST" class="d-inline">
                                    <button type="submit" name="download-pdf-docente" value="<?= $proposta['id']; ?>"
                                        class='btn btn-info btn-sm'>Download PDF</button>
                                </form>
                    </td>
                    </td>
                    <td>
                        <?php
                        if ($proposta['status'] == 1) {
                            echo '<b>Proposta Aprovada!</b>';
                        } else {
                            echo '<b>Proposta em Aprovação!</b>';
                        }
                        ?>
                    </td>
                    <td style="text-align: center;">
                    <form action="propostasAlunoController.php" method="post">
                        <div class="form-group">
                            <?php
                            if (isset($_SESSION['userLoginType'])) {
                                $proposta_id = $proposta['id'];
                                $authenticationId = $_SESSION['idLogin'];
                                $personId = -1;

                                $queryStudentId = "SELECT id FROM aluno WHERE autenticacao_id = '$authenticationId'";
                                $result = mysqli_query($conn, $queryStudentId);
                                while ($row = mysqli_fetch_array($result)) {
                                    $personId = $row['id'];
                                }

                                if ($personId == -1) {
                                    header("Location: propostasAluno.php");
                                    return;
                                }

                                $hasProposta = false;

                                $query = "SELECT id FROM proposta_docente WHERE aluno_id = '$personId'";
                                $query_run = mysqli_query($conn, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    $hasProposta = true;
                                }

                                if (!$hasProposta) {
                                    $query = "SELECT id FROM proposta_empresa WHERE aluno_id = '$personId'";
                                    $query_run = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($query_run) > 0) {
                                        $hasProposta = true;
                                    }
                                }

                                $queryContains = "SELECT * FROM candidaturas_docente WHERE aluno_id = '$personId' AND proposta_docente_id = '$proposta_id'";
                                $result = mysqli_query($conn, $queryContains);
                                if (mysqli_num_rows($result) == 0 && !$hasProposta): ?>
                                            <button type="submit" name="candidatar-docentes" value="<?= $proposta['id']; ?>" class="btn btn-primary">Candidatar-se</button>
                                            <?php
                                elseif (!$hasProposta): ?>
                                        <button type="submit" name="candidatar-remover-docentes" value="<?= $proposta['id']; ?>" class="btn btn-danger btn-primary">Remover candidatura</button>
                                    <?php endif;
                            }
                            ?>
                        </div>
                    </form>
            
                </td>
                </tr>
    
                <?php
        }
    }
    ?>                       
        </tbody>
    </table>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../../JS/Responsavel/scripts.js"></script>
    </body>
</html>
<?php
session_abort();
?>