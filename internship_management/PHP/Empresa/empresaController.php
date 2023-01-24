<?php
session_start();
require '../../dbConnection.php';

if (isset($_POST['atualizar-perfil'])) {
    $empresa_id = mysqli_real_escape_string($conn, $_POST['atualizar-perfil']);

    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $morada = mysqli_real_escape_string($conn, $_POST['morada']);
    $telefone = mysqli_real_escape_string($conn, $_POST['telefone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $site = mysqli_real_escape_string($conn, $_POST['site']);

    $query = "UPDATE empresa SET nome='$nome', morada='$morada', telefone='$telefone', email='$email', site='$site' WHERE id='$empresa_id' ";
    $query_run = mysqli_query($conn, $query);

    header("Location: perfil.php");
    exit;
}

session_abort();
?>