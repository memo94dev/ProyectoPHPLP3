<?php 

require_once "../../config/database.php";

$query = mysqli_query($mysqli, "SELECT *
                                FROM tipo_producto ORDER BY cod_tipo_prod ASC")
    or die('Error: ' . mysqli_error($mysqli));

$cont = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tipos de Productos</title>
    <link rel="shortcut icon" href="../../assets/img/favicon.png">
    <link rel="stylesheet" href="../../assets/css/print.css">
</head>
<body>
    <div class="page-header" align="center">
        <h1>Lista de Tipos de Productos</h1>
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
                <th height="30" align="center" valign="middle">Descripción</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($cont > 0) {
                while ($data = mysqli_fetch_assoc($query)) {
                    $cod_tipo_prod = $data['cod_tipo_prod'];
                    $t_p_descrip = $data['t_p_descrip'];
                    ?>
                    <tr>
                        <td width="100" align="center" valign="middle"><?= $cod_tipo_prod; ?></td>
                        <td width="150" align="center" valign="middle"><?= $t_p_descrip; ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</body>
</html>