<?php

require_once "config/database.php";

$username = mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars($_POST['username']))));
$password = md5(mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars($_POST['password'])))));
if (!ctype_alnum($username) || !ctype_alnum($password)) {
    header("Location: index.php?alert=1");
    exit();
}else{
    $query = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password' AND status='activo'")
                                    or die('Error: ' . mysqli_error($mysqli));
    $rows = mysqli_num_rows($query);
    if ($rows > 0) {
        session_start();
        $data = mysqli_fetch_assoc($query);
        $_SESSION['id_user']            = $data['id_user'];
        $_SESSION['name_user']          = $data['name_user'];
        $_SESSION['username']           = $data['username'];
        $_SESSION['permisos_acceso']    = $data['permisos_acceso'];
        //echo "Bienvenido " . $_SESSION['name_user'];
        
        header("Location: main.php?module=start");
    } else {
        header("Location: index.php?alert=1");
    }
}

?>

<?php
// session_start();
// require_once "config/database.php";

// // Sanitización de entradas
// $username = mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars($_POST['username']))));
// $password = md5(mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars($_POST['password'])))));

// // Validación básica
// if (!ctype_alnum($username) || !ctype_alnum($password)) {
//     header("Location: index.php?alert=1");
//     exit();
// } else {
//     // Buscar usuario
//     $query = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE username = '$username'")
//                                 or die('Error: ' . mysqli_error($mysqli));
//     $rows = mysqli_num_rows($query);

//     if ($rows > 0) {
//         $data = mysqli_fetch_assoc($query);

//         // Verificar si está bloqueado
//         if ($data['status'] !== 'activo') {
//             header("Location: index.php?alert=4"); // cuenta bloqueada
//             exit();
//         }

//         // Comparar contraseña
//         if ($data['password'] === $password) {
//             // Login correcto → resetear intentos
//             $contador = 0;

//             $_SESSION['id_user']         = $data['id_user'];
//             $_SESSION['name_user']       = $data['name_user'];
//             $_SESSION['username']        = $data['username'];
//             $_SESSION['permisos_acceso'] = $data['permisos_acceso'];

//             header("Location: main.php?module=start");
//         } else {
//             // Login incorrecto → incrementar intentos
//             // if (!isset($_SESSION['intentos'])) {
//             //     $_SESSION['intentos'] = 0;
//             // }
//             $contador++;

//             if ($contador >= 3) {
//                 // Bloquear usuario en la base
//                 mysqli_query($mysqli, "UPDATE usuarios SET status='inactivo' WHERE id_user=".$data['id_user']);
//                 header("Location: index.php?alert=4"); // cuenta bloqueada
//                 exit();
//             } else {
//                 header("Location: index.php?alert=1"); // contraseña incorrecta
//                 exit();
//             }
//         }
//     } else {
//         header("Location: index.php?alert=1"); // usuario no encontrado
//         exit();
//     }
// }
?>