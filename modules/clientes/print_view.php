<?php

require_once "../../config/database.php";

$query = mysqli_query($mysqli, "SELECT * FROM v_clientes")
    or die('Error: ' . mysqli_error($mysqli));

$cont = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link rel="shortcut icon" href="../../assets/img/favicon.png">
    <link rel="stylesheet" href="../../assets/css/print.css">
</head>

<body>
    <div class="page-header" align="center">
        <h1>Reporte de Ciudades</h1>
    </div>
    <div class="info-header">
        <div><strong>Fecha de impresión: </strong><?php echo date("d/m/Y"); ?></div>
        <div><strong>Cantidad de Registros: <?php echo $cont; ?></strong></div>
    </div>
    <hr>
    <table class="table-list" cellspacing="0" cellpadding="10" border="0.3" align="center">
        <thead style="background: #e8ecee;">
            <tr>
                <th height="30" align="center" valign="middle">Documento</th>
                <th height="30" align="center" valign="middle">Nombre.</th>
                <th height="30" align="center" valign="middle">Apellido</th>
                <th height="30" align="center" valign="middle">Dirección</th>
                <th height="30" align="center" valign="middle">Teléfono</th>
                <th height="30" align="center" valign="middle">Ciudad</th>
                <th height="30" align="center" valign="middle">Dpto.</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($cont > 0) {
                while ($data = mysqli_fetch_assoc($query)) {
                    $ci_ruc               = $data['ci_ruc'];
                    $cli_nombre           = $data['cli_nombre'];
                    $cli_apellido         = $data['cli_apellido'];
                    $cli_direccion        = $data['cli_direccion'];
                    $cli_telefono         = str_pad($data['cli_telefono'], 10, '0', STR_PAD_LEFT); // Rellenar con ceros a la izquierda
                    $descrip_ciudad       = $data['descrip_ciudad'];
                    $dep_descripcion      = $data['dep_descripcion'];
            ?>
                    <tr>
                        <td width="100" align="center" valign="middle"><?= $ci_ruc; ?></td>
                        <td width="100" align="center" valign="middle"><?= $cli_nombre; ?></td>
                        <td width="150" align="center" valign="middle"><?= $cli_apellido; ?></td>
                        <td width="150" align="center" valign="middle"><?= $cli_direccion; ?></td>
                        <td width="100" align="center" valign="middle"><?= $cli_telefono; ?></td>
                        <td width="150" align="center" valign="middle"><?= $descrip_ciudad; ?></td>
                        <td width="150" align="center" valign="middle"><?= $dep_descripcion; ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>