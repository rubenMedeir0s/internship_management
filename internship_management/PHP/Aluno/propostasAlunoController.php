<?php
session_start();
require '../../dbConnection.php';

if (isset($_POST['download-pdf-empresa'])) {
    $proposta_id = mysqli_real_escape_string($conn, $_POST['download-pdf-empresa']);

    $filename = "error";

    $sqli = "SELECT * FROM proposta_empresa WHERE id = '$proposta_id'";
    $rs = mysqli_query($conn, $sqli);
    while ($row = mysqli_fetch_array($rs)) {
        $filename = $row["pdf"];
    }

    $url = dirname(__FILE__, 3) . "/uploads/" . $filename;

    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header('Content-Disposition: attachment; filename="'.basename($url).'"');
    header('Content-Length: ' . filesize($url));

    while (ob_get_level()) {
        ob_end_clean();
    }

    readfile($url);


    header("Location: propostasAluno.php");
    exit(0);
}

if (isset($_POST['download-pdf-docente'])) {
    $proposta_id = mysqli_real_escape_string($conn, $_POST['download-pdf-docente']);

    $filename = "error";

    $sqli = "SELECT * FROM proposta_docente WHERE id = '$proposta_id'";
    $rs = mysqli_query($conn, $sqli);
    while ($row = mysqli_fetch_array($rs)) {
        $filename = $row["pdf"];
    }

    $url = dirname(__FILE__, 3) . "/uploads/" . $filename;

    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header('Content-Disposition: attachment; filename="'.basename($url).'"');
    header('Content-Length: ' . filesize($url));

    while (ob_get_level()) {
        ob_end_clean();
    }

    readfile($url);


    header("Location: propostasAluno.php");
    exit(0);
}

if (isset($_POST['candidatar-docentes'])) {

    if (!isset($_SESSION['userLoginType'])) {
        header("Location: propostasAluno.php");
        return;
    }

    $proposta_id = mysqli_real_escape_string($conn, $_POST['candidatar-docentes']);
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

    $queryContains = "SELECT * FROM candidaturas_docente WHERE aluno_id = '$personId' AND proposta_docente_id = '$proposta_id'";
    $result = mysqli_query($conn, $queryContains);
    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO candidaturas_docente(aluno_id, proposta_docente_id) VALUES('$personId', '$proposta_id')";
        $result = mysqli_query($conn, $query);
    }

    header("Location: propostasAluno.php");
    exit(0);
}

if (isset($_POST['candidatar-remover-docentes'])) {

    if (!isset($_SESSION['userLoginType'])) {
        header("Location: propostasAluno.php");
        return;
    }

    $proposta_id = mysqli_real_escape_string($conn, $_POST['candidatar-remover-docentes']);
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

    $queryContains = "DELETE FROM candidaturas_docente WHERE aluno_id = '$personId' AND proposta_docente_id = '$proposta_id'";
    $result = mysqli_query($conn, $queryContains);

    header("Location: propostasAluno.php");
    exit(0);
}

if (isset($_POST['candidatar-empresa'])) {

    if (!isset($_SESSION['userLoginType'])) {
        header("Location: propostasAluno.php");
        return;
    }

    $proposta_id = mysqli_real_escape_string($conn, $_POST['candidatar-empresa']);
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

    $queryContains = "SELECT * FROM candidaturas_empresa WHERE aluno_id = '$personId' AND proposta_empresa_id = '$proposta_id'";
    $result = mysqli_query($conn, $queryContains);
    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO candidaturas_empresa(aluno_id, proposta_empresa_id) VALUES('$personId', '$proposta_id')";
        $result = mysqli_query($conn, $query);
    }

    header("Location: propostasAluno.php");
    exit(0);
}

if (isset($_POST['candidatar-remover-empresa'])) {

    if (!isset($_SESSION['userLoginType'])) {
        header("Location: propostasAluno.php");
        return;
    }

    $proposta_id = mysqli_real_escape_string($conn, $_POST['candidatar-remover-empresa']);
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

    $queryContains = "DELETE FROM candidaturas_empresa WHERE aluno_id = '$personId' AND proposta_empresa_id = '$proposta_id'";
    $result = mysqli_query($conn, $queryContains);

    header("Location: propostasAluno.php");
    exit;
}

if (isset($_POST['atualizar-perfil'])) {
    $aluno_id = mysqli_real_escape_string($conn, $_POST['aluno_id']);

    $numero = mysqli_real_escape_string($conn, $_POST['numero']);
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $query = "UPDATE aluno SET numero='$numero', nome='$nome', email='$email' WHERE id='$aluno_id' ";
    $query_run = mysqli_query($conn, $query);

    header("Location: verPerfil.php");
    exit;
}

session_abort();
?>