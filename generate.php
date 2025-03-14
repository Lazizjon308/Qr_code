<?php
require 'vendor/autoload.php';

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

$qrcode = ''; 

if(isset($_POST['text'])){
    $text = $_POST['text'];

    $options = new QROptions([
        'eccLevel' => QRCode::ECC_L,
        'outputType' => 'png', 
        'scale' => 7,
    ]);

    $qrcode = (new QRCode($options))->render($text);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show QR</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
        <h2>Your QR code</h2>
        <?php if(!empty($qrcode)): ?>
            <img src="<?php echo $qrcode; ?>" alt="Generated QR Code">
        <?php else: ?>
            <p>No QR code generated yet.</p>
        <?php endif; ?>
        <a href="index.php" class="btn btn-primary">Back</a>
    </div>
</body>
</html>
