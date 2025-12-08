<?php

// Sidebar menu para niveles de usuario Super Admin
if (($_SESSION['permisos_acceso'] == 1))  { ?>
    <ul class="sidebar-menu">
        <li class="header">Menu</li>
        <?php
        if ($_GET['module'] == 'start') {
            $active_home = 'active';
        } else {
            $active_home = '';
        }
        ?>
        <li class="<?php echo $active_home; ?>">
            <a href="?module=start"><i class="fa fa-home"></i>Inicio</a>
        </li>

        <?php include("templates/generales.php"); ?>
        <?php include("templates/compra.php"); ?>
        <?php include("templates/venta.php"); ?>
        <!-- Administrar Usuarios -->
        <?php include("templates/admin_user.php"); ?>
        <!-- Administrar contrasenha -->
        <?php include("templates/admin_password.php"); ?>

    </ul>

    <!-- // Sidebar menu para niveles de usuario Compras -->
<?php } else if (($_SESSION['permisos_acceso'] == 2)) { ?>

    <ul class="sidebar-menu">
        <li class="header">Menu</li>
        <?php
        if ($_GET['module'] == 'start') {
            $active_home = 'active';
        } else {
            $active_home = '';
        }
        ?>
        <li class="<?php echo $active_home; ?>">
            <a href="?module=start"><i class="fa fa-home"></i>Inicio</a>
        </li>

        <?php include("templates/generales.php"); ?>
        <?php include("templates/compra.php"); ?>

        <!-- Administrar contraseñas también para Compras -->
        <li class="<?php echo ($_GET['module'] == "password") ? 'active' : ''; ?>">
            <a href="?module=password"><i class="fa fa-lock"></i>Cambiar Contraseña</a>
        </li>
    </ul>

<?php } else if (($_SESSION['permisos_acceso'] == 3)) { ?>
    <ul class="sidebar-menu">
        <li class="header">Menu</li>
        <?php
        if ($_GET['module'] == 'start') {
            $active_home = 'active';
        } else {
            $active_home = '';
        }
        ?>
        <li class="<?php echo $active_home; ?>">
            <a href="?module=start"><i class="fa fa-home"></i>Inicio</a>
        </li>

        <?php // if ($_GET['module'] == 'start') { 
        ?>

        <?php include("templates/generales.php"); ?>
        <?php include("templates/venta.php"); ?>

        <!-- Administrar contraseñas -->
        <?php if ($_GET['module'] == "password") { ?>
            <li class="active">
                <a href="?module=password"><i class="fa fa-lock"></i>Cambiar Contraseña</a>
            </li>
        <?php } else { ?>
            <li>
                <a href="?module=password"><i class="fa fa-lock"></i>Cambiar Contraseña</a>
            </li>
        <?php } ?>

        <?php //} 
        ?>

    </ul>
<?php } ?>