<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=proveedor">Proveedor</a></li>
    </ol>
    <br><br>
    <h1>
        <i class="fa fa-folder icon-title"></i> Datos de los Proveedores
        <a href="?module=form_proveedor&form=add" class="btn btn-primary btn-social pull-right" title="Agregar" data-toggle="tooltip">
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
                            Datos registrado correctamente.
                          </div>";
            } elseif ($_GET['alert'] == 2) {
                echo "<div class='alert alert-success alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-check-circle'></i> Exito!</h4>
                            Datos editados correctamente.
                          </div>";
            } elseif ($_GET['alert'] == 3) {
                echo "<div class='alert alert-success alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-check-circle'></i> Exito!</h4>
                            Datos eliminados correctamente.
                          </div>";
            } elseif ($_GET['alert'] == 4) {
                echo "<div class='alert alert-warning alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-check-circle'></i> Exito!</h4>
                            No se puede realizar la operación.
                          </div>";
            }?>

            <!-- Aplicación de DataTables -->
            <div class="box box-primary">
                <div class="box-body">
                    <section>
                        <a class="btn btn-warning btn-social pull-right" href="modules/proveedor/print.php" 
                        target="_blank" title="Imprimir tabla"><i class="fa fa-print"></i> Imprimir</a>
                    </section>
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de Proveedores</h2>
                        <thead>
                            <tr>
                                <th class="center">Código.</th>
                                <th class="center">Razon Social</th>
                                <th class="center">RUC</th>
                                <th class="center">Direccion</th>
                                <th class="center">Telefono</th>
                                <th class="center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($mysqli, "SELECT * FROM proveedor ORDER BY cod_proveedor ASC")
                                or die('Error: ' . mysqli_error($mysqli));
                            while ($data = mysqli_fetch_assoc($query)) {
                                $cod_proveedor = $data['cod_proveedor'];
                                $razon_social = $data['razon_social'];
                                $ruc = $data['ruc'];
                                $direccion = $data['direccion'];
                                $telefono = str_pad($data['telefono'], 10, '0', STR_PAD_LEFT);
                                echo "<tr>
                                      <td class='center'>$cod_proveedor</td>
                                      <td class='center'>$razon_social</td>
                                      <td class='center'>$ruc</td>
                                      <td class='center'>$direccion</td>
                                      <td class='center'>$telefono</td>
                                      <td class='center' width='100'>
                                      <div><a data-toggle='tooltip' data-placement='top' title='Editar' class='btn btn-primary btn-sm' 
                                           href='?module=form_proveedor&form=edit&id=$cod_proveedor'>
                                           <i class='glyphicon glyphicon-edit'></i>
                                           </a>"; ?>
                                           <a href="modules/proveedor/proses.php?act=delete&cod_proveedor=<?php echo $cod_proveedor; ?>" 
                                           data-toggle="tooltip" data-data-placement="top" title="Eliminar Datos" 
                                           class="btn btn-danger btn-sm" onclick="return confirm('¿Estas seguro/a de eliminar <?php echo $razon_social . ' - ' . $ruc; ?>?')">
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