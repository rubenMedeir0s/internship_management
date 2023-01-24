<?php
require 'dbConnection.php';
session_start();

    $idlogin = $_SESSION['idLogin'];

    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmnewPassword = $_POST['confirmNewPassword'];

    $query = "SELECT password FROM autenticacao WHERE id = $idlogin";
    $query_run = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $password) {
            $pass = $password['password'];
    }
    }

    if(($oldPassword == $pass) AND ($newPassword == $confirmnewPassword)){
        $query = "UPDATE autenticacao SET password='$newPassword' WHERE id = '$idlogin'";
        $query_run = mysqli_query($conn, $query);
        header("Location: index.php");
    }else{
        header("Location: index.php");
    }

session_abort();
?>