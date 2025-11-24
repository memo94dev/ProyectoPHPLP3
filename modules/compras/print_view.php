<?php

require_once "../../config/database.php";

if ($_GET['act'] == 'print') {
    if (isset($_GET['cod_compra'])) {
        $codigo = $_GET['cod_compra'];
        $query1 = mysqli_query($mysqli, "SELECT * FROM v_compras WHERE cod_compra='$codigo'")
            or die('Error: ' . mysqli_error($mysqli));

            while ($data = mysqli_fetch_assoc($query1)) {
            $cod_compra = $data['cod_compra'];
            $razon_social = $data['razon_social'];
            $deposito = $data['descrip'];
            $nro_factura = $data['nro_factura'];
            $fecha = $data['fecha'];
            $fecha_formatted = date('d-m-Y', strtotime($fecha));
            $hora = $data['hora'];
            $hora_formatted = date('H:i:s', strtotime($hora));
            $total = $data['total_compra'];
            $total = number_format($total, 0, ',', '.');
            $usuario = $data['name_user'];
        }

        $query2 = mysqli_query($mysqli, "SELECT * FROM v_det_compra WHERE cod_compra='$codigo'")
            or die('Error: ' . mysqli_error($mysqli));

        $cont = mysqli_num_rows($query1);
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura de Compras</title>
    <link rel="shortcut icon" href="../../assets/img/favicon.png">
    <link rel="stylesheet" href="../../assets/css/print.css">
</head>

<body>
    <div class="page-header" align="center">
        <h1>Reporte de Factura de Compras</h1>
    </div>
    <div align="center">
        <label><strong>Factura Nro: </strong> <?= $nro_factura; ?></label><br>
        <label><strong>Proveedor: </strong> <?= $razon_social; ?></label><br>
        <label><strong>Depósito: </strong> <?= $deposito; ?></label><br>
        <label><strong>Fecha: </strong> <?= $fecha_formatted; ?><strong> Hora: </strong> <?= $hora_formatted; ?></label><br>
        <label><strong>Usuario: </strong> <?= $usuario; ?></label>
    </div>
    <div class="info-header">
        <div><strong>Fecha de impresión: </strong><?php echo date("d/m/Y"); ?></div>
    </div>
    <hr>
    <table class="table-list" cellspacing="0" cellpadding="10" border="0.3" align="center">
        <thead style="background: #e8ecee;">
            <tr>
                <th height="30" align="center" valign="middle">Tipo de Producto</th>
                <th height="30" align="center" valign="middle">Producto</th>
                <th height="30" align="center" valign="middle">Unidad de Medida</th>
                <th height="30" align="center" valign="middle">Precio</th>
                <th height="30" align="center" valign="middle">Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($data2 = mysqli_fetch_assoc($query2)) {
                $tipo_producto = $data2['t_p_descrip'];
                $producto = $data2['p_descrip'];
                $unidad_medida = $data2['u_descrip'];
                $precio = $data2['precio'];
                $precio = number_format($precio, 0, ',', '.');
                $cantidad = $data2['cantidad'];
            ?>
                    <tr>
                        <td width="150" align="center" valign="middle"><?= $tipo_producto; ?></td>
                        <td width="150" align="center" valign="middle"><?= $producto; ?></td>
                        <td width="150" align="center" valign="middle"><?= $unidad_medida; ?></td>
                        <td width="100" align="center" valign="middle"><?= $precio; ?></td>
                        <td width="100" align="center" valign="middle"><?= $cantidad; ?></td>
                    </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <hr>
    <div align="center">
        <label><strong>Total de la Compra: </strong> <?= $total; ?></label>
    </div>
</body>

</html>