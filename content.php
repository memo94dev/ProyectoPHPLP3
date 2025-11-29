<?php 

include 'config/database.php';

if (empty($_SESSION['username'] && empty($_SESSION['password']))) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
}else{
    if ($_GET['module'] == 'start') {
        include 'modules/start/view.php';
    }

    elseif ($_GET['module'] == 'password') {
        include 'modules/password/view.php';
    }

    elseif ($_GET['module'] == 'user') {
        include 'modules/user/view.php';
    }
    elseif ($_GET['module'] == 'form') {
        include 'modules/user/form.php';
    }

    elseif ($_GET['module'] == 'profile') {
        include 'modules/profile/view.php';
    }
    elseif ($_GET['module'] == 'form_profile') {
        include 'modules/profile/form.php';
    }

    elseif ($_GET['module'] == 'departamento') {
        include 'modules/departamento/view.php';
    }
    elseif ($_GET['module'] == 'form_departamento') {
        include 'modules/departamento/form.php';
    }

    elseif ($_GET['module'] == 'ciudad') {
        include 'modules/ciudad/view.php';
    }
    elseif ($_GET['module'] == 'form_ciudad') {
        include 'modules/ciudad/form.php';
    }

    elseif ($_GET['module'] == 'clientes') {
        include 'modules/clientes/view.php';
    }
    elseif ($_GET['module'] == 'form_clientes') {
        include 'modules/clientes/form.php';
    }

    elseif ($_GET['module'] == 'compras') {
        include 'modules/compras/view.php';
    }
    elseif ($_GET['module'] == 'form_compras') {
        include 'modules/compras/form.php';
    }

    elseif ($_GET['module'] == 'tipo_producto') {
        include 'modules/tipo_producto/view.php';
    }
    elseif ($_GET['module'] == 'form_tipo_producto') {
        include 'modules/tipo_producto/form.php';
    }

    elseif ($_GET['module'] == 'unidad_medida') {
        include 'modules/unidad_medida/view.php';
    }
    elseif ($_GET['module'] == 'form_unidad_medida') {
        include 'modules/unidad_medida/form.php';
    }

    elseif ($_GET['module'] == 'deposito') {
        include 'modules/deposito/view.php';
    }
    elseif ($_GET['module'] == 'form_deposito') {
        include 'modules/deposito/form.php';
    }

    elseif ($_GET['module'] == 'proveedor') {
        include 'modules/proveedor/view.php';
    }
    elseif ($_GET['module'] == 'form_proveedor') {
        include 'modules/proveedor/form.php';
    }

    elseif ($_GET['module'] == 'producto') {
        include 'modules/producto/view.php';
    }
    elseif ($_GET['module'] == 'form_producto') {
        include 'modules/producto/form.php';
    }

    elseif ($_GET['module'] == 'venta') {
        include 'modules/venta/view.php';
    }
    elseif ($_GET['module'] == 'form_venta') {
        include 'modules/venta/form.php';
    }

    elseif ($_GET['module'] == 'stock') {
        include 'modules/stock/view.php';
    }
    
}

?>