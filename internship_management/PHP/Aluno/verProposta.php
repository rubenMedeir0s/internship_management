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
        <title>Propostas</title>
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
                $query = "SELECT * FROM aluno WHERE autenticacao_id = '$id'";
                $query_run = mysqli_query($conn, $query);
                
                $alunoId = -1;

                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $aluno) {
                        $alunoId = $aluno['id'];
                    }
                }

                if ($alunoId == -1) {
                    session_destroy();
                    header("Location: ../../index.php");
                    exit(0);
                }

                $query = "SELECT * FROM proposta_docente WHERE aluno_id = '$alunoId'";
                $query_run = mysqli_query($conn, $query);
                $isResult = false;
                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $proposta) {
                        $isResult = true;

                ?>
                            <tr>
                            <th>Número</th>
                                <thead>
                                <tbody>
                                    <td><?= $proposta['id']; ?></td>
                                </tbody>
                                <thead>
                                    <th>Titulo</th>
                                <tbody>
                                    <td><?= $proposta['titulo']; ?></td>
                                </tbody>
                                <thead>
                                    <th>Docente</th>
                                <tbody>
                                    <td><?php
                                            $sqli = "SELECT * FROM docente WHERE id = '$proposta[docente_id]'";
                                            $rs = mysqli_query($conn, $sqli);
                                            while ($row = mysqli_fetch_array($rs)) {
                                                echo '<option class="u-label u-label-3 u-border-1 u-border-black u-input u-input-rectangle">' . $row['nome'] . '</option>';
                                            }
                                            echo '</select>';
                                        ?></td>
                                </tbody>
                                <thead>
                                    <th>Descrição</th>
                                <tbody>
                                    <td><?= $proposta['descricao']; ?></td>
                                </tbody>
                                <thead>
                                    <th>Area</th>
                                <tbody>
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
                                </tbody>
                                <thead>
                                    <th>PDF</th>
                                <tbody>
                                    <td><form action="propostasAlunoController.php" method="POST" class="d-inline">
                            <button type="submit" name="download-pdf-docente" value="<?= $proposta['id']; ?>"
                                class='btn btn-info btn-sm'>Download PDF</button>
                        </form>
            </td></td>
                                </tbody>
                            </tr>
                        </thead>
                    </tr>
                    
                    <?php
                            }
                        }

                        $query = "SELECT * FROM proposta_empresa WHERE aluno_id = '$alunoId'";
                        $query_run = mysqli_query($conn, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $proposta) {
                            $isResult = true;

                        ?>  
                            <tr>
                                <th>Número</th>
                                <thead>
                                <tbody>
                                    <td><?= $proposta['id']; ?></td>
                                </tbody>
                                <thead>
                                    <th>Titulo</th>
                                <tbody>
                                    <td><?= $proposta['titulo']; ?></td>
                                </tbody>
                                <thead>
                                    <th>Empresa</th>
                                <tbody>
                                    <td><?php
                                            $sqli = "SELECT * FROM empresa WHERE id = '$proposta[empresa_id]'";
                                            $rs = mysqli_query($conn, $sqli);
                                            while ($row = mysqli_fetch_array($rs)) {
                                                echo '<option class="u-label u-label-3 u-border-1 u-border-black u-input u-input-rectangle">' . $row['nome'] . '</option>';
                                            }
                                            echo '</select>';
                                        ?></td>
                                </tbody>
                                <thead>
                                    <th>Descrição</th>
                                <tbody>
                                    <td><?= $proposta['descricao']; ?></td>
                                </tbody>
                                <thead>
                                    <th>Area</th>
                                <tbody>
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
                                </tbody>
                                <thead>
                                    <th>PDF</th>
                                <tbody>
                                    <td>
                                    <form action="propostasAlunoController.php" method="POST" class="d-inline">
                            <button type="submit" name="download-pdf-empresa" value="<?= $proposta['id']; ?>"
                                class='btn btn-info btn-sm'>Download PDF</button>
                        </form>
            </td>        
                                </td>
                                </tbody>
                            </tr>
                        </thead>
                    </tr>
                    <?php
                            }
                        }

                        $query = "SELECT * FROM proposta_aluno WHERE aluno_id = '$alunoId' AND status = '1'";
                        $query_run = mysqli_query($conn, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $proposta) {
                            $isResult = true;

                        ?>  
                            <tr>
                                <th>Número</th>
                                <thead>
                                <tbody>
                                    <td><?= $proposta['id']; ?></td>
                                </tbody>
                                <thead>
                                    <th>Titulo</th>
                                <tbody>
                                    <td><?= $proposta['titulo']; ?></td>
                                </tbody>
                                <thead>
                                    <th>Descrição</th>
                                <tbody>
                                    <td><?= $proposta['descricao']; ?></td>
                                </tbody>
                                <thead>
                                    <th>Area</th>
                                <tbody>
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
                                </tbody>
                                <thead>
                                    <th>PDF</th>
                                <tbody>
                                    <td>
                                    <form action="propostasAlunoController.php" method="POST" class="d-inline">
                            <button type="submit" name="download-pdf-empresa" value="<?= $proposta['id']; ?>"
                                class='btn btn-info btn-sm'>Download PDF</button>
                        </form>
            </td>        
                                </td>
                                </tbody>
                            </tr>
                        </thead>
                    </tr>
                        <?php
                        }
                    }
                    if (!$isResult) :?>
                    <p>Não estás em nenhuma proposta</p>
                    <?php
                        endif;
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