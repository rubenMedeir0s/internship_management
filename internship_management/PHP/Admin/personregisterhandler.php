<?php
require '../../dbConnection.php';
session_start();
$usernameLogin = $_POST['username'];
$passwordLogin = $_POST['password'];
$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];
$exists = 0;

$sqli = "SELECT * FROM docente WHERE numero = '$number'";
$result = mysqli_query($conn, $sqli);
while ($row = mysqli_fetch_array($result)) {
    $exists = 1;
}
if ($exists == 1) {
    echo "Numero em uso!";
} else {

    $queryAuthentication = "INSERT INTO autenticacao (login_type,username,password) VALUES ('DOCENTE','$usernameLogin','$passwordLogin')";

    $queryAuthenticationResult = mysqli_real_query($conn, $queryAuthentication);

    $authenticationId = "";

    $queryAuthenticationId = "SELECT id from autenticacao WHERE username = '$usernameLogin'";

    $queryAutheticationIdResult = mysqli_query($conn, $queryAuthenticationId);
    while ($row = mysqli_fetch_array($queryAutheticationIdResult)) {
        $authenticationId = $row['id'];
    }

    $query = "INSERT INTO docente (numero,nome,isAdmin,email,autenticacao_id) VALUES ('$number','$name','0', '$email', '$authenticationId')";

    $queryResult = mysqli_real_query($conn, $query);


    $_SESSION['loginState'] = 3;
    header("Location: ../../index.php");
    exit(0);

}

$conn->close();
?>