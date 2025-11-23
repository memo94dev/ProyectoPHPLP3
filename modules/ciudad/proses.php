<?php

session_start();
require_once "../../config/database.php";

if (empty($_SESSION['username'])  && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
} else {
    if ($_GET['act'] == 'insert') {
        $cod_ciudad           = mysqli_real_escape_string($mysqli, trim($_POST['cod_ciudad']));
        $descrip_ciudad       = mysqli_real_escape_string($mysqli, trim($_POST['descrip_ciudad']));
        $id_departamento      = mysqli_real_escape_string($mysqli, trim($_POST['departamento']));

        $query = mysqli_query($mysqli, "INSERT INTO ciudad (cod_ciudad, descrip_ciudad, id_departamento)
                                        VALUES ('$cod_ciudad', '$descrip_ciudad', '$id_departamento')")
            or die('Error: ' . mysqli_error($mysqli));

        if ($query) {
            header("Location: ../../main.php?module=ciudad&alert=1");
        } else {
            header("Location: ../../main.php?module=ciudad&alert=4");
        }
    } elseif ($_GET['act'] == 'edit') {
        if (isset($_POST['Guardar'])) {
            if (isset($_POST['cod_ciudad'])) {
                $cod_ciudad           = mysqli_real_escape_string($mysqli, trim($_POST['cod_ciudad']));
                $descrip_ciudad          = mysqli_real_escape_string($mysqli, trim($_POST['descrip_ciudad']));
                $id_departamento      = mysqli_real_escape_string($mysqli, trim($_POST['departamento']));

                $query = mysqli_query($mysqli, "UPDATE ciudad SET descrip_ciudad = '$descrip_ciudad', id_departamento = '$id_departamento'
                                                WHERE cod_ciudad = '$cod_ciudad'")
                    or die('Error: ' . mysqli_error($mysqli));

                if ($query) {
                    header("Location: ../../main.php?module=ciudad&alert=1");
                }
            }
        }
    } elseif ($_GET['act'] == 'delete') {
        if (isset($_GET['cod_ciudad'])) {
            $cod_ciudad = mysqli_real_escape_string($mysqli, trim($_GET['cod_ciudad']));

            $query = mysqli_query($mysqli, "DELETE FROM ciudad
                                            WHERE cod_ciudad = '$cod_ciudad'")
                or die('Error: ' . mysqli_error($mysqli));

            if ($query) {
                header("Location: ../../main.php?module=ciudad&alert=3");
            } else {
                header("Location: ../../main.php?module=ciudad&alert=4");
            }
        }
    } else {
        header("Location: ../../main.php?module=ciudad&alert=4");
    }
}
