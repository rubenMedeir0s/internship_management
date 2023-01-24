<?php
require 'dbConnection.php';
require 'passwordHelper.php';
session_start();
$usernameLogin = $_POST['username'];
$passwordLogin = hashPassword($_POST['password']);
$name = $_POST['name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$site = $_POST['site'];
$responsible = $_POST['responsible'];
$exists = 0;

$sqli = "SELECT * FROM empresa WHERE telefone = '$phone'";
$result = mysqli_query($conn, $sqli);
while ($row = mysqli_fetch_array($result)) {
    $exists = 1;
}
if ($exists == 1) {
    echo "Telefone em uso!";
} else {

    $queryResponsibleId = "SELECT id FROM responsavel WHERE email = '$responsible'";
    $responsibleId = -1;
    $rs = mysqli_query($conn, $queryResponsibleId);
    while ($row = mysqli_fetch_array($rs)) {
        $responsibleId = $row["id"];
    }

    if ($responsibleId == -1) {
        echo "Responsavel não encontrado!";
    } else {

        $queryAuthentication = "INSERT INTO autenticacao (login_type,username,password) VALUES ('EMPRESA','$usernameLogin','$passwordLogin')";

        $queryAuthenticationResult = mysqli_real_query($conn, $queryAuthentication);

        $authenticationId = "";

        $queryAuthenticationId = "SELECT id from autenticacao WHERE username = '$usernameLogin'";

        $queryAutheticationIdResult = mysqli_query($conn, $queryAuthenticationId);
        while ($row = mysqli_fetch_array($queryAutheticationIdResult)) {
            $authenticationId = $row['id'];
        }

        $query = "INSERT INTO empresa (nome,morada,telefone,email,site,responsavel_id,autenticacao_id) VALUES ('$name','$address','$phone', '$email', '$site','$responsibleId', '$authenticationId')";

        $queryResult = mysqli_real_query($conn, $query);

        $_SESSION['loginState'] = 2;
        header("Location: index.php");
        exit(0);
    }

}

$conn->close();
?>