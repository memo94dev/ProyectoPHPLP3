<!-- Insertar nueva Compra -->
<?php if ($_GET['form'] == 'add') { ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title"></i> Cargar Pedido de Compras
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="?module=pedidos_compras">Pedido de Compras</a></li>
            <li class="active">Agregar</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/pedidos_compras/proses.php?act=insert" method="POST">
                        <div class="box-body">
                            <?php  // consulta para obtener el siguiente codigo de ciudad
                            $query_id = mysqli_query($mysqli, "SELECT MAX(id_pedido) as id FROM pedidos_compra")
                                or die('Error : ' . mysqli_error($mysqli));
                            $count = mysqli_num_rows($query_id);
                            if ($count <> 0) {
                                $data_id = mysqli_fetch_assoc($query_id);
                                $id_pedido = $data_id['id'] + 1;
                            } else {
                                $id_pedido = 1;
                            }
                            ?>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">ID</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="id_pedido" value="<?php echo $id_pedido ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Fecha</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control date-picker" name="fecha"
                                            date-date-format="dd-mm-yyyy" placeholder="Ingrese la fecha"
                                            value="<?php echo date("y-m-d") ?>" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Hora</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control date-picker" name="hora"
                                            date-date-format="dd-mm-yyyy" autocomplete="off"
                                            value="<?php 
                                                date_default_timezone_set("America/Asuncion");
                                                echo date("H:i:s"); ?>" 
                                            required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Proveedror</label>
                                    <div class="col-sm-5">
                                        <select required class="chosen-select" data-placeholder="Seleccione un proveedor" autocomplete="off" name="cod_proveedor" id="">
                                            <option value=""></option>
                                            <?php
                                            $query_prov = mysqli_query($mysqli, "SELECT cod_proveedor, razon_social, ruc 
                                                                                FROM proveedor ORDER BY cod_proveedor ASC")
                                                or die('Error: ' . mysqli_error($mysqli));
                                            while ($data_prov = mysqli_fetch_assoc($query_prov)) {
                                                echo "<option value=\"$data_prov[cod_proveedor]\"> $data_prov[razon_social] - $data_prov[ruc]</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">N de Factura</label>
                                    <div class="col-sm-3">
                                        <input maxlength="12" onkeypress="return goodchars(event, '0123456789-', this)" type="text" class="form-control" name="nro_factura" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Deposito</label>
                                    <div class="col-sm-5">
                                        <select required class="chosen-select" data-placeholder="Seleccione un proveedor" autocomplete="off" name="cod_deposito" id="">
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
                                </div>
                            </div> -->
                            <hr>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <label class="col-sm-2 control-label">Productos</label>
                                    <div class="col-sm-3">
                                        <button class="btn btn-info" data-toggle="modal" type="button"
                                            data-target="#myModal">
                                            <span class="glyphicon glyphicon-plus">Agregar Productos</span></button>
                                    </div>
                                </div>
                            </div>
                            <div id="resultados" class='col-md-9'>
                                <!-- Carga los datos ajax -->
                            </div>
                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                        <a href="?module=pedidos_compras" class="btn btn-default btn-reset">Cancelar</a>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>

<script>
    // $(document).ready(function() {
    //     load(1);
    // });

    $(document).ready(function() {
        // Carga inicial
        load(1);

        // Cuando el modal ya está completamente visible
        $('#myModal').on('shown.bs.modal', function() {
            $('#x').focus(); // aquí sí es seguro dar foco al input
        });
    });

    function load(page) {
        var x = $("#x").val();
        var parametros = {
            "action": "ajax",
            "page": page,
            "x": x
        };
        $("#loader").fadeIn('slow');
        $.ajax({
            url: './ajax/productos_pedidos.php',
            data: parametros,
            beforeSend: function(objeto) {
                $('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
            },
            success: function(data) {
                $(".outer_div").html(data).fadeIn('slow');
                $('#loader').html(''); // limpia el loader img
            }
        })

    };
</script>
<script>
    function agregar(id) {
        var precio_compra = $('#precio_compra_' + id).val();
        var cantidad = $('#cantidad_' + id).val();
        console.log("precio:" + precio_compra);
        console.log("cantidad:" + cantidad);

        //Inicia validacion
        if (isNaN(cantidad)) {
            alert('Esto no es un numero');
            document.getElementById('cantidad_' + id).focus();
            return false;
        }
        if (isNaN(precio_compra)) {
            alert('Esto no es un numero');
            document.getElementById('precio_compra_' + id).focus();
            return false;
        }
        //Fin validacion
        $parametros = {
            "id": id,
            "precio_compra": precio_compra,
            "cantidad": cantidad
        };

        $.ajax({
            type: "POST",
            url: "./ajax/agregar_pedido.php",
            data: $parametros,
            beforeSend: function(objeto) {
                $("#resultados").html("Mensaje: Cargando...");
            },
            success: function(datos) {
                $("#resultados").html(datos);
            }
        });
    }

    function eliminar(id) {
        $.ajax({
            type: "GET",
            url: "./ajax/agregar_pedido.php",
            data: "id=" + id,
            beforeSend: function(objeto) {
                $("#resultados").html("Mensaje: Cargando...");
            },
            success: function(datos) {
                $("#resultados").html(datos);
            }
        });
    }
</script>

<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Buscar Productos</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="">
                    <div class="form-group">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="x" placeholder="Buscar por nombre o codigo" onkeyup="load(1);">
                        </div>
                        <button type="button" class="btn btn-default" onclick="load(1);">
                            <span class="glyphicon glyphicon-search">Buscar</span>
                        </button>
                    </div>
                </form>
                <div id="loader" style="position: absolute; text-align: center; top: 55px; width: 100%; display:none"></div>
                <div class="outer_div">
                    <!-- datos por ajax -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>

</div>