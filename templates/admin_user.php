<!-- Administrar Usuarios -->
<?php if ($_GET['module'] == "user" || $_GET['module'] == "form_user") { ?>
    <li class="active">
        <a href="?module=user"><i class="fa fa-user"></i>Administrar Usuarios</a>
    </li>
<?php } else { ?>
    <li>
        <a href="?module=user"><i class="fa fa-user"></i>Administrar Usuarios</a>
    </li>
<?php } ?>