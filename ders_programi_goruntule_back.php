<?php
    include "database.php";

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id; $view ;
        if (isset($_POST["p_id_ders"]) ){
            $id = $_POST["p_id_ders"] ;
            $view = 'view_ders';
           
        }

        elseif (isset($_POST["p_id_ogrenci"]) ){
            $id = $_POST["p_id_ogrenci"] ;
            $view = 'view_ogrenci';
        }

        elseif (isset($_POST["p_id_ogretmen"]) ){
            $id = $_POST["p_id_ogretmen"] ;
            $view = 'view_ogretmen';
        }

        else{
            $id ="";
            $view ="";
        }
        
        if ($id === '*') {
            $idCondition = "1"; // If ID is '*', retrieve all tuples
        } else {
            $idCondition = "ders_kodu = '$id'";
        }


        $sql = "SELECT * FROM $view WHERE $idCondition order by ders_saati ";

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
                    if($row['ders_saati'] != null)
                        $rowDersSaati = intval($row['ders_saati']);
                    else
                        $rowDersSaati = 999;
                    echo " $rowDersSaati";
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
                echo "Dersi Yok";
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
