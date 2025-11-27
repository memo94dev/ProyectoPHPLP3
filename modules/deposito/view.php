<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=deposito">Deposito</a></li>
    </ol>
    <br><br>
    <h1>
        <i class="fa fa-folder icon-title"></i> Datos de los Depositos
        <a href="?module=form_deposito&form=add" class="btn btn-primary btn-social pull-right" title="Agregar" data-toggle="tooltip">
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
                        <a class="btn btn-warning btn-social pull-right" href="modules/deposito/print.php" 
                        target="_blank" title="Imprimir tabla"><i class="fa fa-print"></i> Imprimir</a>
                    </section>
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de Deposito</h2>
                        <thead>
                            <tr>
                                <th class="center">Código.</th>
                                <th class="center">Descripción</th>
                                <th class="center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($mysqli, "SELECT * FROM deposito ORDER BY cod_deposito ASC")
                                or die('Error: ' . mysqli_error($mysqli));
                            while ($data = mysqli_fetch_assoc($query)) {
                                $cod_deposito = $data['cod_deposito'];
                                $descrip = $data['descrip'];
                                echo "<tr>
                                      <td class='center'>$cod_deposito</td>
                                      <td class='center'>$descrip</td>
                                      <td class='center' width='100'>
                                      <div><a data-toggle='tooltip' data-placement='top' title='Editar' class='btn btn-primary btn-sm' 
                                           href='?module=form_deposito&form=edit&id=$cod_deposito'>
                                           <i class='glyphicon glyphicon-edit'></i>
                                           </a>"; ?>
                                           <a href="modules/deposito/proses.php?act=delete&cod_deposito=<?php echo $cod_deposito; ?>" 
                                           data-toggle="tooltip" data-data-placement="top" title="Eliminar Datos" 
                                           class="btn btn-danger btn-sm" onclick="return confirm('¿Estas seguro/a de eliminar <?php echo $descrip; ?>?')">
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