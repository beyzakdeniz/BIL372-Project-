<?php
include "database.php";
session_start();
if (!isset($_SESSION["ogrenci_id"])) {
    echo "<script>window.open('index.php?mes=Access Denied..','_self');</script>";
    exit(); // Stop execution to prevent further HTML rendering
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahmut Tuncer Kurs Merkezi</title>
    <link rel="icon" type="image/x-icon" href="favicon.jpg">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        #header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        #section {
            margin: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .text {
            color: #333;
        }

        .content {
            text-align: center;
        }

        .sha {
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <div id="header">
        <h3 class="text">Hoşgeldin <?php echo $_SESSION["ogrenci_id"]; ?></h3>
    </div>

    <div id="section">
        <?php include "student_bar.php"; ?><br>

        <div class="content">
            <img src="favicon.jpg" style="width: 150px; height: 150px;" class="sha">
        </div>
    </div>

</body>
</html>