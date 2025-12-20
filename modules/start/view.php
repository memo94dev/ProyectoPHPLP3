<?php if ($_SESSION['permisos_acceso'] == '1') { ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-home icon-tittle"></i>Inicio
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info-circle"></i> Bienvenido/a <strong><?php echo $_SESSION['name_user']; ?></strong>!</h4>
                    Esta es su área de trabajo, aquí podrá administrar todo el contenido del sistema. <strong>SysWeb</strong>
                </div>
            </div>
        </div>

        <h2>Formulario de movimientos</h2>
        <div class="row">

            <!-- Bloque Pedido Compras -->

            <?php include("templates/ref_pedidos_compras.php"); ?>

            <!-- Bloque Compras -->

            <?php include("templates/ref_movi_compras.php"); ?>

            <!-- Bloque Ventas -->

            <?php include("templates/ref_movi_ventas.php"); ?>

            <!-- Bloque Stock -->

            <?php include("templates/ref_movi_stock.php"); ?>

            <div class="col-xl-4 col-lg-5">
                <div class="card no-shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"></div>
                </div>
            </div>

        </div>

    </section>

<?php } elseif ($_SESSION['permisos_acceso'] == '2') { ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-home icon-tittle"></i>Inicio
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info-circle"></i> Bienvenido/a <strong><?php echo $_SESSION['name_user']; ?></strong>!</h4>
                    Esta es su área de trabajo, aquí podrá administrar todo el contenido del sistema. <strong>SysWeb</strong>
                </div>
            </div>
        </div>

        <h2>Formulario de movimientos</h2>
        <div class="row">

            <!-- Bloque Pedido Compras -->

            <?php include("templates/ref_pedidos_compras.php"); ?>

            <!-- Bloque Compras -->

            <?php include("templates/ref_movi_compras.php"); ?>

            <!-- Bloque Stock -->

            <?php include("templates/ref_movi_stock.php"); ?>

            <div class="col-xl-4 col-lg-5">
                <div class="card no-shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"></div>
                </div>
            </div>

        </div>

    </section>

<?php } elseif ($_SESSION['permisos_acceso'] == '3') { ?>

    <section class="content-header">
        <h1>
            <i class="fa fa-home icon-tittle"></i>Inicio
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i> Inicio</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info-circle"></i> Bienvenido/a <strong><?php echo $_SESSION['name_user']; ?></strong>!</h4>
                    Esta es su área de trabajo, aquí podrá administrar todo el contenido del sistema. <strong>SysWeb</strong>
                </div>
            </div>
        </div>

        <h2>Formulario de movimientos</h2>
        <div class="row">

            <!-- Bloque Ventas -->

            <?php include("templates/ref_movi_ventas.php"); ?>

            <!-- Bloque Stock -->

            <?php include("templates/ref_movi_stock.php"); ?>

            <div class="col-xl-4 col-lg-5">
                <div class="card no-shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"></div>
                </div>
            </div>

        </div>

    </section>
<?php } ?>