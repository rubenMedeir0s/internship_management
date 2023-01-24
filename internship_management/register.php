<?php
session_start();
require 'dbConnection.php';

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
    <title>Registo</title>
</head>

<body>
    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <h1>Registo</h1>
            </div>

            <!-- Login Form -->
            <form action="registerhandler.php" method="POST">
                <input type="text" id="name" class="fadeIn second" name="name" placeholder="Nome">
                <input type="text" id="address" class="fadeIn third" name="address" placeholder="Morada">
                <input type="text" id="phone" class="fadeIn third" name="phone" placeholder="Telemóvel">
                <input type="email" id="email" class="fadeIn third" name="email" placeholder="Email">
                <input type="text" id="site" class="fadeIn third" name="site" placeholder="Site">
                <?php
                echo '<select name="responsible" id="responsible" class="form-control fadeIn third" required="required">';

                $sqli = "SELECT * FROM responsavel";
                $rs = mysqli_query($conn, $sqli);
                while ($row = mysqli_fetch_array($rs)) {
                    echo '<option class="u-label u-label-3 u-border-1 u-border-black u-input u-input-rectangle fadeIn third">' . $row['email'] . '</option>';
                }
                echo '</select>';
                ?>
                <input type="text" id="username" class="fadeIn third" name="username" placeholder="Username">
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
                <input type="submit" class="fadeIn fourth" value="Registar-se">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="index.php">Afinal tem conta? Faça o Login aqui!</a>
            </div>

        </div>
    </div>
</body>

</html>