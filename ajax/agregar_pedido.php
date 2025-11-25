<?php

session_start();
$session_id= session_id();
if (isset($_POST['id'])) {$id=$_POST['id'];}
if (isset($_POST['cantidad'])) {$cantidad=$_POST['cantidad'];}
if (isset($_POST['precio_compra'])) {$precio_compra=$_POST['precio_compra'];}

require_once "../config/database.php";

if (!empty($id) and !empty($cantidad) and !empty($precio_compra)) {
    $insert_tmp = mysqli_query($mysqli, "INSERT INTO tmp (id_producto, cantidad_tmp, precio_tmp, session_id) 
                                        VALUES ('$id', '$cantidad', '$precio_compra', '".$session_id."')");
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $delete = mysqli_query($mysqli, "DELETE FROM tmp WHERE id_tmp='" . $id . "'");
}

?>

<table class="table table-bordered table-striped table-hover">
    <tr class="warning">
        <th>Código</th>
        <th>Tipo de Producto</th>
        <th>U. de Medida</th>
        <th>Producto</th>
        <th><span class="pull-right">Cantidad</span></th>
        <th><span class="pull-right">Precio</span></th>
        <th style="width: 36px;"></th>
    </tr>
    <?php
        $suma_total = 0;
        $sql = mysqli_query($mysqli, "SELECT * FROM producto, tmp WHERE producto.cod_producto=tmp.id_producto AND tmp.session_id='" . $session_id . "'");
        while ($row = mysqli_fetch_array($sql)) {
            $id_tmp = $row['id_tmp'];
            $codigo_producto = $row['cod_producto'];

            $tipo_producto = $row['cod_tipo_prod'];
            $t_p_descrip = mysqli_query($mysqli, "SELECT * FROM tipo_producto WHERE cod_tipo_prod = '$tipo_producto'");
            $rw_tproducto = mysqli_fetch_array($t_p_descrip);

            $unidad_medida = $row['id_u_medida'];
            $sql_umedida = mysqli_query($mysqli, "SELECT * FROM u_medida WHERE id_u_medida = '$unidad_medida'");
            $rw_umedida = mysqli_fetch_array($sql_umedida);
            $nombre_unidad_medida = $rw_umedida['u_descrip'];

            $nombre_producto = $row['p_descrip'];

            $cantidad = $row['cantidad_tmp'];

            $precio_compra = $row['precio_tmp'];
            $precio_compra_f = number_format($precio_compra, 0, ',', '.');
            $precio_compra_r = str_replace('.', '', $precio_compra_f);
            $precio_total = $precio_compra_r * $cantidad;
            $precio_total_f = number_format($precio_total, 0, ',', '.');
            $precio_total_r = str_replace('.', '', $precio_total_f);
            $suma_total += $precio_total_r;
            ?>
            <tr>
                <td><?php echo $codigo_producto; ?></td>
                <td><?php echo $rw_tproducto['t_p_descrip']; ?></td>
                <td><?php echo $rw_umedida['u_descrip']; ?></td>
                <td><?php echo $nombre_producto; ?></td>
                <td class="text-right"><?php echo $cantidad; ?></td>
                <td class="text-right"><?php echo $precio_total_f; ?></td>
                <td class="text-center">
                    <a href="#" onclick="eliminar('<?php echo $id_tmp; ?>')" class='btn btn-danger'>
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>
            </tr>
            <?php
        }
    ?>
    <tr>
        <input type="hidden" class="form-control" id="suma_total" name="suma_total" value="<?php echo $suma_total; ?>">
        <?php if(empty($codigo_producto)) {$cantidad = 0;} else {$codigo_producto;} ?>
        <input type="hidden" class="form-control" id="codigo_producto" name="codigo_producto" value="<?php echo $codigo_producto; ?>">
        <?php if(empty($cantidad)) {$cantidad = 0;} else {$cantidad;} ?>
        <input type="hidden" class="form-control" id="cantidad" value="<?php echo $cantidad; ?>">
        <td colspan="4"><span class="pull-right">Total Gs.</span></td>
        <td><strong><?php echo number_format($suma_total, 0, ',', '.'); ?></strong></td>
    </tr>
</table>