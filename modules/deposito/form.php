<!-- Insertar Usuarios -->
<?php if ($_GET['form'] == 'add') { ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Agregar Deposito
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="?module=deposito"> Deposito</a></li>
            <li class="active">Agregar</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/deposito/proses.php?act=insert" method="POST" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php  // consulta para obtener el siguiente id_departamento
                                $query_id = mysqli_query($mysqli, "SELECT MAX(cod_deposito) as id FROM deposito")
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
                                        <input type="text" class="form-control" name="cod_deposito" value="<?php echo $codigo?>" readonly>
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Descripción</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="descrip" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>                            
                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=deposito" class="btn btn-default btn-reset">Cancelar</a>
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
        $cod_deposito = $_GET['id'];
        $query = mysqli_query($mysqli, "SELECT * FROM deposito WHERE cod_deposito = '$cod_deposito'")
            or die('Error: ' . mysqli_error($mysqli));
        $data  = mysqli_fetch_assoc($query);
    } ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Modificar Deposito
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="?module=deposito"> Deposito</a></li>
            <li class="active">Modificar</li>

        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/deposito/proses.php?act=edit" method="POST" enctype="multipart/form-data">
                        <div class="box-body">                       
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Codigo</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="cod_deposito" value="<?php echo $data['cod_deposito']?>" readonly>
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Descripción</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="descrip" autocomplete="off" required 
                                        value="<?php echo $data['descrip']?>">
                                    </div>
                                </div>
                            </div>                            
                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=deposito" class="btn btn-default btn-reset">Cancelar</a>
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