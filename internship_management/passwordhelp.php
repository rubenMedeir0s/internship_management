<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

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
    <title>Recuperar Password</title>
</head>

<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <h1>Recuperar Password</h1>
            </div>

            <!-- Login Form -->
            <form action="passwordhelphandler.php" method="POST">
                <input type="text" id="username" class="fadeIn second" name="username" placeholder="Username">
                <input type="submit" class="fadeIn fourth" value="Recuperar" placeholder="Recuperar">
                <!-- Remind Passowrd -->
                <div id="formFooter">
                    <a class="underlineHover" href="index.php">Voltar ao Login</a><br>
                </div>
            </form>

        </div>
    </div>

</body>

</html>