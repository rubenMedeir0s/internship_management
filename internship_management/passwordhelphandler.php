<?php
session_start();
require 'dbConnection.php';
require 'emailSender.php';

$usernameLogin = $_POST['username'];
$sqli = "SELECT * FROM autenticacao WHERE username = '$usernameLogin'";
$result = mysqli_query($conn, $sqli);
while ($row = mysqli_fetch_array($result)) {
    $authenticationId = $row['id'];
    $query = "SELECT * FROM empresa WHERE autenticacao_id = '$authenticationId'";
    $queryResult = mysqli_query($conn, $query);
    $empresaEmail = "-1";
    $email = "root@localhost.com";
    while ($rowEmail = mysqli_fetch_array($queryResult)) {
        $empresaEmail = $rowEmail['email'];
    }
    
    if ($empresaEmail != "-1") {
        $password = generate_password();

        $query = "UPDATE autenticacao SET password = '$password' WHERE id = '$authenticationId'";
        $queryResult = mysqli_query($conn, $query);

        sendemails("$empresaEmail", "Password", "A sua nova password é: $password");
    }

}

function generate_password($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!#=?:_-.,;';
    $characters_length = strlen($characters);
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, $characters_length - 1)];
    }
    return $password;
}

$_SESSION['loginState'] = 4;
header("Location: index.php")
?>