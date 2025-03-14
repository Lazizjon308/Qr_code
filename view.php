<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Qr code</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <h1>Qr_code</h1>
    <h2>Generate Qr code</h2>
    <div class="container">

        <form action="generate.php" method="POST">
            <input type="text" name="text" placeholder="input text" required>
            <button>generate</button>
        </form>


    </div>
    <h2>Decode Qr code</h2>
    <div class="container">

        <form action="decode.php" method="POST">
            <!-- <input type="file" name="image" placeholder="input text" required> -->
            <button>decode</button>
        </form>


    </div>



</body>
</html>