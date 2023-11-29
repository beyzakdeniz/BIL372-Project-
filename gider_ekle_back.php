<?php
    include "database.php"; // Assuming your database connection is in the database.php file

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $tur = $_POST["tur"];
        $harcamaTuru = $_POST["harcamaTuru"];
        $tarih = $_POST["tarih"];

        // Insert the expense information into the database
        $insertGiderQuery = "INSERT INTO gider (tur, harcama_turu, tarih) VALUES ('$tur', '$harcamaTuru', '$tarih')";
        $db->query($insertGiderQuery);

        echo "Expense information added successfully.";
    } else {
        // Redirect to the form page if accessed directly without a POST request
        header("Location: gider_ekle.html");
        exit();
    }

    $db->close();
?>