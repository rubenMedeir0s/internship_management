<?php
session_start();
require '../../dbConnection.php';
require '../../emailSender.php';
if (isset($_POST['apagar'])) {
    $docente_id = mysqli_real_escape_string($conn, $_POST['apagar']);

    $query = "DELETE FROM docente WHERE id='$docente_id' ";
    $query_run = mysqli_query($conn, $query);

    header("Location: viewDocentes.php");
    exit(0);
}
?>