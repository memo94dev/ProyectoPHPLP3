<?php if ($_GET['form'] == 'add') { ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Agregar Usuario
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="?module=user"> Usuarios</a></li>
            <li class="active"></li>

        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/user/proses.php?act=insert" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Nombre de Usuario</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="username" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Contraseña</label>
                                    <div class="col-sm-5">
                                        <input type="password" class="form-control" name="password" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Nombre y Apellido</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="name_user" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Permisos de Acceso</label>
                                    <div class="col-sm-5">
                                        <select style="cursor: pointer;" class="form-control" name="permisos_acceso" required>
                                            <option value="" disabled selected>Seleccione una opción</option>
                                            <option value="Super Admin">Administrador</option>
                                            <option value="Compras">Compras</option>
                                            <option value="Ventas">Ventas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=user" class="btn btn-default btn-reset">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php } elseif ($_GET['form'] == 'edit') {
    if (isset($_GET['id'])) {
        $id_user = $_GET['id'];
        $query = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE id_user = '$id_user'")
            or die('Error: ' . mysqli_error($mysqli));
        $data  = mysqli_fetch_assoc($query);
    } ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Modificar Usuario
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="?module=user"> Usuarios</a></li>
            <li class="active"></li>

        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/user/proses.php?act=update" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <input type="hidden" name="id_user" value="<?php echo $data['id_user']; ?>">                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Foto de Perfil</label>
                                    <div class="col-sm-5">
                                        <?php if ($data['foto'] == "") { ?>
                                            <img style="border: 1px solid #eaeaea; border-radius: 5px" src="images/user/user-default.png" width="128" height="" alt="Foto de Perfil">
                                            <?php } else { ?>
                                                <img style="border: 1px solid #eaeaea; border-radius: 5px" src="images/user/<?php echo $data['foto']?>" width="128" alt="Foto de Perfil">
                                            <?php } ?>
                                        <br><br>
                                        <input type="file" name="foto">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Nombre de Usuario</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="username" autocomplete="off" required value="<?php echo $data['username'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Nombre y Apellido</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="name_user" autocomplete="off" required value="<?php echo $data['name_user']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Correo</label>
                                    <div class="col-sm-5">
                                        <input type="email" class="form-control" name="email" autocomplete="off" required value="<?php echo $data['email']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Telefono</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="telefono" autocomplete="off" required 
                                        value="<?php echo $data['telefono']; ?>" maxlength="12" onkeypress="return goodchars(event, '0123456789', this)">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Permisos de Acceso</label>
                                    <div class="col-sm-5">
                                        <select style="cursor: pointer;" class="form-control" name="permisos_acceso" required>
                                            <option value="" <?php if ($data['permisos_acceso'] == ""){ echo "selected"; }?> disabled>Seleccione una opción</option>
                                            <option value="Super Admin" <?php if ($data['permisos_acceso'] == "Super Admin"){ echo "selected"; }?>>Administrador</option>
                                            <option value="Compras" <?php if ($data['permisos_acceso'] == "Compras"){ echo "selected"; }?>>Compras</option>
                                            <option value="Ventas" <?php if ($data['permisos_acceso'] == "Ventas"){ echo "selected"; }?>>Ventas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=user" class="btn btn-default btn-reset">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php } ?>