<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Talep Edilen Dersler</title>
</head>

<body>

<?php
    include "database.php";

    session_start();

    
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    if (1) {

        $sql = "SELECT * FROM ders_acilacak";
        
        $result = $db->query($sql);
        if ($result) {
            echo "<form method= post  action= ders_ekle_back.php  method=POST>";
            if ($result->num_rows > 0) {
                echo "<table><tr>";
                
                // Adjust table headers based on the selected view
                echo "<table border='1'>";
                echo "<th> Ders Adı <th> Talep Sayısı <th> Dersi Ekle"   ;
                echo " <tr>";
                        
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['ders_adi'] . "</td>";
                    echo "<td>" . $row['ders_count'] . "</td>";
                    echo "<td>";
                    echo "<input type='hidden' name='selectedDers' value='" . $row['ders_adi'] . "'>";
                    echo "<button type='submit' name='submitButton'>Ekle</button>";
                    echo "</td>";
                    echo "</tr>";
                };
            
                echo "</table>";
            } else {
                echo "Yeterli talebe ulaşan ders yok.";
            }
        } else {
            // Handle database query error
            echo "Error executing query: " . $db->error;
        }
        echo "</form>";
        $db->close();
    } else {
        // Handle cases where the form is not submitted
        echo "Form not submitted!";
    }
?>


</body>

</html>
