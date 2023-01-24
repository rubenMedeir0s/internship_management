<?php
session_start();
require '../../dbConnection.php';
require '../../emailSender.php';

if (isset($_POST['aprovar-docente'])) {
    $proposta_id = mysqli_real_escape_string($conn, $_POST['aprovar-docente']);

    $query = "UPDATE proposta_docente SET status='1' WHERE id='$proposta_id'";
    $query_run = mysqli_query($conn, $query);

    header("Location: propostas.php");
    exit(0);
}

if (isset($_POST['aprovar-empresa'])) {
    $proposta_id = mysqli_real_escape_string($conn, $_POST['aprovar-empresa']);

    $query = "UPDATE proposta_empresa SET status='1' WHERE id='$proposta_id'";
    $query_run = mysqli_query($conn, $query);

    header("Location: propostas.php");
    exit(0);
}

if (isset($_POST['eliminar-docente'])) {
    $proposta_id = mysqli_real_escape_string($conn, $_POST['eliminar-docente']);

    $query = "DELETE FROM proposta_docente WHERE id='$proposta_id'";
    $query_run = mysqli_query($conn, $query);
    
    header("Location: propostas.php");
    exit(0);
}

if (isset($_POST['eliminar-empresa'])) {
    $proposta_id = mysqli_real_escape_string($conn, $_POST['eliminar-empresa']);

    $query = "DELETE FROM proposta_empresa WHERE id='$proposta_id'";
    $query_run = mysqli_query($conn, $query);
    
    header("Location: propostas.php");
    exit(0);
}

if (isset($_POST['aprovar-aluno'])) {
    $proposta_id = mysqli_real_escape_string($conn, $_POST['aprovar-aluno']);

    $query = "UPDATE proposta_aluno SET status='1' WHERE id='$proposta_id'";
    $query_run = mysqli_query($conn, $query);

    $aluno_id = -1;
    $query = "SELECT * FROM proposta_aluno WHERE id = '$proposta_id'";
    $query_run = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($query_run)) {
        $aluno_id = $row['aluno_id'];
    }

    $query = "DELETE FROM candidaturas_docente WHERE aluno_id = '$aluno_id'";
    $query_run = mysqli_query($conn, $query);

    $query = "DELETE FROM candidaturas_empresa WHERE aluno_id = '$aluno_id'";
    $query_run = mysqli_query($conn, $query);

    $query = "SELECT * FROM aluno WHERE id = '$aluno_id'";
    $query_run = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($query_run)) {
        $emailAluno = $row['email'];
        sendemails($emailAluno, "Proposta Aceite", "Foste aceite numa proposta!");
    }

    header("Location: propostas.php");
    exit(0);
}

if (isset($_POST['eliminar-aluno'])) {
    $proposta_id = mysqli_real_escape_string($conn, $_POST['eliminar-aluno']);

    $query = "DELETE FROM proposta_aluno WHERE id='$proposta_id'";
    $query_run = mysqli_query($conn, $query);
    
    header("Location: propostas.php");
    exit(0);
}

?>