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