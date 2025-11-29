<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active"><a href="?module=stock">Stock</a></li>
    </ol>
    <br><br>
    <h1>
        <i class="fa fa-folder icon-title"></i> Stock de Productos
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Aplicación de DataTables -->
            <div class="box box-primary">
                <div class="box-body">
                    <!-- Filtro por Deposito -->
                    <form role="form" class="form-horizontal" method="POST">
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <label class="col-sm-2 control-label">Deposito</label>
                                <div class="col-sm-5">
                                    <select required class="form-control chosen-select" data-placeholder="Seleccione un proveedor" autocomplete="off" name="cod_deposito" id="">
                                        <option value=""></option>
                                        <?php
                                        $query_dep = mysqli_query($mysqli, "SELECT cod_deposito, descrip 
                                                                                FROM deposito ORDER BY cod_deposito ASC")
                                            or die('Error: ' . mysqli_error($mysqli));
                                        while ($data_dep = mysqli_fetch_assoc($query_dep)) {
                                            echo "<option value=\"$data_dep[cod_deposito]\"> $data_dep[descrip]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-3"> <!-- Verificar ubicacion en linea,se desborda -->
                                    <button style="width: 180px" type="submit" class="btn btn-primary btn-social btn-submit">
                                        <i class="fa fa-file-text-o ico-title"></i>Buscar Deposito
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <?php                        
                        if (!empty($_POST['cod_deposito'])) {
                            $cod_deposito = $_POST['cod_deposito'];
                        }else{
                            $cod_deposito = 1;
                        }
                        $query = mysqli_query($mysqli, "SELECT * FROM deposito WHERE cod_deposito = $cod_deposito")
                                or die('Error: ' . mysqli_error($mysqli));
                            while ($data = mysqli_fetch_assoc($query)) {
                                $descrip = $data['descrip'];
                            }                        
                        ?>
                        <h2>Stock de Productos: <?= $descrip ?></h2>
                        <thead>
                            <tr>
                                <th class="center">Deposito</th>
                                <th class="center">T. de Producto</th>
                                <th class="center">U. de Medida</th>
                                <th class="center">Producto</th>
                                <th class="center">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = mysqli_query($mysqli, "SELECT * FROM v_stock WHERE cod_deposito = $cod_deposito")
                                or die('Error: ' . mysqli_error($mysqli));
                            while ($data = mysqli_fetch_assoc($query)) {
                                $cod_producto = $data['cod_producto'];
                                $p_descrip = $data['p_descrip'];
                                $cod_deposito = $data['cod_deposito'];
                                $descrip = $data['descrip'];
                                $t_p_descrip = $data['t_p_descrip'];
                                $u_descrip = $data['u_descrip'];
                                $cantidad = $data['cantidad'];
                                echo "<tr>
                                      <td class='center'>$descrip</td>
                                      <td class='center'>$t_p_descrip</td>
                                      <td class='center'>$u_descrip</td>
                                      <td class='center'>$p_descrip</td>
                                      <td class='center'>$cantidad</td>
                                      </tr>";
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>