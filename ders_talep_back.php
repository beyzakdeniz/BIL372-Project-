<?php
    session_start();
    include "database.php"; // Assuming your database connection is in the database.php file

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $studentId = $_SESSION["ogrenci_id"];
        $dersAdi = $_POST["dersAdi"];
        $digerDersAdi = isset($_POST["digerDersAdi"]) ? $_POST["digerDersAdi"] : null;

        // If the selected course is "Diğer," use the entered text as the course name
        $selectedDersAdi = strtolower(($dersAdi === "diger") ? $digerDersAdi : $dersAdi);

        // Insert the course request information into the database
        $insertDersTalepQuery = "INSERT INTO ders_talep (ogrenci_id, ders_adi) VALUES ('$studentId', '$selectedDersAdi')";
        $db->query($insertDersTalepQuery);

        echo "Course request added successfully.";
    } else {
        // Redirect to the form page if accessed directly without a POST request
        header("Location: ders_talep.html");
        exit();
    }

    $db->close();
?>
