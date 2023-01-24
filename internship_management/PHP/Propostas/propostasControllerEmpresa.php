<?php
session_start();
require '../../dbConnection.php';
require '../../emailSender.php';

if (isset($_POST['download-pdf'])) {
    $proposta_id = mysqli_real_escape_string($conn, $_POST['download-pdf']);

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


    header("Location: viewPropostasEmpresa.php");
    exit(0);
}

if (isset($_POST['aceitar-candidatura'])) {
    $id = mysqli_real_escape_string($conn, $_POST['aceitar-candidatura']);
    $idSplit = explode(";", $id);
    $aluno_id = $idSplit[0];
    $proposta_id = $idSplit[1];

    $query = "SELECT id FROM proposta_docente WHERE aluno_id = '$aluno_id'";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        header("Location: viewPropostasEmpresa.php");
        exit(0);
    }

    $query = "SELECT id FROM proposta_empresa WHERE aluno_id = '$aluno_id'";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        header("Location: viewPropostasEmpresa.php");
        exit(0);
    }

    $query = "SELECT id FROM proposta_aluno WHERE aluno_id = '$aluno_id' AND status = 'true'";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        header("Location: viewPropostasEmpresa.php");
        exit(0);
    }

    $query = "UPDATE proposta_empresa SET aluno_id = '$aluno_id' WHERE id = '$proposta_id'";
    $query_run = mysqli_query($conn, $query);

    $query = "DELETE FROM candidaturas_docente WHERE aluno_id = '$aluno_id'";
    $query_run = mysqli_query($conn, $query);

    $query = "DELETE FROM candidaturas_empresa WHERE aluno_id = '$aluno_id'";
    $query_run = mysqli_query($conn, $query);

    $query = "DELETE FROM proposta_aluno WHERE aluno_id = '$aluno_id'";
    $query_run = mysqli_query($conn, $query);

    $email = "root@localhost.com";
    $query = "SELECT * FROM aluno WHERE id = '$aluno_id'";
    $query_run = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($query_run)) {
        $emailAluno = $row['email'];
        sendemails($emailAluno, "Proposta Aceite", "Foste aceite numa proposta!");
    }

    header("Location: viewPropostasEmpresa.php");
    exit(0);
}

if (isset($_POST['apagar-candidatura'])) {
    $id = mysqli_real_escape_string($conn, $_POST['apagar-candidatura']);
    $idSplit = explode(";", $id);
    $aluno_id = $idSplit[0];
    $proposta_id = $idSplit[1];

    $query = "DELETE FROM candidaturas_empresa WHERE aluno_id = '$aluno_id' AND proposta_empresa_id = '$proposta_id'";
    $query_run = mysqli_query($conn, $query);

    header("Location: viewPropostasEmpresa.php");
    exit(0);
}

if (isset($_POST['apagar-proposta'])) {
    $proposta_id = mysqli_real_escape_string($conn, $_POST['apagar-proposta']);

    $query = "DELETE FROM proposta_empresa WHERE id='$proposta_id' ";
    $query_run = mysqli_query($conn, $query);

    header("Location: viewPropostasEmpresa.php");
    exit(0);
}

if (isset($_POST['atualizar-proposta'])) {
    $proposta_id = mysqli_real_escape_string($conn, $_POST['proposta_id']);

    $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
    $empresa_id = mysqli_real_escape_string($conn, $_POST['empresa_id']);
    $empresa_id = explode(" -", $empresa_id)[0];
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
    $area_id = mysqli_real_escape_string($conn, $_POST['area_id']);
    $areaSplit = explode(" -", $area_id);
    $area_id = $areaSplit[0];
    $area_nome = $areaSplit[1];
    $pdf = mysqli_real_escape_string($conn, $_POST['pdf']);

    $query = "UPDATE proposta_empresa SET titulo='$titulo', empresa_id='$empresa_id', descricao='$descricao', area_id='$area_id', pdf='$pdf' WHERE id='$proposta_id' ";
    $query_run = mysqli_query($conn, $query);

    header("Location: viewPropostasEmpresa.php");
    exit(0);
}

if (isset($_POST['criar-proposta'])) {
    $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
    $empresa_id = mysqli_real_escape_string($conn, $_POST['empresa_id']);
    $empresaSplit = explode(" -", $empresa_id);
    $empresa_id = $empresaSplit[0];
    $empresa_nome = $empresaSplit[1];
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
    $area_id = mysqli_real_escape_string($conn, $_POST['area_id']);
    $areaSplit = explode(" -", $area_id);
    $area_id = $areaSplit[0];
    $area_nome = $areaSplit[1];

    //dirname(Da pasta atual, 4 niveis inferior)
    $target_dir = dirname(__FILE__, 3) . "/uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $fileName = basename($target_file);

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($fileType != "pdf") {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    }

    $sql = "INSERT INTO proposta_empresa (titulo, empresa_id, aluno_id, descricao, status, area_id, pdf) VALUES ('$titulo','$empresa_id', 'null','$descricao', 'false','$area_id','$fileName')";

    $query_run = mysqli_query($conn, $sql);

    $email = "root@localhost.com";
    $query = "SELECT * FROM responsavel";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $emailResponsavel = $row['email'];
        sendemails($emailResponsavel, "Nova proposta", "Foi criada uma nova proposta.\nTitulo: $titulo\nEmpresa: $empresa_nome\nArea: $area_id\nDescrição: $descricao\nFicheiro: $fileName");
    }

    header("Location: viewPropostasEmpresa.php");
    exit(0);
}
?>