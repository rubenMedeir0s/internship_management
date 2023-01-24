<?php
session_start();
require '../../dbConnection.php';

if (isset($_POST['atualizar-docente'])) {
    $docente_id = $_POST['atualizar-docente'];
    echo $docente_id;
    $stmt = mysqli_prepare($conn, "UPDATE docente SET isAdmin=1 WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $docente_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: alterarDocente.php");
    exit;
}

if (isset($_POST['importar-alunos'])) {
    function generate_password($length = 12) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!#=?:_-.,;';
        $characters_length = strlen($characters);
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, $characters_length - 1)];
        }
        return $password;
    }
    $target_dir = dirname(__FILE__) . "/csv/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $fileName = basename($target_file);

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    }

    if ($fileType != "csv") {
        $uploadOk = 0;
    }

    $url = $target_dir . $fileName;


    $file = fopen($url, "r");

    $currentRow = 0;
    while (($row = fgetcsv($file)) !== false) {
        if ($currentRow != 0) {
            foreach ($row as $line) {
                $lineSplit = explode(";", $line);

                $authenticationQuery = "SELECT id FROM autenticacao WHERE username = '$lineSplit[3]'";
                $rs = mysqli_query($conn, $authenticationQuery);
                if (mysqli_num_rows($rs) == 0) {
                    $password = generate_password();
                    $query = "INSERT INTO autenticacao (login_type, username, password) 
                                VALUES ('ALUNO', '$lineSplit[3]', '$password')";
                    $conn->query($query);
                    $authenticationId = -1;
                    $rs = mysqli_query($conn, $authenticationQuery);
                    while ($rowQuery = mysqli_fetch_array($rs)) {
                        $authenticationId = $rowQuery['id'];
                    }
    
                    $query3 = "INSERT INTO aluno (numero, nome, email, autenticacao_id) 
                            VALUES ('$lineSplit[0]', '$lineSplit[1]', '$lineSplit[2]', '$authenticationId')";
                    $conn->query($query3);
                }
            }
        }
        $currentRow = $currentRow + 1;
    }

    fclose($file);
    header("Location: importAlunos.php");
}


if (isset($_POST['atualizar-perfil'])) {
    $responsaveId = mysqli_real_escape_string($conn, $_POST['atualizar-perfil']);

    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telefone = mysqli_real_escape_string($conn, $_POST['telefone']);

    $query = "UPDATE responsavel SET nome='$nome', email='$email', telefone='$telefone' WHERE id = '$responsaveId'";
    $query_run = mysqli_query($conn, $query);

    header("Location: perfil.php");
    exit;
}

session_abort();
?>