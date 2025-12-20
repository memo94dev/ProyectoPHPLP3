<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=pedidos_compras">Pedido de Compras</a></li>
    </ol>
    <br><br>
    <h1>
        <i class="fa fa-folder icon-title"></i> Historial de Pedidos de Compras
        <a href="?module=form_pedidos_compras&form=add" class="btn btn-primary btn-social pull-right" title="Agregar" data-toggle="tooltip">
            <i class="fa fa-plus"></i>Agregar
        </a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (empty($_GET['alert'])) {
                echo "";
            } elseif ($_GET['alert'] == 1) {
                echo "<div class='alert alert-success alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-check-circle'></i> Exito!</h4>
                            Datos registrados correctamente.
                          </div>";
            } elseif ($_GET['alert'] == 2) {
                echo "<div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-check-circle'></i> Exito!</h4>
                            El pedido de compra se ha Anulado correctamente.
                          </div>";
                          } elseif ($_GET['alert'] == 3) {
                echo "<div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-check-circle'></i> Error!</h4>
                            No se pudo realizar la acción.
                          </div>";
            } ?>

            <!-- Aplicación de DataTables -->
            <div class="box box-primary">
                <div class="box-body">
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de Pedidos de Compras</h2>
                        <thead>
                            <tr>
                                <th class="center">ID.</th>
                                <th class="center">Proveedor</th>
                                <th class="center">Fecha</th>
                                <th class="center">Estado</th>
                                <th class="center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($mysqli, "SELECT * FROM v_pedidos_compra")
                                or die('Error: ' . mysqli_error($mysqli));
                            while ($data = mysqli_fetch_assoc($query)) {
                                $id_pedido = $data['id_pedido'];
                                $cod_proveedor = $data['cod_proveedor'];
                                $razon_social = $data['razon_social'];
                                $estado = $data['estado_compra_descrip'];
                                $fecha = $data['fecha'];
                                $fecha_formatted = date('d-m-Y', strtotime($fecha));
                                echo "<tr>
                                      <td class='center'>$id_pedido</td>
                                      <td class='center'>$razon_social</td>
                                      <td class='center'>$estado</td>
                                      <td class='center'>$fecha_formatted</td>
                                      <td class='center' width='100'>
                                      <div>"; ?>
                                <a target="_blank" data-toggle='tooltip' data-placement='top' title='Imprimir' class='btn btn-warning btn-sm'
                                    href="modules/pedidos_compras/print.php?act=print&id_pedido=<?php echo $id_pedido; ?>">
                                    <i class='glyphicon glyphicon-print'></i>
                                </a>
                                <a href="modules/pedidos_compras/proses.php?act=rechazar&id_pedido=<?php echo $id_pedido; ?>"
                                    data-toggle="tooltip" data-data-placement="top" title="Rechazar Pedido de Compra"
                                    class="btn btn-danger btn-sm" onclick="return confirm('¿Estas seguro/a de Rechazar el Pedido Cód.: <?php echo $id_pedido; ?>?')">
                                    <i class="glyphicon glyphicon-trash"></i></a>
                            <?php
                                echo "</div>
                                      </td>
                                      </tr>";
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>