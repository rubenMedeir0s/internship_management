<?php
session_start();
require '../../dbConnection.php';
require '../../emailSender.php';

if (isset($_POST['atualizar'])) {
    $area_id = mysqli_real_escape_string($conn, $_POST['area_id']);

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);

    $query = "UPDATE area SET name='$name', descricao='$descricao' WHERE id='$area_id' ";
    $query_run = mysqli_query($conn, $query);

    header("Location: viewAreas.php");
    exit(0);
}

if (isset($_POST['apagar'])) {
    $area_id = mysqli_real_escape_string($conn, $_POST['apagar']);

    $query = "DELETE FROM area WHERE id='$area_id' ";
    $query_run = mysqli_query($conn, $query);

    header("Location: viewAreas.php");
    exit(0);
}

if (isset($_POST['criar'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
    
    $sql = "INSERT INTO area (name, descricao) VALUES ('$name', '$descricao')";
    $query_run = mysqli_query($conn, $sql);

    $query = "SELECT * FROM responsavel";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $emailResponsavel = $row['email'];
        sendemails($emailResponsavel, "Nova área criada", "Foi criada uma nova área.\nNome: $name\nDescrição: $descricao");
    }

    header("Location: viewAreas.php");
    exit(0);
}

?>