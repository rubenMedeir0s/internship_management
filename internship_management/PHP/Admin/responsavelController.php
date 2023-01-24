<?php
session_start();
require '../../dbConnection.php';
require '../../emailSender.php';
if (isset($_POST['apagar'])) {
    $responsavel_id = mysqli_real_escape_string($conn, $_POST['apagar']);

    $query = "DELETE FROM responsavel WHERE id='$responsavel_id' ";
    $query_run = mysqli_query($conn, $query);

    header("Location: viewResponsaveis.php");
    exit(0);
}
?>