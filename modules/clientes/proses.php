<?php

session_start();
require_once "../../config/database.php";

if (empty($_SESSION['username'])  && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
} else {
    if ($_GET['act'] == 'insert') {
        $id_cliente           = mysqli_real_escape_string($mysqli, trim($_POST['id_cliente']));
        $ci_ruc               = mysqli_real_escape_string($mysqli, trim($_POST['ci_ruc']));
        $cli_nombre           = mysqli_real_escape_string($mysqli, trim($_POST['cli_nombre']));
        $cli_apellido         = mysqli_real_escape_string($mysqli, trim($_POST['cli_apellido']));
        $cli_direccion        = mysqli_real_escape_string($mysqli, trim($_POST['cli_direccion']));
        $cli_telefono         = mysqli_real_escape_string($mysqli, trim($_POST['cli_telefono']));
        $cod_ciudad           = mysqli_real_escape_string($mysqli, trim($_POST['cod_ciudad']));

        $query = mysqli_query($mysqli, "INSERT INTO clientes 
                                            (id_cliente, ci_ruc, cli_nombre, cli_apellido, cli_direccion, cli_telefono, cod_ciudad)
                                        VALUES 
                                            ('$id_cliente', '$cli_documento', '$cli_nombre', '$cli_apellido', '$cli_direccion', '$cli_telefono', '$cod_ciudad')")
            or die('Error: ' . mysqli_error($mysqli));

        if ($query) {
            header("Location: ../../main.php?module=clientes&alert=1");
        } else {
            header("Location: ../../main.php?module=clientes&alert=4");
        }
    } elseif ($_GET['act'] == 'edit') {
        if (isset($_POST['Guardar'])) {
            if (isset($_POST['id_cliente'])) {
                $id_cliente           = mysqli_real_escape_string($mysqli, trim($_POST['id_cliente']));
                $ci_ruc               = mysqli_real_escape_string($mysqli, trim($_POST['ci_ruc']));
                $cli_nombre           = mysqli_real_escape_string($mysqli, trim($_POST['cli_nombre']));
                $cli_apellido         = mysqli_real_escape_string($mysqli, trim($_POST['cli_apellido']));
                $cli_direccion        = mysqli_real_escape_string($mysqli, trim($_POST['cli_direccion']));
                $cli_telefono         = mysqli_real_escape_string($mysqli, trim($_POST['cli_telefono']));
                $cod_ciudad           = mysqli_real_escape_string($mysqli, trim($_POST['cod_ciudad']));

                $query = mysqli_query($mysqli, "UPDATE clientes SET id_cliente = '$id_cliente', 
                                                                ci_ruc = '$ci_ruc', 
                                                                cli_nombre = '$cli_nombre', 
                                                                cli_apellido = '$cli_apellido', 
                                                                cli_direccion = '$cli_direccion', 
                                                                cli_telefono = '$cli_telefono', 
                                                                cod_ciudad = '$cod_ciudad'
                                                WHERE id_cliente = '$id_cliente'")
                    or die('Error: ' . mysqli_error($mysqli));

                if ($query) {
                    header("Location: ../../main.php?module=clientes&alert=1");
                }
            }
        }
    } elseif ($_GET['act'] == 'delete') {
        if (isset($_GET['id_cliente'])) {
            $id_cliente = mysqli_real_escape_string($mysqli, trim($_GET['id_cliente']));

            $query = mysqli_query($mysqli, "DELETE FROM clientes
                                            WHERE id_cliente = '$id_cliente'")
                or die('Error: ' . mysqli_error($mysqli));

            if ($query) {
                header("Location: ../../main.php?module=clientes&alert=3");
            } else {
                header("Location: ../../main.php?module=clientes&alert=4");
            }
        }
    } else {
        header("Location: ../../main.php?module=clientes&alert=4");
    }
}
