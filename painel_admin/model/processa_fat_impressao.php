<?php
$bd  = $_POST['bd'];


use Dompdf\Dompdf;

require_once '../../dompdf/autoload.inc.php';

// inicializando o objeto Dompdf
$dompdf = new Dompdf(["enable_remote" => true]);

ob_start();
include "../pdf/pdf_fat_impressao.php";
$dompdf->loadHtml(ob_get_clean());

$dompdf->setPaper("A4", "portrait");

$dompdf->render();

/* $output = $dompdf->output();
file_put_contents("$id-acordo-$dia.pdf", $output); */

$dompdf->stream(
    "Relatorio_de_Faturamento.pdf", //nome
    array(
        "Attachment" => false //false visualiza e true faz download
    )
);
