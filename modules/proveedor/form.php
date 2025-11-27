<!-- Insertar Usuarios -->
<?php if ($_GET['form'] == 'add') { ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Agregar Proveedor
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="?module=proveedor"> Proveedor</a></li>
            <li class="active">Agregar</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/proveedor/proses.php?act=insert" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php  // consulta para obtener el siguiente id_departamento
                                $query_id = mysqli_query($mysqli, "SELECT MAX(cod_proveedor) as id FROM proveedor")
                                                            or die('Error : '.mysqli_error($mysqli));
                                $count = mysqli_num_rows($query_id);
                                if ($count <> 0) {
                                    $data_id = mysqli_fetch_assoc($query_id);
                                    $codigo = $data_id['id'] + 1;
                                } else {
                                    $codigo = 1;
                                }
                            ?>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Codigo</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="cod_proveedor" value="<?php echo $codigo?>" readonly>
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Razon Social</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="razon_social" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">RUC</label>
                                    <div class="col-sm-5">
                                        <input type="text" maxlength="9" onkeypress="return goodchars(event, '0123456789-', this)"
                                            class="form-control" name="ruc" autocomplete="off">
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Dirección</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="direccion" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Teléfono</label>
                                    <div class="col-sm-5">
                                        <input type="text" maxlength="10" onkeypress="return goodchars(event, '0123456789', this)"
                                            class="form-control" name="telefono" autocomplete="off">
                                    </div>
                                </div>
                            </div>                            
                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=proveedor" class="btn btn-default btn-reset">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<!-- Editar Proveedor -->
<?php } elseif ($_GET['form'] == 'edit') {
    if (isset($_GET['id'])) {
        $cod_proveedor = $_GET['id'];
        $query = mysqli_query($mysqli, "SELECT * FROM proveedor WHERE cod_proveedor = '$cod_proveedor'")
            or die('Error: ' . mysqli_error($mysqli));
        $data  = mysqli_fetch_assoc($query);
    } ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Modificar Proveedor
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="?module=proveedor"> Proveedor</a></li>
            <li class="active">Modificar</li>

        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/proveedor/proses.php?act=edit" method="POST" enctype="multipart/form-data">
                        <div class="box-body">                       
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Codigo</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="cod_proveedor" value="<?php echo $data['cod_proveedor']?>" readonly>
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Razon Social</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="razon_social" autocomplete="off" required 
                                        value="<?php echo $data['razon_social']?>">
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">RUC</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="ruc" autocomplete="off" required 
                                        value="<?php echo $data['ruc']?>" maxlength="9" onkeypress="return goodchars(event, '0123456789-', this)">
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Direccion</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="direccion" autocomplete="off" 
                                        value="<?php echo $data['direccion']?>">
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Telefono</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="telefono" autocomplete="off" 
                                        value="<?php echo $data['telefono']?>" maxlength="10" onkeypress="return goodchars(event, '0123456789', this)">
                                    </div>
                                </div>
                            </div>                            
                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=proveedor" class="btn btn-default btn-reset">Cancelar</a>
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