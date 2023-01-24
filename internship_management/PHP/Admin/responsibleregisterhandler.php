<?php
require '../../dbConnection.php';
session_start();
$usernameLogin = $_POST['username'];
$passwordLogin = $_POST['password'];
$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];
$exists = 0;

$sqli = "SELECT * FROM responsavel WHERE email = '$email'";
$result = mysqli_query($conn, $sqli);
while ($row = mysqli_fetch_array($result)) {
    $exists = 1;
}
if ($exists == 1) {
    echo "Email em uso!";
} else {

    $queryAuthentication = "INSERT INTO autenticacao (login_type,username,password) VALUES ('RESPONSAVEL','$usernameLogin','$passwordLogin')";

    $queryAuthenticationResult = mysqli_real_query($conn, $queryAuthentication);

    $authenticationId = "";

    $queryAuthenticationId = "SELECT id from autenticacao WHERE username = '$usernameLogin'";

    $queryAutheticationIdResult = mysqli_query($conn, $queryAuthenticationId);
    while ($row = mysqli_fetch_array($queryAutheticationIdResult)) {
        $authenticationId = $row['id'];
    }

    $query = "INSERT INTO responsavel (nome,email,telefone,autenticacao_id) VALUES ('$name', '$email', '$number', '$authenticationId')";

    $queryResult = mysqli_real_query($conn, $query);


    $_SESSION['loginState'] = 4;
    header("Location: ../../index.php");
    exit(0);

}

$conn->close();
?>