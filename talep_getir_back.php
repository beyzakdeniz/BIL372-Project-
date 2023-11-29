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
            if ($result->num_rows > 0) {
                echo "<table><tr>";
        
                // Adjust table headers based on the selected view
                echo "<table border='1'>";
                echo "<th> Ders Adı <th> Talep Sayısı"   ;
                echo" <tr>";
                        
                

        
                // Continue processing and displaying the results
                $row = $result->fetch_assoc();
                     echo "<tr><td>" . $row['ders_adi'] . "</td>";
                    echo "<td>" . $row['ders_count'] . "</td>";
                    echo "</tr>";
            
                echo "</table>";
            } else {
                echo "Yeterli talebe ulaşan ders yok.";
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
