<?php
    include "database.php";

    session_start();

    if (!isset($_SESSION["ogrenci_id"])) {
        echo "Session not set!";
        exit;
    }
    $ogrenci_id = $_SESSION["ogrenci_id"];

    
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    if (1) {

        $sql = "SELECT * FROM view_ogrenci_info WHERE ogrenci_id = $ogrenci_id";
        
        $result = $db->query($sql);
        if ($result) {
            if ($result->num_rows > 0) {
                echo "<table><tr>";
        
                // Adjust table headers based on the selected view
                echo "<table border='1'>";
                echo "<th> Öğrenci ID <th>Cinsiyet<th>İsim <th>Soyisim
                <th>Doğum Tarihi<th>Ders Kodu<th>Ders Adı<th>Ders Saati"    ;
                echo" <tr>";
                        
                

        
                // Continue processing and displaying the results
                while ($row = $result->fetch_assoc()) {
    echo "<td>" . $row['ogrenci_id'] . "</td>";
    echo "<td>" . $row['ogrenci_cinsiyet'] . "</td>";
    echo "<td>" . $row['ogrenci_isim'] . "</td>";
    echo "<td>" . $row['ogrenci_soyisim'] . "</td>";
    echo "<td>" . $row['ogrenci_dogum_tarihi'] . "</td>";
    echo "<td>" . $row['ders_kodu'] . "</td>";
    echo "<td>" . $row['ders_adi'] . "</td>";
    echo "<td>" . $row['ders_saati'] . "</td>";
    echo "</tr>";
                }
        
                echo "</table>";
            } else {
                echo "No results found";
            }
        } else {
            // Handle database query error
            echo "Error executing query: " . $db->error;
        }
        
        $db->close();
    } else {
        // Handle cases where the form is not submitted
        echo "Form not submitted!";
    }
?>