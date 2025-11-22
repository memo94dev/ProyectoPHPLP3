<?php 

include 'config/database.php';

if (empty($_SESSION['username'] && empty($_SESSION['password']))) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=3'>";
}else{
    if ($_GET['module'] == 'start') {
        include 'modules/start/view.php';
    }
}

?>