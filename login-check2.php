<?php

// require_once "config/database.php";

// $username = mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars($_POST['username']))));
// $password = md5(mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars($_POST['password'])))));
// if (!ctype_alnum($username) || !ctype_alnum($password)) {
//     header("Location: index.php?alert=1");
//     exit();
// }else{
//     $query = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE username = '$username'
//                                     AND password = '$password' 
//                                     AND status = 'activo'")
//                                     or die('Error: ' . mysqli_error($mysqli));
//     $rows = mysqli_num_rows($query);
//     if ($rows > 0) {
//         session_start();
//         $data = mysqli_fetch_assoc($query);
//         $_SESSION['id_user']            = $data['id_user'];
//         $_SESSION['name_user']          = $data['name_user'];
//         $_SESSION['username']           = $data['username'];
//         $_SESSION['permisos_acceso']    = $data['permisos_acceso'];
//         //echo "Bienvenido " . $_SESSION['name_user'];

//         header("Location: main.php?module=start");
//     } else {
//         header("Location: index.php?alert=1");
//     }
// }

?>

<?php
session_start();
require_once "config/database.php";
require_once "config/Logger.php";
$log = new Logger("logs/app.log");

if (!isset($_SESSION['intentos'])) {
    $_SESSION['intentos'] = 0;
}

// Sanitización de entradas
$username = mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars($_POST['username']))));
$password = md5(mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars($_POST['password'])))));
$ip = $_SERVER['REMOTE_ADDR'];

// Validación básica
if (!ctype_alnum($username) || !ctype_alnum($password)) {
    header("Location: index.php?alert=1");
    exit();
} else {
    // Buscar usuario
    $query = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE username = '$username'")
        or die('Error: ' . mysqli_error($mysqli));
    $rows = mysqli_num_rows($query);

    if ($rows > 0) {
        $data = mysqli_fetch_assoc($query);

        // Verificar si está bloqueado
        if ($data['status'] !== '0') {
            header("Location: index.php?alert=4"); // cuenta bloqueada
            exit();
        }

        // Comparar contraseña
        if ($data['password'] === $password) {
            // Login correcto → resetear intentos
            //$_SESSION['intentos'] = 0;
            mysqli_query($mysqli, "INSERT INTO logs_acceso (id_user, success) VALUES (" . $data['id_user'] . ", 0)");
            // escribir logs
            $log->info("Login exitoso para usuario: " . $data['username']);
            mysqli_query($mysqli, "UPDATE usuarios SET intentos = 0 WHERE id_user = " . $data['id_user']);

            $_SESSION['id_user']         = $data['id_user'];
            $_SESSION['name_user']       = $data['name_user'];
            $_SESSION['username']        = $data['username'];
            $_SESSION['permisos_acceso'] = $data['permisos_acceso'];

            header("Location: main.php?module=start");
        } else {
            // Login incorrecto → incrementar intentos
            // if (!isset($_SESSION['intentos'])) {
            //     $_SESSION['intentos'] = 0;
            // }
            //$_SESSION['intentos']++;


            // Registrar intento fallido de acceso al sistema
            mysqli_query($mysqli, "INSERT INTO logs_acceso (id_user, success) VALUES (" . $data['id_user'] . ", 1)");
            //escribir logs
            $log->security("Login fallido para usuario: " . $data['username']);

            mysqli_query($mysqli, "UPDATE usuarios SET intentos = intentos + 1 WHERE id_user = " . $data['id_user']);

            // Consultar intentos fallidos
            $query2 = mysqli_query($mysqli, "SELECT intentos FROM usuarios WHERE id_user = " . $data['id_user']);
            $row2 = mysqli_fetch_assoc($query2);
            // Guardar el resultado en una variable
            $intentos = $row2['intentos'];

            if ($intentos >= 3) {
                // Bloquear usuario en la base
                $log->security("Se bloquea al usuario por intentos fallidos: " . $data['username']); // Se registra en los logs
                mysqli_query($mysqli, "UPDATE usuarios SET status='2' WHERE id_user = " . $data['id_user']);
                header("Location: index.php?alert=4"); // cuenta bloqueada

                //$_SESSION['intentos'] = 0;

                exit();
            } else {
                header("Location: index.php?alert=1"); // contraseña incorrecta
                exit();
            }
        }
    } else {
        header("Location: index.php?alert=1"); // usuario no encontrado
        exit();
    }
}
?>