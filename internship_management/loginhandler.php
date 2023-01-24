<?php
require 'dbConnection.php';
require 'passwordHelper.php';
session_start();
$usernameLogin = $_POST['username'];
$passwordLogin = $_POST['password'];
$errorLogin = 0;
$_SESSION['loginState'] = $errorLogin;
$hashed_password = "-1";
$sqli = "SELECT * FROM autenticacao WHERE username = '$usernameLogin'";
$result = mysqli_query($conn, $sqli);
while ($row = mysqli_fetch_array($result)) {
    $hashed_password = $row['password'];
}
if (password_verify($passwordLogin, $hashed_password)) {
    $sqli = "SELECT * FROM autenticacao WHERE username = '$usernameLogin'";
    $result = mysqli_query($conn, $sqli);
    while ($row = mysqli_fetch_array($result)) {
        $idLogin = $row['id'];
        $_SESSION['idLogin'] = $idLogin;
        $loginType = strtoupper($row['login_type']);
        $_SESSION['userLoginType'] = $loginType;
        $_SESSION['username'] = $usernameLogin;
    }
} else {
    $errorLogin = -1;
    $_SESSION['loginState'] = $errorLogin;
    header("Location: index.php");
}

switch ($loginType) {
    case "ADMIN":
        header("Location: ../2022_dsos_g1/PHP/Admin/index.php");
        break;
    case "RESPONSAVEL":
        header("Location: ../2022_dsos_g1/PHP/Responsavel/index.php");
        break;
    case "EMPRESA":
        header("Location: ../2022_dsos_g1/PHP/Empresa/index.php");
        break;
    case "DOCENTE":
        header("Location: ../2022_dsos_g1/PHP/Docente/index.php");
        break;
    case "ALUNO":
        header("Location: ../2022_dsos_g1/PHP/Aluno/index.php");
        break;
}

$conn->close();
?>