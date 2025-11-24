<?php 

require_once "../../config/database.php";

$query = mysqli_query($mysqli, "SELECT c.cod_ciudad, c.descrip_ciudad, d.id_departamento, d.dep_descripcion
                                FROM ciudad c
                                JOIN departamento d     
                                ON c.id_departamento = d.id_departamento 
                                ORDER BY c.cod_ciudad ASC")
    or die('Error: ' . mysqli_error($mysqli));

$cont = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Ciudades</title>
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
                <th height="30" align="center" valign="middle">Código.</th>
                <th height="30" align="center" valign="middle">Ciudad</th>
                <th height="30" align="center" valign="middle">Código.</th>
                <th height="30" align="center" valign="middle">Departamento</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($cont > 0) {
                while ($data = mysqli_fetch_assoc($query)) {
                    $id_ciudad = $data['cod_ciudad'];
                    $ciu_descripcion = $data['descrip_ciudad'];
                    $id_departamento = $data['id_departamento'];
                    $dep_descripcion = $data['dep_descripcion'];
                    ?>
                    <tr>
                        <td width="100" align="center" valign="middle"><?= $id_ciudad; ?></td>
                        <td width="150" align="center" valign="middle"><?= $ciu_descripcion; ?></td>
                        <td width="100" align="center" valign="middle"><?= $id_departamento; ?></td>
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