<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=ciudad">Ciudad</a></li>
    </ol>
    <br><br>
    <h1>
        <i class="fa fa-folder icon-title"></i> Datos de Ciudad
        <a href="?module=form_ciudad&form=add" class="btn btn-primary btn-social pull-right" title="Agregar" data-toggle="tooltip">
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
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <h2>Lista de Ciudades</h2>
                        <thead>
                            <tr>
                                <th class="center">Código.</th>
                                <th class="center">Descripción</th>
                                <th class="center">Departamento</th>
                                <th class="center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($mysqli, "SELECT c.cod_ciudad, c.descrip_ciudad, d.id_departamento, d.dep_descripcion
                                                            FROM ciudad c   
                                                            JOIN departamento d ON c.id_departamento = d.id_departamento 
                                                            ORDER BY c.cod_ciudad ASC")
                                or die('Error: ' . mysqli_error($mysqli));
                            while ($data = mysqli_fetch_assoc($query)) {
                                $id_ciudad = $data['cod_ciudad'];
                                $ciu_descripcion = $data['descrip_ciudad'];
                                $dep_descripcion = $data['dep_descripcion'];
                                echo "<tr>
                                      <td class='center'>$id_ciudad</td>
                                      <td class='center'>$ciu_descripcion</td>
                                      <td class='center'>$dep_descripcion</td>
                                      <td class='center' width='100'>
                                      <div><a data-toggle='tooltip' data-placement='top' title='Editar' class='btn btn-primary btn-sm' 
                                           href='?module=form_ciudad&form=edit&id=$id_ciudad'>
                                           <i class='glyphicon glyphicon-edit'></i>
                                           </a>"; ?>
                                <a href="modules/ciudad/proses.php?act=delete&cod_ciudad=<?php echo $id_ciudad; ?>"
                                    data-toggle="tooltip" data-data-placement="top" title="Eliminar Datos"
                                    class="btn btn-danger btn-sm" onclick="return confirm('¿Estas seguro/a de eliminar <?php echo $ciu_descripcion; ?>?')">
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