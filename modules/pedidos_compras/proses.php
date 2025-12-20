<?php

session_start();
require_once "../../config/database.php";

if (empty($_SESSION['username'])  && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
} else {
    if ($_GET['act'] == 'insert') {
        if (isset($_POST['Guardar'])) {
            $id_pedido                  = mysqli_real_escape_string($mysqli, trim($_POST['id_pedido']));
            //$codigo_deposito         = mysqli_real_escape_string($mysqli, trim($_POST['cod_deposito']));
            $codigo_producto         = mysqli_real_escape_string($mysqli, trim($_POST['codigo_producto']));

            // Insertar en la tabla pedidos_compra
            $cod_proveedor = mysqli_real_escape_string($mysqli, trim($_POST['cod_proveedor']));
            $fecha         = mysqli_real_escape_string($mysqli, trim($_POST['fecha']));
            $hora          = mysqli_real_escape_string($mysqli, trim($_POST['hora']));
            //$nro_factura   = mysqli_real_escape_string($mysqli, trim($_POST['nro_factura']));
            $suma_total    = mysqli_real_escape_string($mysqli, trim($_POST['suma_total']));
            $estado = 'P';
            $usuario = $_SESSION['id_user'];
            $insert_compra = mysqli_query($mysqli, "INSERT INTO pedidos_compra(id_pedido, cod_proveedor, fecha, hora, estado, id_user) 
                                                    VALUES($id_pedido, $cod_proveedor, '$fecha', '$hora', '$estado', '$usuario')")
                or die('Error: ' . mysqli_error($mysqli));

            // Insertar detalle de pedidos_compra
            $sql = mysqli_query($mysqli, "SELECT * FROM producto, tmp WHERE producto.cod_producto=tmp.id_producto");
            $num = mysqli_num_rows($sql);
            while ($row = mysqli_fetch_assoc($sql)) {
                $codigo_producto     = $row['id_producto'];
                $precio              = $row['precio_tmp'];
                $cantidad            = $row['cantidad_tmp'];
                $subtotal            = $cantidad * $precio;

                $insert_detalle = mysqli_query($mysqli, "INSERT INTO detalle_pedidos_compra(cod_producto, id_pedido, cantidad) 
                                                VALUES('$codigo_producto', '$id_pedido', '$cantidad')")
                    or die('Error: ' . mysqli_error($mysqli));

            }

            if ($insert_detalle) {
                header("Location: ../../main.php?module=pedidos_compras&alert=1");
            } else {
                header("Location: ../../main.php?module=pedidos_compras&alert=3");
            }
        }
    } elseif($_GET['act'] == 'rechazar'){
        if (isset($_GET['id_pedido'])) {
            $id_pedido = $_GET['id_pedido'];

            // Rechazar pedido de compra estado = rechazado
            $query = mysqli_query($mysqli, "UPDATE pedidos_compra SET estado = 'R' WHERE id_pedido = $id_pedido")
            or die('Error: ' . mysqli_error($mysqli));

            if ($query) {
                header("Location: ../../main.php?module=pedidos_compras&alert=2");
            } else {
                header("Location: ../../main.php?module=pedidos_compras&alert=3");
            }
        }
    } elseif($_GET['act'] == 'pendiente'){
        if (isset($_GET['id_pedido'])) {
            $id_pedido = $_GET['id_pedido'];

            // Pasar a Pendiente 
            $query = mysqli_query($mysqli, "UPDATE pedidos_compra SET estado = 'P' WHERE id_pedido = $id_pedido")
            or die('Error: ' . mysqli_error($mysqli));

            if ($query) {
                header("Location: ../../main.php?module=pedidos_compras&alert=4");
            } else {
                header("Location: ../../main.php?module=pedidos_compras&alert=3");
            }
        }
    }
}
