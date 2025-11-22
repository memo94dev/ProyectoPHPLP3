<?php if ($_SESSION['permisos_acceso'] == 'Super Admin') { ?>

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

        <h2>Formulario de movimiento</h2>
        <div class="row">

            <!-- Bloque Compras -->

            <div class="col-lg-4 col-xs-6">
                <div style="background-color: #00c0ef;" class="small-box">
                    <div class="inner">
                        <p><strong>Compras</strong>
                        <ul>
                            <li>Registrar</li>
                            <li>la compra</li>
                            <li>del producto</li>
                        </ul>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="glyphicon glyphicon-piggy-bank"></i>
                    </div>
                    <a href="?modules=compras" class="small-box-footer" title="Registrar Compras" data-toggle="tooltip">
                        <i class="fa fa-plus"></i></a>
                </div>
            </div>

            <!-- Bloque Ventas -->

            <div class="col-lg-4 col-xs-6">
                <div style="background-color: #00a65a;" class="small-box">
                    <div class="inner">
                        <p><strong>Ventas</strong>
                        <ul>
                            <li>Registrar</li>
                            <li>Ventas</li>
                            <li>de productos</li>
                        </ul>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cart-plus"></i>
                    </div>
                    <a href="?modules=ventas" class="small-box-footer" title="Registrar Ventas" data-toggle="tooltip">
                        <i class="fa fa-plus"></i></a>
                </div>
            </div>

            <!-- Bloque Stock -->

            <div class="col-lg-4 col-xs-6">
                <div style="background-color: #f39c12;" class="small-box">
                    <div class="inner">
                        <p><strong>Stock</strong>
                        <ul>
                            <li>Visualizar</li>
                            <li>Stock</li>
                            <li>de productos</li>
                        </ul>
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-area-chart"></i>
                    </div>
                    <a href="?modules=stock" class="small-box-footer" title="Visualizar Stock" data-toggle="tooltip">
                        <i class="fa fa-plus"></i></a>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="card no-shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"></div>
                </div>
            </div>

        </div>

    </section>

<?php } ?>