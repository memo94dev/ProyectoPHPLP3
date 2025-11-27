<!-- Insertar Productos -->
<?php if ($_GET['form'] == 'add') { ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Agregar Producto
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="?module=producto"> Producto</a></li>
            <li class="active">Agregar</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/producto/proses.php?act=insert" method="POST">
                        <div class="box-body">
                            <?php  // consulta para obtener el siguiente codigo de producto
                                $query_id = mysqli_query($mysqli, "SELECT MAX(cod_producto) as id FROM producto")
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
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="cod_producto" value="<?php echo $codigo?>" readonly>
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Tipo</label>
                                    <div class="col-sm-5">
                                        <select style="cursor: pointer;" class="form-control" name="cod_tipo_prod" required>
                                            <option value="" selected disabled>Seleccione el Tipo</option>
                                            <?php
                                                $query_tipo = mysqli_query($mysqli, "SELECT * FROM tipo_producto ORDER BY cod_tipo_prod ASC")
                                                or die('Error: ' . mysqli_error($mysqli));
                                                while ($data_tipo = mysqli_fetch_assoc($query_tipo)) {
                                                    echo "<option value='" . $data_tipo['cod_tipo_prod'] . "'"                                                 
                                                    . ">" . $data_tipo['t_p_descrip'] . "</option>";
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                            </div>                             
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Medida</label>
                                    <div class="col-sm-5">
                                        <select style="cursor: pointer;" class="form-control" name="id_u_medida" required>
                                            <option value="" selected disabled>Seleccione la Medida</option>
                                            <?php
                                                $query_med = mysqli_query($mysqli, "SELECT * FROM u_medida ORDER BY id_u_medida ASC")
                                                or die('Error: ' . mysqli_error($mysqli));
                                                while ($data_med = mysqli_fetch_assoc($query_med)) {
                                                    echo "<option value='" . $data_med['id_u_medida'] . "'"                                                 
                                                    . ">" . $data_med['u_descrip'] . "</option>";
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                            </div>                             
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Nombre del Producto</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="p_descrip" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>      
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Precio</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="precio" autocomplete="off" required
                                        maxlength="7" onkeypress="return goodchars(event, '0123456789', this)">
                                    </div>
                                </div>
                            </div>      
                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=producto" class="btn btn-default btn-reset">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<!-- Editar Producto -->
<?php } elseif ($_GET['form'] == 'edit') {
    if (isset($_GET['id'])) {
        $cod_producto = $_GET['id'];
        $query = mysqli_query($mysqli, "SELECT * FROM v_producto WHERE cod_producto = $cod_producto")
            or die('Error: ' . mysqli_error($mysqli));
        $data = mysqli_fetch_assoc($query);
    } ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Modificar Producto
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="?module=producto"> Producto</a></li>
            <li class="active">Modificar</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/producto/proses.php?act=edit" method="POST">
                        <div class="box-body">                       
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Codigo</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="cod_producto" value="<?php echo $data['cod_producto']?>" readonly>
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Tipo</label>
                                    <div class="col-sm-5">
                                        <select style="cursor: pointer;" class="form-control" name="cod_tipo_prod" required>
                                            <option value="" selected disabled>Seleccione el Tipo</option>
                                            <?php
                                                $query_tipo = mysqli_query($mysqli, "SELECT * FROM tipo_producto ORDER BY cod_tipo_prod ASC")
                                                    or die('Error: ' . mysqli_error($mysqli));
                                                while ($data_tipo = mysqli_fetch_assoc($query_tipo)) {
                                                    echo "<option value='" . $data_tipo['cod_tipo_prod'] . "'";
                                                    if ($data['cod_tipo_prod'] == $data_tipo['cod_tipo_prod']) {
                                                        echo "selected";
                                                    }
                                                    echo ">" . $data_tipo['t_p_descrip'] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>                           
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Medida</label>
                                    <div class="col-sm-5">
                                        <select style="cursor: pointer;" class="form-control" name="id_u_medida" required>
                                            <option value="" selected disabled>Seleccione la Medida</option>
                                            <?php
                                                $query_med = mysqli_query($mysqli, "SELECT * FROM u_medida ORDER BY id_u_medida ASC")
                                                or die('Error: ' . mysqli_error($mysqli));
                                                while ($data_med = mysqli_fetch_assoc($query_med)) {
                                                    echo "<option value='" . $data_med['id_u_medida'] . "'";
                                                    if ($data['id_u_medida'] == $data_med['id_u_medida']) {
                                                        echo "selected";
                                                    }                                          
                                                    echo ">" . $data_med['u_descrip'] . "</option>";
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                            </div>                             
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Nombre del Producto</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="p_descrip" autocomplete="off" required
                                        value="<?php echo $data['p_descrip']?>">
                                    </div>
                                </div>
                            </div>      
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Precio</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="precio" autocomplete="off" required
                                        maxlength="7" onkeypress="return goodchars(event, '0123456789', this)"
                                        value="<?php echo $data['precio']?>">
                                    </div>
                                </div>
                            </div>                         
                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=producto" class="btn btn-default btn-reset">Cancelar</a>
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