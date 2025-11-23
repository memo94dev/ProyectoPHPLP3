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
    
}

?>