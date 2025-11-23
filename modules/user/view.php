<section class="content-header">
    <h1>
        <i class="fa fa-users icon-title"></i> Usuarios
        <a href="?module=form&form=add" class="btn btn-primary btn-social pull-right" title="Agregar" data-toggle="tooltip">
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
                            El nuevo usuario fue registrado correctamente.
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
                            El usuario ha sido activado correctamente.
                          </div>";
            } elseif ($_GET['alert'] == 4) {
                echo "<div class='alert alert-warning alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-check-circle'></i> Exito!</h4>
                            El usuario ha sido bloqueado correctamente.
                          </div>";
            } elseif ($_GET['alert'] == 5) {
                echo "<div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-times-circle'></i> Error!</h4>
                            Verifique el formato del archivo.
                          </div>";
            } elseif ($_GET['alert'] == 6) {
                echo "<div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-times-circle'></i> Error!</h4>
                            El archivo debe ser menor a 1MB.
                          </div>";
            } elseif ($_GET['alert'] == 7) {
                echo "<div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-times-circle'></i> Error!</h4>
                            Asegurese que el tipo del archivo sea: *.JPG *.JPEG *.PNG
                          </div>";
            }
            ?>

            <!-- Aplicación de DataTables -->
            <div class="box box-primary">
                <div class="box-body">
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="center">Nro.</th>
                                <th class="center">Foto</th>
                                <th class="center">Usuario</th>
                                <th class="center">Nombre Completo</th>
                                <th class="center">Permisos de Acceso</th>
                                <th class="center">Status</th>
                                <th class="center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($mysqli, "SELECT * FROM usuarios ORDER BY username ASC")
                                or die('Error: ' . mysqli_error($mysqli));
                            while ($data = mysqli_fetch_assoc($query)) {
                                echo "<tr>
                                    <td width='50' class='center'>$no</td>";
                                if ($data['foto'] == "") { ?>
                                    <td class="center">
                                        <img class="img-user" src="images/user/user-default.png" width="45">
                                    </td>
                                <?php } else { ?>
                                    <td class="center">
                                        <img class="img-user" src="images/user/<?php echo $data['foto']; ?>" width="45">
                                    </td>
                                <?php }
                                echo "<td class='center'>$data[username]</td>
                                      <td class='center'>$data[name_user]</td>
                                      <td class='center'>$data[permisos_acceso]</td>
                                      <td class='center'>$data[status]</td>
                                      <td class='center' width='100'>
                                      <div>";
                                if ($data['status'] == 'activo') { ?>
                                    <a data-toggle="tooltip" data-placement="top" title="Bloquear" style="margin-right:5px"
                                        class="btn btn-danger btn-sm" href="modules/user/proses.php?act=off&id=<?php echo $data['id_user']; ?>"
                                        onclick="return confirm('Estas seguro de bloquear a <?php echo $data['name_user']; ?> ?');">
                                        <i class="glyphicon glyphicon-off"></i>
                                    </a>
                                <?php } else { ?>
                                    <a data-toggle="tooltip" data-placement="top" title="Activar" style="margin-right:5px"
                                        class="btn btn-success btn-sm" href="modules/user/proses.php?act=on&id=<?php echo $data['id_user']; ?>"
                                        onclick="return confirm('Estas seguro de activar a <?php echo $data['name_user']; ?> ?');">
                                        <i class="glyphicon glyphicon-ok-circle"></i>
                                    </a>

                            <?php }

                                echo "<a data-toggle='tooltip' data-placement='top' title='Editar' class='btn btn-primary btn-sm' 
                                href='?module=form&form=edit&id=$data[id_user]'>
                                        <i class='glyphicon glyphicon-edit'></i>
                                      </a>
                                    </div>
                                    </td>
                                </tr>";
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>