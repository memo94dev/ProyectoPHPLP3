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
        echo "Bienvenido " . $_SESSION['name_user'];
        
        //header("Location: main.php");
    } else {
        header("Location: index.php?alert=1");
    }
}

?>