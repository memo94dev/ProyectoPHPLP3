<?php

session_start();
require_once "../../config/database.php";
require_once "../../config/Logger.php";
$log = new Logger("../../logs/app.log");

if (empty($_SESSION['username'] && empty($_SESSION['password']))) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
}else{
    if (isset($_POST['Guardar'])) {
        $old_password         = md5(mysqli_real_escape_string($mysqli, trim($_POST['old_password'])));
        $new_password         = md5(mysqli_real_escape_string($mysqli, trim($_POST['new_password'])));
        $confirm_new_password = md5(mysqli_real_escape_string($mysqli, trim($_POST['confirm_new_password'])));
        $id_user              = $_SESSION['id_user'];

        $query = mysqli_query($mysqli, "SELECT password FROM usuarios WHERE id_user = '$id_user' AND password = '$old_password'")
                                        or die('Error: '.mysqli_error($mysqli));
        $data = mysqli_fetch_assoc($query);

        if (mysqli_num_rows($query) == 0) {
            $log->security("Intento fallido de cambio de contrasenha para el usuario: '" . $_SESSION['username'] . "' id: " . $_SESSION['id_user']);
            header("Location: ../../main.php?module=password&alert=1");
        } else {
            if ($new_password != $confirm_new_password) {
                header("Location: ../../main.php?module=password&alert=2");
            } else {
                $mysqli_query = mysqli_query($mysqli, "UPDATE usuarios SET password = '$new_password' WHERE id_user = '$id_user'")
                                        or die('Error: '.mysqli_error($mysqli));
                if ($mysqli_query) {
                    $log->info("Cambio de contrasenha exitoso para el usuario: '" . $_SESSION['username'] . "' id: " . $_SESSION['id_user']);
                    header("Location: ../../main.php?module=password&alert=3");
                }
            }
        }
    }
}
    
?>