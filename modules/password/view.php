<section class="content-header">
    <h1>
        <i class="fa fa-lock icon-title"></i> Cambiar Contraseña
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active">Contraseña</li>
        <li class="active">Modificar</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php 
                if (empty($_GET['alert'])) {
                    echo "";
                }elseif ($_GET['alert'] == 1) {
                    echo "<div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-times-circle'></i> Error!</h4>
                            Error en la Contraseña.
                          </div>";
                }elseif ($_GET['alert'] == 2) {
                    echo "<div class='alert alert-warning alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-times-circle'></i> Error!</h4>
                            La contraseña actual no coincide.
                          </div>";
                }elseif ($_GET['alert'] == 3) {
                    echo "<div class='alert alert-success alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4><i class='icon fa fa-check-circle'></i> Error!</h4>
                            La nueva contraseña cambiada correctamente.
                          </div>";
                }
            ?>
            <div class="box box-primary">
                <!-- formulario para cambiar contraseña -->
                <form role="form" class="form-horizontal" method="POST" action="modules/password/proses.php" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Contraseña Actual</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="old_password" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nueva Contraseña</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="new_password" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Confirmar Nueva Contraseña</label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="confirm_new_password" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer bg-btn-action">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                <a href="?module=start" class="btn btn-default btn-reset">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>