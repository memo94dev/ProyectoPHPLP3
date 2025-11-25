<?php

session_start();
require_once "../../config/database.php";

if (empty($_SESSION['username'])  && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
} else {
    if ($_GET['act'] == 'insert') {
        if (isset($_POST['Guardar'])) {
            $codigo                  = mysqli_real_escape_string($mysqli, trim($_POST['cod_compra']));
            $codigo_deposito         = mysqli_real_escape_string($mysqli, trim($_POST['cod_deposito']));
            $codigo_producto         = mysqli_real_escape_string($mysqli, trim($_POST['codigo_producto']));

            // Insertar en la tabla compra
            $cod_proveedor = mysqli_real_escape_string($mysqli, trim($_POST['cod_proveedor']));
            $fecha         = mysqli_real_escape_string($mysqli, trim($_POST['fecha']));
            $hora          = mysqli_real_escape_string($mysqli, trim($_POST['hora']));
            $nro_factura   = mysqli_real_escape_string($mysqli, trim($_POST['nro_factura']));
            $suma_total    = mysqli_real_escape_string($mysqli, trim($_POST['suma_total']));
            $estado = 'activo';
            $usuario = $_SESSION['id_user'];
            $insert_compra = mysqli_query($mysqli, "INSERT INTO compra(cod_compra, cod_proveedor, nro_factura, fecha, estado, cod_deposito, hora, total_compra, id_user) 
                                                    VALUES($codigo, $cod_proveedor, '$nro_factura', '$fecha', '$estado', $codigo_deposito, '$hora', '$suma_total', '$usuario')")
                or die('Error: ' . mysqli_error($mysqli));

            // Insertar detalle de compra
            $sql = mysqli_query($mysqli, "SELECT * FROM producto, tmp WHERE producto.cod_producto=tmp.id_producto");
            $num = mysqli_num_rows($sql);
            while ($row = mysqli_fetch_assoc($sql)) {
                $codigo_producto     = $row['id_producto'];
                $precio              = $row['precio_tmp'];
                $cantidad            = $row['cantidad_tmp'];
                $subtotal            = $cantidad * $precio;

                $insert_detalle = mysqli_query($mysqli, "INSERT INTO detalle_compra(cod_producto, cod_compra, cod_deposito, precio, cantidad) 
                                                VALUES('$codigo_producto', '$codigo', '$codigo_deposito', '$precio', '$cantidad')")
                    or die('Error: ' . mysqli_error($mysqli));

                //Insertar stock
                $query = mysqli_query($mysqli, "SELECT * FROM stock WHERE cod_producto = '$codigo_producto'
                                                AND cod_deposito = '$codigo_deposito'")
                    or die('Error: ' . mysqli_error($mysqli));

                if ($count = mysqli_num_rows($query) == 0) {
                    $insert_stock = mysqli_query($mysqli, "INSERT INTO stock(cod_deposito, cod_producto, cantidad) 
                                                    VALUES('$codigo_deposito', '$codigo_producto', '$cantidad')")
                        or die('Error: ' . mysqli_error($mysqli));
                } else {
                    $actualizar_stock = mysqli_query($mysqli, "UPDATE stock SET cantidad = cantidad + '$cantidad' 
                                                    WHERE cod_producto = '$codigo_producto' 
                                                    AND cod_deposito = '$codigo_deposito'")
                        or die('Error: ' . mysqli_error($mysqli));
                    $data  = mysqli_fetch_assoc($query);
                }
            }

            if ($insert_detalle) {
                header("Location: ../../main.php?module=compras&alert=1");
            } else {
                header("Location: ../../main.php?module=compras&alert=3");
            }
        }
    }
}
