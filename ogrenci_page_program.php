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

    $sql = "SELECT * FROM view_ogrenci WHERE ogrenci_id = $ogrenci_id ORDER BY ders_saati";


    $result = $db->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            echo "<table><tr>";
    
            // Adjust table headers based on the selected view
            echo "<table border='1'>";
            echo "<th> </th><th>08:00</th><th>10:00</th><th>12:00</th><th>14:00</th><th>16:00</th>";
            echo "<tr> <th>Pazartesi    </th>";
            $day = 1;
            $time= 1;
            $days = array("Pazartesi", "Salı", "Çarşamba",  "Perşembe", "Cuma");
            
            // Continue processing and displaying the results
            while ($row = $result->fetch_assoc()) {                    
                
                // Convert the digit string to an integer
                $rowDersSaati = intval($row['ders_saati']);
                while ($day * 100 + ($time + 3 )* 2 < $rowDersSaati) {  
                    if ($time < 5) {
                        $time = $time + 1;
                        echo "<td>         </td>";  
                    } else if ($day < 5) {
                        echo   "<tr> <th>$days[$day]    </th>";
                        $day = $day + 1;
                        $time = 1;
                        
                    }
                   
                }
                echo "<td>{$row['ders_adi']}</td>";
            }

            while ($time != 5 || $day != 5) {  
                if ($time < 5) {
                    $time = $time + 1;
                    echo "<td>         </td>";  
                } else if ($day < 5) {
                    echo   "<tr> <th>$days[$day]    </th>";
                    $day = $day + 1;
                    $time = 1;    
                    echo "<td>         </td>";                     
                }
            }
    
            echo "</table>";
        } else {
            echo "<table border='1'>";
            echo "<th> </th><th>08:00</th><th>10:00</th><th>12:00</th><th>14:00</th><th>16:00</th>";
            echo "<tr> <th>Pazartesi    </th>";
            $day = 1;
            $time= 1;
            $days = array("Pazartesi", "Salı", "Çarşamba",  "Perşembe", "Cuma");
            
            while ($time != 5 || $day != 5) {  
                if ($time < 5) {
                    $time = $time + 1;
                    echo "<td>         </td>";  
                } else if ($day < 5) {
                    echo   "<tr> <th>$days[$day]    </th>";
                    $day = $day + 1;
                    $time = 1;    
                    echo "<td>         </td>";                     
                }
            }
        }
    } else {
        // Handle database query error
        echo "Error executing query: " . $db->error;
    }
    
    $db->close();
?>