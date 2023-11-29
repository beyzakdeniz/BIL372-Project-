<?php
    include "database.php";

    session_start();

    if (!isset($_SESSION["ogretmen_id"])) {
        echo "Session not set!";
        exit;
    }
    $ogretmen_id = $_SESSION["ogretmen_id"];

    
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    if (1) {

        $sql = "SELECT * FROM view_ogretmen_info WHERE ogretmen_id = $ogretmen_id";
        
        $result = $db->query($sql);
        if ($result) {
            if ($result->num_rows > 0) {
                echo "<table><tr>";
        
                // Adjust table headers based on the selected view
                echo "<table border='1'>";
                echo "<th> Öğretmen ID <th>Çalışan ID <th>İsim <th>Soyisim<th>
                Cinsiyet<th>Doğum Tarihi<th>Ders Kodu<th>Ders Adı<th>Ders Saati"    ;
                echo" <tr>";
                        
                

        
                // Continue processing and displaying the results
                $row = $result->fetch_assoc();
                     echo "<tr><td>" . $row['ogretmen_id'] . "</td>";
                    echo "<td>" . $row['calisan_id'] . "</td>";
                    echo "<td>" . $row['calisan_isim'] . "</td>";
                    echo "<td>" . $row['calisan_soyisim'] . "</td>";
                    echo "<td>" . $row['calisan_cinsiyet'] . "</td>";
                    echo "<td>" . $row['calisan_dogum_tarihi'] . "</td>";
                    echo "<td>" . $row['ders_kodu'] . "</td>";
                    echo "<td>" . $row['ders_adi'] . "</td>";
                    echo "<td>" . $row['ders_saati'] . "</td>";
                    echo "</tr>";
                
        
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
