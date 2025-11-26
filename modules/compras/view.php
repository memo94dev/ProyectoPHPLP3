<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=compras">Compras</a></li>
    </ol>
    <br><br>
    <h1>
        <i class="fa fa-folder icon-title"></i> Historial de Compras
        <a href="?module=form_compras&form=add" class="btn btn-primary btn-social pull-right" title="Agregar" data-toggle="tooltip">
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
                            La compra se ha Anulado correctamente.
                          </div>";
                          } elseif ($_GET['alert'] == 3) {
                echo "<div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-check-circle'></i> Error!</h4>
                            No se pudo realizar la accion.
                          </div>";
            } ?>

            <!-- Aplicación de DataTables -->
            <div class="box box-primary">
                <div class="box-body">
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de Compras</h2>
                        <thead>
                            <tr>
                                <th class="center">ID.</th>
                                <th class="center">Proveedor</th>
                                <th class="center">Deposito</th>
                                <th class="center">Factura</th>
                                <th class="center">Fecha</th>
                                <th class="center">Hora</th>
                                <th class="center">Total</th>
                                <th class="center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($mysqli, "SELECT * FROM v_compras WHERE estado = 'activo'")
                                or die('Error: ' . mysqli_error($mysqli));
                            while ($data = mysqli_fetch_assoc($query)) {
                                $cod_compra = $data['cod_compra'];
                                $razon_social = $data['razon_social'];
                                $deposito = $data['descrip'];
                                $nro_factura = $data['nro_factura'];
                                $fecha = $data['fecha'];
                                $fecha_formatted = date('d-m-Y', strtotime($fecha));
                                $hora = $data['hora'];
                                $hora_formatted = date('H:i:s', strtotime($hora));
                                $total = $data['total_compra'];
                                $total = number_format($total, 0, ',', '.'); // Formatear el total en miles
                                echo "<tr>
                                      <td class='center'>$cod_compra</td>
                                      <td class='center'>$razon_social</td>
                                      <td class='center'>$deposito</td>
                                      <td class='center'>$nro_factura</td>
                                      <td class='center'>$fecha_formatted</td>
                                      <td class='center'>$hora_formatted</td>
                                      <td class='center'>$total</td>
                                      <td class='center' width='100'>
                                      <div>"; ?>
                                <a target="_blank" data-toggle='tooltip' data-placement='top' title='Imprimir' class='btn btn-warning btn-sm'
                                    href="modules/compras/print.php?act=print&cod_compra=<?php echo $cod_compra; ?>">
                                    <i class='glyphicon glyphicon-print'></i>
                                </a>
                                <a href="modules/compras/proses.php?act=anular&cod_compra=<?php echo $cod_compra; ?>"
                                    data-toggle="tooltip" data-data-placement="top" title="Anular Compra"
                                    class="btn btn-danger btn-sm" onclick="return confirm('¿Estas seguro/a de anular Factura N: <?php echo $nro_factura; ?>?')">
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