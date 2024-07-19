<?php

require_once __DIR__ . '/phpqrcode/qrlib.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $qrCodeFileName = "qrcodes/qrcode_id{$id}.png";

    if (!file_exists($qrCodeFileName)) {
        QRcode::png("https://pixcatalogo.com.br/qrcode_produto/get/".$id, $qrCodeFileName, 'H', 6);

        if (file_exists($qrCodeFileName)) {
            // echo "QR code gerado com sucesso!";
        }
    } 
     $dataAR = array('url' => $qrCodeFileName);
     echo  json_encode($dataAR);
} else {
    echo "ID não foi fornecido na URL.";
}
?>
