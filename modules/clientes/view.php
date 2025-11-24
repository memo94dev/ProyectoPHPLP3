<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=clientes">Clientes</a></li>
    </ol>
    <br><br>
    <h1>
        <i class="fa fa-folder icon-title"></i> Datos de Clientes
        <a href="?module=form_clientes&form=add" class="btn btn-primary btn-social pull-right" title="Agregar" data-toggle="tooltip">
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
            } ?>

            <!-- Aplicación de DataTables -->
            <div class="box box-primary">
                <div class="box-body">
                    <section>
                        <a class="btn btn-warning btn-social pull-right" href="modules/clientes/print.php" 
                        target="_blank" title="Imprimir tabla"><i class="fa fa-print"></i> Imprimir</a>
                    </section>
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de Clientes</h2>
                        <thead>
                            <tr>
                                <th class="center">ID.</th>
                                <th class="center">Documento</th>
                                <th class="center">Nombre</th>
                                <th class="center">Apellido</th>
                                <th class="center">Dirección</th>
                                <th class="center">Teléfono</th>
                                <th class="center">Ciudad</th>
                                <th class="center">Dpto.</th>
                                <th class="center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($mysqli, "SELECT * FROM v_clientes")
                                or die('Error: ' . mysqli_error($mysqli));
                            while ($data = mysqli_fetch_assoc($query)) {
                                $id_cliente = $data['id_cliente'];
                                $cli_documento = $data['ci_ruc'];
                                $cli_nombre = $data['cli_nombre'];
                                $cli_apellido = $data['cli_apellido'];
                                $cli_direccion = $data['cli_direccion'];
                                $cli_telefono = str_pad($data['cli_telefono'], 10, '0', STR_PAD_LEFT); // Rellenar con ceros a la izquierda
                                $ciu_descripcion = $data['descrip_ciudad'];
                                $dep_descripcion = $data['dep_descripcion'];
                                echo "<tr>
                                      <td class='center'>$id_cliente</td>
                                      <td class='center'>$cli_documento</td>
                                      <td class='center'>$cli_nombre</td>
                                      <td class='center'>$cli_apellido</td>
                                      <td class='center'>$cli_direccion</td>
                                      <td class='center'>$cli_telefono</td>
                                      <td class='center'>$ciu_descripcion</td>
                                      <td class='center'>$dep_descripcion</td>
                                      <td class='center' width='100'>
                                      <div><a data-toggle='tooltip' data-placement='top' title='Editar' class='btn btn-primary btn-sm' 
                                           href='?module=form_clientes&form=edit&id=$id_cliente'>
                                           <i class='glyphicon glyphicon-edit'></i>
                                           </a>"; ?>
                                <a href="modules/clientes/proses.php?act=delete&id_cliente=<?php echo $id_cliente; ?>"
                                    data-toggle="tooltip" data-data-placement="top" title="Eliminar Datos"
                                    class="btn btn-danger btn-sm" onclick="return confirm('¿Estas seguro/a de eliminar <?php echo $cli_nombre; ?>?')">
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