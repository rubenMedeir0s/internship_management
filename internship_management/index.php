<?php
require "emailSender.php";
error_reporting(E_ERROR | E_PARSE);
session_start();
$loginState = 0;
$varExists = empty($loginState);

if ($varExists) {
    $loginState = 0;
    $loginState = $_SESSION['loginState'];
} else {
    $loginState = 0;
}


if (isset($_SESSION['userLoginType'])) {
    $loginType = strtoupper($_SESSION['userLoginType']);
    echo $loginType;
    switch ($loginType) {
        case "ADMIN":
            header("Location: PHP/Admin/index.php");
            break;
        case "RESPONSAVEL":
            header("Location: PHP/Responsavel/index.php");
            break;
        case "EMPRESA":
            header("Location: PHP/Empresa/index.php");
            break;
        case "DOCENTE":
            header("Location: PHP/Docente/index.php");
            break;
        case "ALUNO":
            header("Location: PHP/Aluno/index.php");
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="CSS/login/styles.css" rel="stylesheet" />
    <title>Login</title>
</head>

<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <h1>Login</h1>
            </div>

            <!-- Login Form -->
            <form action="loginhandler.php" method="POST">
                <input type="text" id="username" class="fadeIn second" name="username" placeholder="Username">
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
                <input type="submit" class="fadeIn fourth" value="Log In">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="passwordhelp.php">Esqueceu-se da password?</a><br>
                <a class="underlineHover" href="register.php">Não tem conta? Registe-se aqui!</a>
            </div>

        </div>
    </div>
    <p>
        <?php
        switch ($loginState) {
            case -1:
                echo "Ocorreu um erro de login, verifique as credênciais.";
                break;
            case 2:
                echo "Empresa registada com sucesso!";
                break;
            case 3:
                echo "Docente registado com sucesso!";
                break;
            case 4:
                echo "Nova password enviada por email, meu bacans!";
                break;
        }
        ?>
    </p>

</body>

</html>