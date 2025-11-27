<?php

session_start();
require_once "../../config/database.php";

if (empty($_SESSION['username'])  && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
} else {
    $cod_proveedor     = mysqli_real_escape_string($mysqli, trim($_POST['cod_proveedor']));
    $razon_social      = mysqli_real_escape_string($mysqli, trim($_POST['razon_social']));
    $ruc               = mysqli_real_escape_string($mysqli, trim($_POST['ruc']));
    $direccion         = empty(trim($_POST['direccion'])) ? 'sin registros' : mysqli_real_escape_string($mysqli, trim($_POST['direccion']));
    $telefono          = empty(trim($_POST['telefono'])) ? '0' : mysqli_real_escape_string($mysqli, trim($_POST['telefono']));
    if ($_GET['act'] == 'insert') {

        $query = mysqli_query($mysqli, "INSERT INTO proveedor (cod_proveedor, razon_social, ruc, direccion, telefono)
                                        VALUES ('$cod_proveedor', '$razon_social', '$ruc', '$direccion', '$telefono')")
            or die('Error: ' . mysqli_error($mysqli));

        if ($query) {
            header("Location: ../../main.php?module=proveedor&alert=1");
        }
    } elseif ($_GET['act'] == 'edit') {
        if (isset($_POST['Guardar'])) {
            if (isset($_POST['cod_proveedor'])) {
        
                $query = mysqli_query($mysqli, "UPDATE proveedor SET 
                                                        razon_social = '$razon_social',
                                                        ruc          = '$ruc',
                                                        direccion    = '$direccion',
                                                        telefono     = '$telefono'
                                                WHERE cod_proveedor  = '$cod_proveedor'")
                    or die('Error: ' . mysqli_error($mysqli));

                if ($query) {
                    header("Location: ../../main.php?module=proveedor&alert=2");
                }
            }
        }
    } elseif ($_GET['act'] == 'delete') {
        if (isset($_GET['cod_proveedor'])) {
            $cod_proveedor = mysqli_real_escape_string($mysqli, trim($_GET['cod_proveedor']));

            $query = mysqli_query($mysqli, "DELETE FROM proveedor
                                            WHERE cod_proveedor = '$cod_proveedor'")
                or die('Error: ' . mysqli_error($mysqli));

            if ($query) {
                header("Location: ../../main.php?module=proveedor&alert=3");
            } else {
                header("Location: ../../main.php?module=proveedor&alert=4");
            }
        }
    } else {
        header("Location: ../../main.php?module=proveedor&alert=4");
    }
}
