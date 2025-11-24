<?php

require '../../assets/plugins/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

ob_start();
include "print_view.php";
$html = ob_get_clean();
$nombre_archivo = "reporte_departamentos.pdf";

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($html);
$html2pdf->output($nombre_archivo);

?>