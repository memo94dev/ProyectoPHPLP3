<?php

if (isset($_SESSION['id_user'])) {
    $query = mysqli_query($mysqli, "SELECT * FROM v_usuarios WHERE id_user = '$_SESSION[id_user]'")
    or die('Error: ' . mysqli_error($mysqli));

    $data = mysqli_fetch_assoc($query);
} ?>

<section class="content-header">
    <h1>
        <i class="fa fa-user icon-title"></i> Perfil de Usuario
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active">Perfil de Usuario</li>
    </ol>
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
                            Los datos de usuario se han actualizado correctamente.
                          </div>";
            } elseif ($_GET['alert'] == 2) {
                echo "<div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-times-circle'></i> Error!</h4>
                            Verifique el formato del archivo.
                          </div>";
            } elseif ($_GET['alert'] == 3) {
                echo "<div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-times-circle'></i> Error!</h4>
                            El archivo debe ser menor a 1MB.
                          </div>";
            } elseif ($_GET['alert'] == 4) {
                echo "<div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-times-circle'></i> Error!</h4>
                            Asegurese que el tipo del archivo sea: *.JPG *.JPEG *.PNG
                          </div>";
            }
            ?>

            <div class="box box-primary">
                <form role="form" class="form-horizontal" action="?module=form_profile" method="POST" enctype="multipart/form-data">
                    <div class="box-body">
                        <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <label class="col-sm-2 control-label">Foto de Perfil</label>
                                <div class="col-sm-5">
                                    <?php if ($data['foto'] == "") { ?>
                                        <img style="border: 1px solid #eaeaea; border-radius: 5px" src="images/user/user-default.png" width="128" height="" alt="Foto de Perfil">
                                    <?php } else { ?>
                                        <img style="border: 1px solid #eaeaea; border-radius: 5px" src="images/user/<?php echo $data['foto'] ?>" width="128" alt="Foto de Perfil">
                                    <?php } ?>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <label class="col-sm-2 control-label">Nombre de Usuario</label>
                                <div class="col-sm-5">
                                    <input disabled type="text" class="form-control" name="username" value="<?php echo $data['username']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <label class="col-sm-2 control-label">Nombre y Apellido</label>
                                <div class="col-sm-5">
                                    <input disabled type="text" class="form-control" name="name_user" value="<?php echo $data['name_user']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <label class="col-sm-2 control-label">Correo</label>
                                <div class="col-sm-5">
                                    <input disabled type="email" class="form-control" name="email" value="<?php echo $data['email']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <label class="col-sm-2 control-label">Telefono</label>
                                <div class="col-sm-5">
                                    <input disabled type="text" class="form-control" name="telefono"
                                        value="<?php echo $data['telefono']; ?>" maxlength="12" onkeypress="return goodchars(event, '0123456789', this)">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <label class="col-sm-2 control-label">Permisos de Acceso</label>
                                <div class="col-sm-5">
                                    <input disabled type="text" class="form-control" name="name_user" value="<?php echo $data['per_descrip']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <label class="col-sm-2 control-label">Estado de la Cuenta</label>
                                <div class="col-sm-5">
                                    <input disabled type="text" class="form-control" name="status" 
                                    value="<?php $estado = ($data['status'] != 0) ? 'Bloqueado' : 'Activo'; echo $estado;?>">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-12" style="text-align: center;">
                                    <input type="submit" class="btn btn-primary btn-submit" name="Modificar" value="Modificar">
                                    <a href="?module=start" class="btn btn-default btn-reset">Salir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>