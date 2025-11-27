<?php

session_start();
require_once "../../config/database.php";

if (empty($_SESSION['username'])  && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
} else {
    if ($_GET['act'] == 'insert') {
        $id_departamento           = mysqli_real_escape_string($mysqli, trim($_POST['id_departamento']));
        $dep_descripcion           = mysqli_real_escape_string($mysqli, trim($_POST['dep_descripcion']));

        $query = mysqli_query($mysqli, "INSERT INTO departamento (id_departamento, dep_descripcion)
                                        VALUES ('$id_departamento', '$dep_descripcion')")
            or die('Error: ' . mysqli_error($mysqli));

        if ($query) {
            header("Location: ../../main.php?module=departamento&alert=1");
        }
    } elseif ($_GET['act'] == 'edit') {
        if (isset($_POST['Guardar'])) {
            if (isset($_POST['id_departamento'])) {
                $id_departamento           = mysqli_real_escape_string($mysqli, trim($_POST['id_departamento']));
                $dep_descripcion          = mysqli_real_escape_string($mysqli, trim($_POST['dep_descripcion']));
                $query = mysqli_query($mysqli, "UPDATE departamento SET dep_descripcion = '$dep_descripcion'
                                                WHERE id_departamento = '$id_departamento'")
                    or die('Error: ' . mysqli_error($mysqli));

                if ($query) {
                    header("Location: ../../main.php?module=departamento&alert=2");
                }
            }
        }
    } elseif ($_GET['act'] == 'delete') {
        if (isset($_GET['id_departamento'])) {
            $id_departamento = mysqli_real_escape_string($mysqli, trim($_GET['id_departamento']));

            $query = mysqli_query($mysqli, "DELETE FROM departamento
                                            WHERE id_departamento = '$id_departamento'")
                or die('Error: ' . mysqli_error($mysqli));

            if ($query) {
                header("Location: ../../main.php?module=departamento&alert=3");
            } else {
                header("Location: ../../main.php?module=departamento&alert=4");
            }
        }
    } else {
        header("Location: ../../main.php?module=departamento&alert=4");
    }
}
