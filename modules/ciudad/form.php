<!-- Insertar Usuarios -->
<?php if ($_GET['form'] == 'add') { ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Agregar Ciudad
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="?module=ciudad"> Ciudad</a></li>
            <li class="active">Agregar</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/ciudad/proses.php?act=insert" method="POST">
                        <div class="box-body">
                            <?php  // consulta para obtener el siguiente codigo de ciudad
                                $query_id = mysqli_query($mysqli, "SELECT MAX(cod_ciudad) as id FROM ciudad")
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
                                        <input type="text" class="form-control" name="cod_ciudad" value="<?php echo $codigo?>" readonly>
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Nombre de la Ciudad</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="descrip_ciudad" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>      
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Departamento</label>
                                    <div class="col-sm-5">
                                        <select style="cursor: pointer;" class="form-control" name="departamento" required>
                                            <option value="" selected disabled>Seleccione el Departamento</option>
                                            <?php
                                                $query_dep = mysqli_query($mysqli, "SELECT * FROM departamento ORDER BY dep_descripcion ASC")
                                                    or die('Error: ' . mysqli_error($mysqli));
                                                while ($data_dep = mysqli_fetch_assoc($query_dep)) {
                                                    echo "<option value='" . $data_dep['id_departamento'] . "'" 
                                                    . ($data_dep['id_departamento'] == $data['id_departamento'] ? "selected" : "") 
                                                    . ">" . $data_dep['dep_descripcion'] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>                             
                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=ciudad" class="btn btn-default btn-reset">Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<!-- Editar ciudad -->
<?php } elseif ($_GET['form'] == 'edit') {
    if (isset($_GET['id'])) {
        $id_ciudad = $_GET['id'];
        $query = mysqli_query($mysqli, "SELECT c.cod_ciudad, c.descrip_ciudad, d.id_departamento, d.dep_descripcion
                                        FROM ciudad c   
                                        JOIN departamento d ON c.id_departamento = d.id_departamento
                                        WHERE c.cod_ciudad = '$id_ciudad'")
            or die('Error: ' . mysqli_error($mysqli));
        $data = mysqli_fetch_assoc($query);
    } ?>
    
    <?php /*
    header("Content-Type: application/json");
    $datal = array(
        'cod_ciudad' => $data['cod_ciudad'],
        'descrip_ciudad' => $data['descrip_ciudad'],
        'id_departamento' => $data['id_departamento'],
        'dep_descripcion' => $data['dep_descripcion']
    );
    echo json_encode($datal);*/
    ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Modificar Ciudad
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="?module=ciudad"> Ciudad</a></li>
            <li class="active">Modificar</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/ciudad/proses.php?act=edit" method="POST">
                        <div class="box-body">                       
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Codigo</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="cod_ciudad" value="<?php echo $data['cod_ciudad']?>" readonly>
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Ciudad</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="descrip_ciudad" autocomplete="off" required 
                                        value="<?php echo $data['descrip_ciudad']?>">
                                    </div>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Departamento</label>
                                    <div class="col-sm-5">
                                        <select style="cursor: pointer;" class="form-control" name="departamento" required>
                                            <option value="" selected disabled>Seleccione el Departamento</option>
                                            <?php
                                                $query_dep = mysqli_query($mysqli, "SELECT * FROM departamento ORDER BY dep_descripcion ASC")
                                                    or die('Error: ' . mysqli_error($mysqli));
                                                while ($data_dep = mysqli_fetch_assoc($query_dep)) {
                                                    echo "<option value='" . $data_dep['id_departamento'] . "'";
                                                    if ($data['id_departamento'] == $data_dep['id_departamento']) {
                                                        echo "selected";
                                                    }
                                                    echo ">" . $data_dep['dep_descripcion'] . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>                           
                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=ciudad" class="btn btn-default btn-reset">Cancelar</a>
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