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
    <meta charset="UTF-8">
    <title>Criar Proposta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Criar Proposta</h2>
                    <form action="propostasControllerAluno.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Título</label>
                            <input type="text" name="titulo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <input type="text" name="descricao" class="form-control" style="height: 100px;" required />
                        </div>
                        <div class="form-group">
                        <label>Área Pretendida</label>
                        <?php
                                echo '<select name="area_id" class="form-control" required="required">';
                                
                                $sqli = "SELECT * FROM area";
                                $rs = mysqli_query($conn, $sqli);
                                while ($row = mysqli_fetch_array($rs)) {
                                echo '<option class="u-label u-label-3 u-border-1 u-border-black u-input u-input-rectangle">'.$row['id'].' - ' . $row['name'] . '</option>';
                                }
                                echo '</select>';
                        ?>
                        </div>
                        <div class="form-group">
                            <label>Importar PDF</label>
                            <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" style="height: 100px;" required />
                        </div>
                        <div class="form-group">
                            <button type="submit" name="criar-proposta" class="btn btn-primary">
                                Submeter
                            </button>
                            <a href="viewPropostasAluno.php" class="btn btn-secondary ml-2">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>