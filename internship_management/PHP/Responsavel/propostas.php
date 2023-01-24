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
                    href="index.php">Voltar Atrás</a>
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                <h1>Propostas das Empresas</h1>
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
        $query = "SELECT * FROM proposta_empresa";
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
                        echo '<option class="u-label u-label-3 u-border-1 u-border-black u-input u-input-rectangle">'.$row['nome'].'</option>';
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
                        echo '<option class="u-label u-label-3 u-border-1 u-border-black u-input u-input-rectangle">'.$row['name'].'</option>';
                    }
                    echo '</select>';
                ?>
            </td>
            <td>
                <form action="../Propostas/propostasControllerEmpresa.php" method="POST" class="d-inline">
                    <button type="submit" name="download-pdf" value="<?= $proposta['id']; ?>"
                            class='btn btn-info btn-sm'>Download PDF</button>
                </form>
            </td>
            <td>
                <?php
                    if($proposta['status'] == 1) {
                         echo '<b>Proposta Aprovada!</b>';
                    } else {
                        echo '<b>Proposta em Aprovação!</b>';
                    }
                ?>
            </td>
            <td style="text-align: center;">
                <form action="propostashandler.php" method="POST">
                <?php
                if (isset($_SESSION['userLoginType'])) {
                    $proposta_id = $proposta['id'];

                    $query = "SELECT * FROM proposta_empresa WHERE id = '$proposta_id'";
                    $query_run = mysqli_query($conn, $query);
                    $isStatus = false;
                    while ($row = mysqli_fetch_array($query_run)) {
                        $isStatus = $row['status'];
                    }

                    if (!$isStatus): ?>
                            <button type="submit" name="aprovar-empresa" value="<?= $proposta['id']; ?>" class="btn btn-info btn-sm">Aprovar</button>
                            <?php
                    endif ?>
                    <button type="submit" name="eliminar-empresa" value="<?= $proposta['id']; ?>" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
    
        <?php
                }
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
        $query = "SELECT * FROM proposta_docente";
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
                        echo '<option class="u-label u-label-3 u-border-1 u-border-black u-input u-input-rectangle">'.$row['name'].'</option>';
                    }
                    echo '</select>';
                ?>
            </td>
            <td>
                <form action="../Propostas/propostasControllerDocente.php" method="POST" class="d-inline">
                    <button type="submit" name="download-pdf" value="<?= $proposta['id']; ?>"
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
                <form action="propostashandler.php" method="POST">
                <?php
                if (isset($_SESSION['userLoginType'])) {
                    $proposta_id = $proposta['id'];

                    $query = "SELECT * FROM proposta_docente WHERE id = '$proposta_id'";
                    $query_run = mysqli_query($conn, $query);
                    $isStatus = false;
                    while ($row = mysqli_fetch_array($query_run)) {
                        $isStatus = $row['status'];
                    }

                    if (!$isStatus): ?>
                            <button type="submit" name="aprovar-docente" value="<?= $proposta['id']; ?>" class="btn btn-info btn-sm">Aprovar</button>
                            <?php
                    endif ?>
                    <button type="submit" name="eliminar-docente" value="<?= $proposta['id']; ?>" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
    
        <?php
                }
        }
        }
        ?>                       
    </tbody>
</table>


<h1>Propostas dos Alunos</h1>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Titulo</th>
            <th>Nome Aluno</th>
            <th>Descrição</th>
            <th>Área</th>
            <th>PDF</th>
            <th>Estado</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>

    <?php
        $query = "SELECT * FROM proposta_aluno";
        $query_run = mysqli_query($conn, $query);

        if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $proposta) {
            ?>
    
        <tr>
            <td><?= $proposta['id']; ?></td>
            <td><?= $proposta['titulo']; ?></td>
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
                        echo '<option class="u-label u-label-3 u-border-1 u-border-black u-input u-input-rectangle">'.$row['name'].'</option>';
                    }
                    echo '</select>';
                ?>
            </td>
            <td>
                <form action="../Propostas/propostasControllerAluno.php" method="POST" class="d-inline">
                    <button type="submit" name="download-pdf" value="<?= $proposta['id']; ?>"
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
                <form action="propostashandler.php" method="POST">
                <?php
                if (isset($_SESSION['userLoginType'])) {
                    $proposta_id = $proposta['id'];

                    $query = "SELECT * FROM proposta_aluno WHERE id = '$proposta_id'";
                    $query_run = mysqli_query($conn, $query);
                    $isStatus = false;
                    while ($row = mysqli_fetch_array($query_run)) {
                        $isStatus = $row['status'];
                    }

                    if (!$isStatus): ?>
                            <button type="submit" name="aprovar-aluno" value="<?= $proposta['id']; ?>" class="btn btn-info btn-sm">Aprovar</button>
                            <?php
                    endif ?>
                    <button type="submit" name="eliminar-aluno" value="<?= $proposta['id']; ?>" class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
    
        <?php
                }
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