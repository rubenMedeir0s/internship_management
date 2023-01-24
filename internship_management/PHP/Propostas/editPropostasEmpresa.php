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

<!doctype html>
<html lang="pt">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Editar Proposta</title>
</head>

<body>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Proposta
                            <a href="viewPropostasEmpresa.php" class="btn btn-danger float-end">Voltar Atrás</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if (isset($_GET['id'])) {
                            $proposta_id = mysqli_real_escape_string($conn, $_GET['id']);
                            $query = "SELECT * FROM proposta_empresa WHERE id='$proposta_id' ";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                $proposta = mysqli_fetch_array($query_run);
                                ?>
                                <form action="propostasControllerEmpresa.php" method="POST">
                                    <input type="hidden" name="proposta_id" value="<?= $proposta['id']; ?>">

                                    <div class="mb-3">
                                        <label>Titulo</label>
                                        <input type="text" name="titulo" value="<?= $proposta['titulo']; ?>"
                                            class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Nome da Empresa</label><br>
                                        <?php
                                        echo '<select name="empresa_id" class="form-control" value="<?php $proposta["empresa_id"]; ?>" required="required">';

                                        $sqli = "SELECT * FROM empresa";
                                        $rs = mysqli_query($conn, $sqli);
                                        while ($row = mysqli_fetch_array($rs)) {
                                            echo '<option class="u-label u-label-3 u-border-1 u-border-black u-input u-input-rectangle">' . $row['id'] . ' - ' . $row['nome'] . '</option>';
                                        }
                                        echo '</select>';
                                        ?>
                                    </div>
                                    <div class="mb-3">
                                        <label>Descrição</label>
                                        <input type="text" name="descricao" value="<?= $proposta['descricao']; ?>"
                                            class="form-control" style="height: 100px;" required />
                                    </div>
                                    <div class="mb-3">
                                        <label>Área Pretendida</label><br>
                                        <?php
                                        echo '<select name="area_id" class="form-control" required="required">';

                                        $sqli = "SELECT * FROM area";
                                        $rs = mysqli_query($conn, $sqli);
                                        while ($row = mysqli_fetch_array($rs)) {
                                            echo '<option class="u-label u-label-3 u-border-1 u-border-black u-input u-input-rectangle">' . $row['id'] . ' - ' . $row['name'] . '</option>';
                                        }
                                        echo '</select>';
                                        ?>
                                    </div>
                                    <div class="mb-3">
                                        <label>Área Pretendida</label>
                                        <input type="file" name="pdf" class="form-control" style="height: 100px;" required />
                                    </div>
                                    <div>
                                        <button type="submit" name="atualizar-proposta" class="btn btn-primary">
                                            Atualizar Proposta
                                        </button>
                                    </div>

                                </form>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>