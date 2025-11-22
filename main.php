<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="SysWeb">
    <meta name="author" content="Guillermo Barrientos">
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/plugins/datepicker/datepicker.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/plugins/chosen/css/chosen.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css">
    <title>Document</title>
</head>

<body class="skin-blue fixed">

    <div class="wrapper">

        <header class="main-header">
            <a href="main.php" class="logo">
                <img src="assets/img/log.png" alt="Logo SysWeb">
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <?php include 'top-menu.php'?>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="main-sidebar">
            <section class="sidebar">
                <?php include 'sidebar-menu.php'; ?>
            </section>
        </aside>

        <div class="content-wrapper">
            <?php //include 'content.php'; ?>
            <div class="modal fade" id="logout">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                                <h4 class="modal-title"><i class="fa fa-sign-out">Salir</i></h4>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>¿Está seguro que desea salir del sistema?</p>
                            <div class="modal-footer">
                                <a type="button" href="logout.php" class="btn btn-danger">Si, Salir</a>
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; <?php echo date("Y"); ?> - <a target="_blank" href="https://linkedin.com/in/memo94dev">Guillermo Barrientos</a>.</strong> Todos los Derechos Reservados.
        </footer>
    </div>
    
    <script src="assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/datepicker/datepicker.min.js" type="text/javascript"></script>
    <script src="assets/plugins/chosen/js/chosen.jquery.min.js"></script>
    <script src="assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/slimScroll/jquery.slimscroll.js" type="text/javascript"></script>
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery.maskMoney.min.js" type="text/javascript"></script>
    <script src="assets/js/app.min.js" type="text/javascript"></script>

</body>

</html>