<?php
session_start();
// Include config file
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
    <title>Criar Proposta</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../../CSS/Empresa/styles.css" rel="stylesheet" />
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
                    href="viewPropostasEmpresa.php">Voltar Atrás</a>
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <h1 >Criar Proposta</h1>
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
            <div class="row">
                <div class="col-md-12">
                    <form action="propostasControllerDocente.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Título</label>
                            <input type="text" name="titulo" class="form-control" required>
                        </div>
                        <div class="u-form-select-wrapper">
                        <label>Nome Docente</label>
                        <?php
                                echo '<select name="docente_id" class="form-control" required="required">';
                                
                                $sqli = "SELECT * FROM docente";
                                $rs = mysqli_query($conn, $sqli);
                                while ($row = mysqli_fetch_array($rs)) {
                                echo '<option class="u-label u-label-3 u-border-1 u-border-black u-input u-input-rectangle">'.$row['id'].' - ' . $row['nome'] . '</option>';
                                }
                                echo '</select>';
                        ?>
                       <br> 
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <input type="text" name="descricao" class="form-control" style="height: 100px;" required />
                        </div>
                        <div class="u-form-select-wrapper">
                        <label>Area Pretendida</label>
                        <?php
                                echo '<select name="area_id" class="form-control" required="required">';
                                
                                $sqli = "SELECT * FROM area";
                                $rs = mysqli_query($conn, $sqli);
                                while ($row = mysqli_fetch_array($rs)) {
                                echo '<option class="u-label u-label-3 u-border-1 u-border-black u-input u-input-rectangle">'.$row['id'].' - ' . $row['name'] . '</option>';
                                }
                                echo '</select>';
                        ?>
                       <br> 
                        </div>
                        <div class="form-group">
                            <label>Importar PDF</label>
                            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" style="height: 100px;" required />
                        </div>
                        <div class="form-group">
                            <button type="submit" name="criar-proposta" class="btn btn-primary">
                                Criar
                            </button>
                            <a href="viewPropostasDocente.php" class="btn btn-secondary ml-2">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
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
?>