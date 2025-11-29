<?php

session_start();
require_once "../../config/database.php";

if (empty($_SESSION['username'])  && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
} else {
    if ($_GET['act'] == 'insert') {
        if (isset($_POST['Guardar'])) {
            $codigo                  = mysqli_real_escape_string($mysqli, trim($_POST['cod_venta']));
            $codigo_deposito         = mysqli_real_escape_string($mysqli, trim($_POST['cod_deposito']));
            $codigo_producto         = mysqli_real_escape_string($mysqli, trim($_POST['codigo_producto']));


            // Verificar si existe stock suficiente
            $sql = mysqli_query($mysqli, "SELECT * FROM producto, tmp WHERE producto.cod_producto=tmp.id_producto");
            $num = mysqli_num_rows($sql);
            while ($row = mysqli_fetch_assoc($sql)) {
                $codigo_producto     = $row['id_producto'];
                $precio              = $row['precio_tmp'];
                $cantidad            = $row['cantidad_tmp'];
                $subtotal            = $cantidad * $precio;

                // Restar stock
                $query = mysqli_query($mysqli, "SELECT * FROM stock WHERE cod_producto = '$codigo_producto'
                                                AND cod_deposito = '$codigo_deposito'")
                    or die('Error: ' . mysqli_error($mysqli));

                if ($count = mysqli_num_rows($query) > $cantidad) {
                    header("Location: ../../main.php?module=venta&alert=4");
                    return;
                } else {
                    $actualizar_stock = mysqli_query($mysqli, "UPDATE stock SET cantidad = cantidad - '$cantidad' 
                                                    WHERE cod_producto = '$codigo_producto' 
                                                    AND cod_deposito = '$codigo_deposito'")
                        or die('Error: ' . mysqli_error($mysqli));
                    $data  = mysqli_fetch_assoc($query);
                }
            }




            // Insertar en la tabla venta
        //     $id_cliente = mysqli_real_escape_string($mysqli, trim($_POST['id_cliente']));
        //     $fecha         = mysqli_real_escape_string($mysqli, trim($_POST['fecha']));
        //     $hora          = mysqli_real_escape_string($mysqli, trim($_POST['hora']));
        //     $nro_factura   = mysqli_real_escape_string($mysqli, trim($_POST['nro_factura']));
        //     $suma_total    = mysqli_real_escape_string($mysqli, trim($_POST['suma_total']));
        //     $estado = 'activo';
        //     $usuario = $_SESSION['id_user'];




        //     $insert_venta = mysqli_query($mysqli, "INSERT INTO venta(cod_venta, id_cliente, nro_factura, fecha, estado, hora, total_venta) 
        //                                             VALUES($codigo, $id_cliente, '$nro_factura', '$fecha', '$estado', '$hora', '$suma_total')")
        //         or die('Error: ' . mysqli_error($mysqli));

        //     // Insertar detalle de venta
        //     $sql = mysqli_query($mysqli, "SELECT * FROM producto, tmp WHERE producto.cod_producto=tmp.id_producto");
        //     $num = mysqli_num_rows($sql);
        //     while ($row = mysqli_fetch_assoc($sql)) {
        //         $codigo_producto     = $row['id_producto'];
        //         $precio              = $row['precio_tmp'];
        //         $cantidad            = $row['cantidad_tmp'];
        //         $subtotal            = $cantidad * $precio;

        //         $insert_detalle = mysqli_query($mysqli, "INSERT INTO det_venta(cod_producto, cod_venta, cod_deposito, det_precio_unit, det_cantidad) 
        //                                         VALUES('$codigo_producto', '$codigo', '$codigo_deposito', '$precio', '$cantidad')")
        //             or die('Error: ' . mysqli_error($mysqli));

        //         // Restar stock
        //         $query = mysqli_query($mysqli, "SELECT * FROM stock WHERE cod_producto = '$codigo_producto'
        //                                         AND cod_deposito = '$codigo_deposito'")
        //             or die('Error: ' . mysqli_error($mysqli));

        //         if ($count = mysqli_num_rows($query) > $cantidad) {
        //             header("Location: ../../main.php?module=venta&alert=4");
        //         } else {
        //             $actualizar_stock = mysqli_query($mysqli, "UPDATE stock SET cantidad = cantidad - '$cantidad' 
        //                                             WHERE cod_producto = '$codigo_producto' 
        //                                             AND cod_deposito = '$codigo_deposito'")
        //                 or die('Error: ' . mysqli_error($mysqli));
        //             $data  = mysqli_fetch_assoc($query);
        //         }
        //     }

        //     if ($insert_detalle) {
        //         header("Location: ../../main.php?module=venta&alert=1");
        //     } else {
        //         header("Location: ../../main.php?module=venta&alert=3");
        //     }
         }
        // Anular Venta y recargar el stock
    } elseif($_GET['act'] == 'anular'){
        if (isset($_GET['cod_venta'])) {
            $codigo = $_GET['cod_venta'];

            // Anular cabecera de compra estado = anulado
            $query = mysqli_query($mysqli, "UPDATE venta SET estado = 'anulado' WHERE cod_venta = $codigo")
            or die('Error: ' . mysqli_error($mysqli));

            // Consultar detalle de compra
            $sql = mysqli_query($mysqli, "SELECT * FROM detalle_compra WHERE cod_compra = $codigo");
            while ($row = mysqli_fetch_assoc($sql)) {
                $codigo_producto     = $row['cod_producto'];
                $codigo_deposito     = $row['cod_deposito'];
                $cantidad            = $row['cantidad'];

                $actualizar_stock = mysqli_query($mysqli, "UPDATE stock SET cantidad = cantidad + $cantidad 
                                                            WHERE cod_producto = $codigo_producto
                                                            AND cod_deposito = $codigo_deposito")
            or die('Error: ' . mysqli_error($mysqli));
            }
            if ($query) {
                header("Location: ../../main.php?module=venta&alert=2");
            } else {
                header("Location: ../../main.php?module=venta&alert=3");
            }
        }
    }
}
