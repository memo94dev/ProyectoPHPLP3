<?php

require_once "../config/database.php";

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    
    $x = mysqli_real_escape_string($mysqli, (strip_tags($_REQUEST['x'], ENT_QUOTES)));
    $aColumns = array('cod_producto', 'cod_tipo_prod', 'id_u_medida', 'p_descrip', 'precio'); // columnas de busqueda
    $sTable = "producto";
    $sWhere = "";
    if ($_GET['x'] != "") {
        $sWhere = "WHERE (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $x . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
    }
    // incluir el archivo de paginación
    include 'paginacion.php'; 
    // variables de paginación
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page = 5; //la cantidad de registros que desea mostrar
    $adjacents = 4; //brecha entre páginas después de varios adyacentes
    $offset = ($page - 1) * $per_page;
    //Contar el número total de filas en su tabla
    $count_query = mysqli_query($mysqli, "SELECT count(*) AS numrows FROM $sTable $sWhere");
    $row = mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    $total_pages = ceil($numrows / $per_page);
    // $reload = './productos_pedidos.php';
    $reload = './index.php';
    //myslisulta principal para obtener los datos
    $sql = "SELECT * FROM  $sTable $sWhere LIMIT $offset, $per_page";
    $query = mysqli_query($mysqli, $sql);
    //recorrer los datos obtenidos
    if ($numrows > 0) {
        ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>Código</th>
                <th>Tipo Producto</th>
                <th>Unidad de Medida</th>
                <th>Producto</th>
                <th><span class="pull-right">Cantidad</span></th>
                <th><span class="pull-right">Precio</span></th>
                <th style="width: 36px;">Seleccionar</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($query)) {
                $cod_producto = $row['cod_producto'];
                $pdescrip = $row['p_descrip'];

                $cod_tipo_prod = $row['cod_tipo_prod'];
                $t_p_descrip = mysqli_query($mysqli, "SELECT * FROM tipo_producto WHERE cod_tipo_prod = '$cod_tipo_prod'");
                $rw_tproducto = mysqli_fetch_array($t_p_descrip);
                $nombre_tipo_producto = $rw_tproducto['t_p_descrip'];

                $id_u_medida = $row['id_u_medida'];
                $sql_umedida = mysqli_query($mysqli, "SELECT * FROM u_medida WHERE id_u_medida = '$id_u_medida'");
                $rw_umedida = mysqli_fetch_array($sql_umedida);
                $nombre_unidad_medida = $rw_umedida['u_descrip'];

                $precio_compra = $row['precio'];
                ?>
                <tr>
                    <td><?php echo $cod_producto; ?></td>
                    <td><?php echo $pdescrip; ?></td>
                    <td><?php echo $nombre_unidad_medida; ?></td>
                    <td><?php echo $nombre_tipo_producto; ?></td>
                    <td class="col-xs-1">
                        <input type="text" class="form-control" style="text-align:right" id="cantidad_<?php echo $cod_producto; ?>" value="1" >
                    </td>
                    <td class="col-xs-2">
                        <input type="text" class="form-control" style="text-align:right" id="precio_compra_<?php echo $cod_producto; ?>" value="<?php echo $precio_compra; ?>" >
                    </td>
                    <td>
                        <span class="pull-right">
                        <a class='btn btn-info' href="#" onclick="agregar('<?php echo $cod_producto; ?>')">
                            <i class="glyphicon glyphicon-plus"></i></a>   
                        </span>                     
                    </td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="5"><span class="pull-right">
                    <?php echo paginate($reload, $page, $total_pages, $adjacents); ?>
                </span></td>
            </tr>
            </table>
        </div>
    
        <?php 
    }
}
?>