<?php

session_start();
require_once "../../config/database.php";

if (empty($_SESSION['username'])  && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
} else {
    if ($_GET['act'] == 'insert') {
        $cod_tipo_prod           = mysqli_real_escape_string($mysqli, trim($_POST['cod_tipo_prod']));
        $t_p_descrip           = mysqli_real_escape_string($mysqli, trim($_POST['t_p_descrip']));

        $query = mysqli_query($mysqli, "INSERT INTO tipo_producto (cod_tipo_prod, t_p_descrip)
                                        VALUES ('$cod_tipo_prod', '$t_p_descrip')")
            or die('Error: ' . mysqli_error($mysqli));

        if ($query) {
            header("Location: ../../main.php?module=tipo_producto&alert=1");
        }
    } elseif ($_GET['act'] == 'edit') {
        if (isset($_POST['Guardar'])) {
            if (isset($_POST['cod_tipo_prod'])) {
                $cod_tipo_prod           = mysqli_real_escape_string($mysqli, trim($_POST['cod_tipo_prod']));
                $t_p_descrip          = mysqli_real_escape_string($mysqli, trim($_POST['t_p_descrip']));
                $query = mysqli_query($mysqli, "UPDATE tipo_producto SET t_p_descrip = '$t_p_descrip'
                                                WHERE cod_tipo_prod = '$cod_tipo_prod'")
                    or die('Error: ' . mysqli_error($mysqli));

                if ($query) {
                    header("Location: ../../main.php?module=tipo_producto&alert=2");
                }
            }
        }
    } elseif ($_GET['act'] == 'delete') {
        if (isset($_GET['cod_tipo_prod'])) {
            $cod_tipo_prod = mysqli_real_escape_string($mysqli, trim($_GET['cod_tipo_prod']));

            $query = mysqli_query($mysqli, "DELETE FROM tipo_producto
                                            WHERE cod_tipo_prod = '$cod_tipo_prod'")
                or die('Error: ' . mysqli_error($mysqli));

            if ($query) {
                header("Location: ../../main.php?module=tipo_producto&alert=3");
            } else {
                header("Location: ../../main.php?module=tipo_producto&alert=4");
            }
        }
    } else {
        header("Location: ../../main.php?module=tipo_producto&alert=4");
    }
}
