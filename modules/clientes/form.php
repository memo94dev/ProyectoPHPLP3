<!-- Insertar Usuarios -->
<?php if ($_GET['form'] == 'add') { ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Agregar Cliente
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="?module=clientes"> Clientes</a></li>
            <li class="active">Agregar</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/clientes/proses.php?act=insert" method="POST">
                        <div class="box-body">
                            <?php  // consulta para obtener el siguiente codigo de ciudad
                            $query_id = mysqli_query($mysqli, "SELECT MAX(id_cliente) as id FROM clientes")
                                or die('Error : ' . mysqli_error($mysqli));
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
                                    <label class="col-sm-2 control-label">ID.</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="id_cliente" value="<?php echo $codigo ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Documento</label>
                                    <div class="col-sm-5">
                                        <input type="text" maxlength="10" class="form-control" name="ci_ruc" autocomplete="off"
                                            onkeypress="return goodchars(event, '0123456789-', this)" required placeholder="Ingrese su CI o RUC">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Nombre</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="cli_nombre" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Apellido</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="cli_apellido" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Dirección</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="cli_direccion" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Teléfono</label>
                                    <div class="col-sm-5">
                                        <input type="text" maxlength="10" onkeypress="return goodchars(event, '0123456789', this)"
                                            class="form-control" name="cli_telefono" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Ciudad</label>
                                    <div class="col-sm-5">
                                        <select class="chosen-select" name="cod_ciudad" autocomplete="off" data-placeholder="Seleccionar Ciudad" required>
                                            <option value=""></option>
                                            <?php
                                            $query_ciu = mysqli_query($mysqli, "SELECT c.cod_ciudad, dep.id_departamento, c.descrip_ciudad, dep.dep_descripcion
                                                                                    FROM ciudad c
                                                                                    JOIN departamento dep ON c.id_departamento = dep.id_departamento 
                                                                                    ORDER BY dep.id_departamento ASC")
                                                or die('Error: ' . mysqli_error($mysqli));
                                            while ($data_ciu = mysqli_fetch_assoc($query_ciu)) {
                                                echo "<option value=\"$data_ciu[cod_ciudad]\">$data_ciu[dep_descripcion] - $data_ciu[descrip_ciudad]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
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
                            </div>                              -->
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

    <!-- Editar Clientes -->
<?php } elseif ($_GET['form'] == 'edit') {
    if (isset($_GET['id'])) {
        $id_cliente = $_GET['id'];
        $query = mysqli_query($mysqli, "SELECT * FROM v_clientes WHERE id_cliente='$id_cliente'")
            or die('Error: ' . mysqli_error($mysqli));
        $data = mysqli_fetch_assoc($query);
    } ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Modificar Cliente
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="?module=clientes"> Clientes</a></li>
            <li class="active">Modificar</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/clientes/proses.php?act=edit" method="POST">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">ID.</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="id_cliente" value="<?php echo $data['id_cliente'] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Documento</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="ci_ruc" autocomplete="off" required
                                            value="<?php echo $data['ci_ruc'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Nombre</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="cli_nombre" autocomplete="off" required
                                            value="<?php echo $data['cli_nombre'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Apellido</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="cli_apellido" autocomplete="off" required
                                            value="<?php echo $data['cli_apellido'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Dirección</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="cli_direccion" autocomplete="off" required
                                            value="<?php echo $data['cli_direccion'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Telefono</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="cli_telefono" autocomplete="off" required
                                            value="<?php echo $data['cli_telefono'] ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Ciudad</label>
                                    <div class="col-sm-5">
                                        <select class="chosen-select" name="cod_ciudad" autocomplete="off" data-placeholder="Seleccionar Ciudad" required>
                                            <option value=""></option>
                                            <?php
                                            $query_ciu = mysqli_query($mysqli, "SELECT c.cod_ciudad, dep.id_departamento, c.descrip_ciudad, dep.dep_descripcion
                                            FROM ciudad c
                                            JOIN departamento dep ON c.id_departamento = dep.id_departamento 
                                            ORDER BY dep.id_departamento ASC")
                                                or die('Error: ' . mysqli_error($mysqli));

                                            while ($data_ciu = mysqli_fetch_assoc($query_ciu)) {
                                                // Aquí aplicamos la lógica del selected
                                                $selected = ($data_ciu['cod_ciudad'] == $data_dep['cod_ciudad']) ? 'selected' : '';
                                                echo "<option value=\"{$data_ciu['cod_ciudad']}\" $selected>{$data_ciu['dep_descripcion']} - {$data_ciu['descrip_ciudad']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Ciudad</label>
                                    <div class="col-sm-5">
                                        <select style="cursor: pointer;" class="form-control" name="cod_ciudad" required>
                                            <option value="" selected disabled>Seleccione la Ciudad</option>
                                            <?php
                                            $query_dep = mysqli_query($mysqli, "SELECT * FROM ciudad ORDER BY cod_ciudad ASC")
                                                or die('Error: ' . mysqli_error($mysqli));
                                            while ($data_dep = mysqli_fetch_assoc($query_dep)) {
                                                echo "<option value='" . $data_dep['cod_ciudad'] . "'";
                                                if ($data['cod_ciudad'] == $data_dep['cod_ciudad']) {
                                                    echo "selected";
                                                }
                                                echo ">" . $data_dep['descrip_ciudad'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Departamento</label>
                                    <div class="col-sm-5">
                                        <select style="cursor: pointer;" class="form-control" name="departamento" required>
                                            <option value="" selected disabled>Seleccione el Departamento</option>
                                            <?php
                                            $query_dep = mysqli_query($mysqli, "SELECT * FROM departamento WHERE id_departamento = '$id_depa' ORDER BY dep_descripcion ASC")
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
                            </div>                            -->
                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=clientes" class="btn btn-default btn-reset">Cancelar</a>
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