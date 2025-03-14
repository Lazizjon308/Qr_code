<?php
require "vendor/autoload.php";
use chillerlan\QRCode\QRCode;
use App\Contracts\ReadInterface;

use Zxing\QrReader;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $filePath = $_FILES['file']['tmp_name']; 

        
        $qrcode = new QrReader($filePath);
        $decodedText = $qrcode->text();

        if (!empty($decodedText)) {
            echo "QR kod matni: " . htmlspecialchars($decodedText);
        } else {
            echo "QR kodni o‘qib bo‘lmadi!";
        }
    } else {
        echo "Fayl yuklashda xatolik yuz berdi!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decode QR</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

    <h2>QR kodni dekod qilish</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="file" accept="image/*" required>
        <button type="submit">Dekod qilish</button>
    </form>
</body>
</html>


