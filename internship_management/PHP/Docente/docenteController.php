<?php
session_start();
require '../../dbConnection.php';

if (isset($_POST['atualizar-perfil'])) {
    $docenteid = mysqli_real_escape_string($conn, $_POST['atualizar-perfil']);

    $numero = mysqli_real_escape_string($conn, $_POST['numero']);
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $query = "UPDATE docente SET numero='$numero', nome='$nome', email='$email' WHERE id = '$docenteid'";
    $query_run = mysqli_query($conn, $query);

    header("Location: perfil.php");
    exit;
}

session_abort();
?>