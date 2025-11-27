<?php

session_start();
require_once "../../config/database.php";

if (empty($_SESSION['username'])  && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
} else {
    $cod_producto  = mysqli_real_escape_string($mysqli, trim($_POST['cod_producto']));
    $cod_tipo_prod = mysqli_real_escape_string($mysqli, trim($_POST['cod_tipo_prod']));
    $id_u_medida   = mysqli_real_escape_string($mysqli, trim($_POST['id_u_medida']));
    $p_descrip     = mysqli_real_escape_string($mysqli, trim($_POST['p_descrip']));
    $precio        = mysqli_real_escape_string($mysqli, trim($_POST['precio']));
    if ($_GET['act'] == 'insert') {

        $query = mysqli_query($mysqli, "INSERT INTO producto (cod_producto, cod_tipo_prod, id_u_medida, p_descrip, precio)
                                        VALUES ('$cod_producto', '$cod_tipo_prod', '$id_u_medida', '$p_descrip', '$precio')")
            or die('Error: ' . mysqli_error($mysqli));

        if ($query) {
            header("Location: ../../main.php?module=producto&alert=1");
        } else {
            header("Location: ../../main.php?module=producto&alert=4");
        }
    } elseif ($_GET['act'] == 'edit') {
        if (isset($_POST['Guardar'])) {
            if (isset($_POST['cod_producto'])) {
                $query = mysqli_query($mysqli, "UPDATE producto 
                                                SET cod_tipo_prod  = '$cod_tipo_prod', 
                                                    id_u_medida    = '$id_u_medida',
                                                    p_descrip      = '$p_descrip',
                                                    precio         = '$precio'
                                                WHERE cod_producto = '$cod_producto'")
                    or die('Error: ' . mysqli_error($mysqli));

                if ($query) {
                    header("Location: ../../main.php?module=producto&alert=2");
                }
            }
        }
    } elseif ($_GET['act'] == 'delete') {
        if (isset($_GET['cod_producto'])) {
            $cod_producto = mysqli_real_escape_string($mysqli, trim($_GET['cod_producto']));

            $query = mysqli_query($mysqli, "DELETE FROM producto
                                            WHERE cod_producto = '$cod_producto'")
                or die('Error: ' . mysqli_error($mysqli));

            if ($query) {
                header("Location: ../../main.php?module=producto&alert=3");
            } else {
                header("Location: ../../main.php?module=producto&alert=4");
            }
        }
    } else {
        header("Location: ../../main.php?module=producto&alert=4");
    }
}
