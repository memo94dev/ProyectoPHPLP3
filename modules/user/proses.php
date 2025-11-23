<?php

session_start();
require_once "../../config/database.php";

if (empty($_SESSION['username'])  && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
} else {
    if ($_GET['act'] == 'insert') {
        $username           = mysqli_real_escape_string($mysqli, trim($_POST['username']));
        $password           = md5(mysqli_real_escape_string($mysqli, trim($_POST['password'])));
        $name_user          = mysqli_real_escape_string($mysqli, trim($_POST['name_user']));
        $email              = mysqli_real_escape_string($mysqli, trim($_POST['email']));
        $telefono           = mysqli_real_escape_string($mysqli, trim($_POST['telefono']));
        $permisos_acceso    = mysqli_real_escape_string($mysqli, trim($_POST['permisos_acceso']));
        $status             = mysqli_real_escape_string($mysqli, trim($_POST['status']));

        $query = mysqli_query($mysqli, "INSERT INTO usuarios (username, password, name_user, email, telefono, permisos_acceso, status)
                                        VALUES ('$username', '$password', '$name_user', '$email', '$telefono', '$permisos_acceso', '$status')")
            or die('Error: ' . mysqli_error($mysqli));

        if ($query) {
            header("Location: ../../main.php?module=user&alert=1");
        }
    } elseif ($_GET['act'] == 'update') {
        if (isset($_POST['Guardar'])) {
            if (isset($_POST['id_user'])) {
                $id_user            = mysqli_real_escape_string($mysqli, trim($_POST['id_user']));
                $username           = mysqli_real_escape_string($mysqli, trim($_POST['username']));
                $name_user          = mysqli_real_escape_string($mysqli, trim($_POST['name_user']));
                $email              = mysqli_real_escape_string($mysqli, trim($_POST['email']));
                $telefono           = mysqli_real_escape_string($mysqli, trim($_POST['telefono']));
                $permisos_acceso    = mysqli_real_escape_string($mysqli, trim($_POST['permisos_acceso']));
                // File upload configuration
                $name_file = $_FILES['foto']['name'];
                $size_file = $_FILES['foto']['size'];
                $type_file = $_FILES['foto']['type'];
                $tmp_file  = $_FILES['foto']['tmp_name'];

                $allowed_ext = array('jpg', 'jpeg', 'png');
                $path        = "../../images/user/" . $name_file;
                $file        = explode('.', $name_file);
                $extension   = array_pop($file);

                /*header("Content-Type: application/json");
                $files = [
                    'name'     => $name_file,
                    'size'     => $size_file,
                    'type'     => $type_file,
                    'tmp_name' => $tmp_file,
                    'extension'=> $extension,
                    'path'     => $path
                ];

                echo json_encode($files);
                exit();*/

                if (empty($_FILES['foto']['name'])) {
                    $query = mysqli_query($mysqli, "UPDATE usuarios SET username = '$username',
                                                                name_user = '$name_user',
                                                                email = '$email',
                                                                telefono = '$telefono',
                                                                permisos_acceso = '$permisos_acceso'
                                                        WHERE id_user = '$id_user'")
                        or die('Error: ' . mysqli_error($mysqli));
                    if ($query) {
                        header("Location: ../../main.php?module=user&alert=2");
                    }
                } elseif (!empty($_FILES['foto']['name'])) {
                    if (in_array($extension, $allowed_ext)) {
                        if ($size_file <= 1000000) {
                            move_uploaded_file($tmp_file, $path);
                            $query = mysqli_query($mysqli, "UPDATE usuarios SET  username = '$username',
                                                                        name_user = '$name_user',
                                                                        email = '$email',
                                                                        telefono = '$telefono',
                                                                        permisos_acceso = '$permisos_acceso',
                                                                        foto = '$name_file'
                                                                WHERE id_user = '$id_user'")
                                or die('Error: ' . mysqli_error($mysqli));
                            if ($query) {
                                header("Location: ../../main.php?module=user&alert=2");
                            }
                        } else {
                            header("Location: ../../main.php?module=user&alert=6");
                        }
                    } else {
                        header("Location: ../../main.php?module=user&alert=5");
                    }
                } else {
                    header("Location: ../../main.php?module=user&alert=7");
                }
            }
        }

    } elseif ($_GET['act'] == 'on') { 
        if (isset($_GET['id'])) {
            $id_user = mysqli_real_escape_string($mysqli, trim($_GET['id']));

            $query = mysqli_query($mysqli, "UPDATE usuarios SET status = 'activo'
                                            WHERE id_user = '$id_user'")
                or die('Error: ' . mysqli_error($mysqli));

            if ($query) {
                header("Location: ../../main.php?module=user&alert=3");
            }
        }
    } elseif ($_GET['act'] == 'off') {
        if (isset($_GET['id'])) {
            $id_user = mysqli_real_escape_string($mysqli, trim($_GET['id']));

            $query = mysqli_query($mysqli, "UPDATE usuarios SET status = 'inactivo'
                                            WHERE id_user = '$id_user'")
                or die('Error: ' . mysqli_error($mysqli));

            if ($query) {
                header("Location: ../../main.php?module=user&alert=4");
            }
        }
    }
}
?>