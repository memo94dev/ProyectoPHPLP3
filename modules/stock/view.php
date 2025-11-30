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
                            <label class="control-label">Depósito</label>
                            <select class="form-control chosen-select"
                                data-placeholder="Seleccione un depósito"
                                autocomplete="off" name="cod_deposito">
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

                        <div class="form-group">
                            <label class="control-label">Producto</label>
                            <select class="form-control chosen-select"
                                data-placeholder="Seleccione un producto"
                                autocomplete="off" name="cod_producto">
                                <option value=""></option>
                                <?php
                                $query_pro = mysqli_query($mysqli, "SELECT cod_producto, p_descrip  
                                            FROM producto ORDER BY cod_producto ASC")
                                    or die('Error: ' . mysqli_error($mysqli));
                                while ($data_pro = mysqli_fetch_assoc($query_pro)) {
                                    echo "<option value=\"$data_pro[cod_producto]\"> $data_pro[p_descrip]</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group text-center">
                            <button style="width: 100px" type="submit"
                                class="btn btn-primary btn-social btn-submit">
                                <i class="fa fa-file-text-o ico-title"></i> Filtrar
                            </button>
                        </div>
                    </form>

                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <?php
                        // $fil_cod_producto = !empty($_POST['cod_producto']) ? $_POST['cod_producto'] : '';
                        // $fil_cod_deposito = !empty($_POST['cod_deposito']) ? $_POST['cod_deposito'] : '';
                        ?>
                        <h2>Stock de Productos:</h2>
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
                            // $fil_cod_producto = $_POST['cod_producto'] ? $_POST['cod_producto'] : '';
                            // $fil_cod_deposito = $_POST['cod_deposito'] || '';
                            if (!empty($_POST['cod_deposito']) and !empty($_POST['cod_producto'])) {
                                $sql = "SELECT * FROM v_stock WHERE cod_deposito = $_POST[cod_deposito] AND cod_producto = $_POST[cod_producto]";
                            } elseif (!empty($_POST['cod_deposito']) and empty($_POST['cod_producto'])) {
                                $sql = "SELECT * FROM v_stock WHERE cod_deposito = $_POST[cod_deposito]";
                            } elseif (empty($_POST['cod_deposito']) and !empty($_POST['cod_producto'])) {
                                $sql = "SELECT * FROM v_stock WHERE cod_producto = $_POST[cod_producto]";
                            } else {
                                $sql = "SELECT * FROM v_stock";
                            }
                            $no = 1;
                            $query = mysqli_query($mysqli, $sql)
                                or die('Error: ' . mysqli_error($mysqli));
                            while ($data = mysqli_fetch_assoc($query)) {
                                $cod_producto = $data['cod_producto'];
                                $p_descrip = $data['p_descrip'];
                                $cod_deposito = $data['cod_deposito'];
                                $descrip = $data['descrip'];
                                $t_p_descrip = $data['t_p_descrip'];
                                $u_descrip = $data['u_descrip'];
                                $cantidad = $data['cantidad'];
                                echo "
                                <tr>
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