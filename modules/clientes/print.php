<?php

require '../../assets/plugins/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

ob_start();
include "print_view.php";
$html = ob_get_clean();
$nombre_archivo = "reporte_clientes.pdf";

$html2pdf = new Html2Pdf('L', 'A4', 'es');
$html2pdf->pdf->setDisplayMode('fullpage');
$html2pdf->writeHTML($html);
$html2pdf->output($nombre_archivo);

?>