<!-- Insertar Usuarios -->
<?php if ($_GET['form'] == 'add') { ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Agregar Tipo de Producto
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="?module=tipo_producto"> Tipo de Producto</a></li>
            <li class="active">Agregar</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/tipo_producto/proses.php?act=insert" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php  // consulta para obtener el siguiente id_departamento
                                $query_id = mysqli_query($mysqli, "SELECT MAX(cod_tipo_prod) as id FROM tipo_producto")
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
                                        <input type="text" class="form-control" name="cod_tipo_prod" value="<?php echo $codigo?>" readonly>
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Descripción</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="t_p_descrip" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>                            
                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=tipo_producto" class="btn btn-default btn-reset">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<!-- Editar Departamento -->
<?php } elseif ($_GET['form'] == 'edit') {
    if (isset($_GET['id'])) {
        $cod_tipo_prod = $_GET['id'];
        $query = mysqli_query($mysqli, "SELECT * FROM tipo_producto WHERE cod_tipo_prod = '$cod_tipo_prod'")
            or die('Error: ' . mysqli_error($mysqli));
        $data  = mysqli_fetch_assoc($query);
    } ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Modificar Tipo de Producto
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="?module=tipo_producto"> Tipo de Producto</a></li>
            <li class="active">Modificar</li>

        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/tipo_producto/proses.php?act=edit" method="POST" enctype="multipart/form-data">
                        <div class="box-body">                       
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Codigo</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="cod_tipo_prod" value="<?php echo $data['cod_tipo_prod']?>" readonly>
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Descripción</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="t_p_descrip" autocomplete="off" required 
                                        value="<?php echo $data['t_p_descrip']?>">
                                    </div>
                                </div>
                            </div>                            
                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=tipo_producto" class="btn btn-default btn-reset">Cancelar</a>
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