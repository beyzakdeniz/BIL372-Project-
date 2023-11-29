<?php

    include "database.php";

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Check if form is submitted using the POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $siralamaTuru = $db->real_escape_string($_POST['siralamaTuru']);
        $filtrelemeTuru = $db->real_escape_string($_POST['filtrelemeTuru']);

        // Retrieve the entered employee name from the form
        $ogrenci = $_POST["ogrenci"];

        if ($ogrenci === '*') {
            // Retrieve all employees if '*' is entered
                if($siralamaTuru === 'id'){
                    $sql = "SELECT * FROM ogrenci ORDER BY ogrenci_id ASC";
                }else if($siralamaTuru === 'isim'){
                    $sql = "SELECT * FROM ogrenci ORDER BY isim ASC";
                }else if($siralamaTuru === 'soyisim'){
                    $sql = "SELECT * FROM ogrenci ORDER BY soyisim ASC";
                }else if($siralamaTuru === 'yas'){
                    $sql = "SELECT * FROM ogrenci ORDER BY dogum_tarihi ASC";
                }  

        }

        if($filtrelemeTuru === 'isim'){ 
            if ($ogrenci === '*') {
            } else {
            // Retrieve employees based on the entered name
                if($siralamaTuru === 'id'){
                    $sql = "SELECT * FROM ogrenci_info WHERE isim LIKE ? ORDER BY ogrenci_id ASC";
                }else if($siralamaTuru === 'isim'){
                     $sql = "SELECT * FROM ogrenci_info WHERE isim LIKE ? ORDER BY isim ASC";
                }else if($siralamaTuru === 'soyisim'){
                    $sql = "SELECT * FROM ogrenci_info WHERE isim LIKE ? ORDER BY soyisim ASC";
                }else if($siralamaTuru === 'yas'){
                    $sql = "SELECT * FROM ogrenci_info WHERE isim LIKE ? ORDER BY dogum_tarihi ASC";
                }  
            }
        }else if($filtrelemeTuru === 'soyisim'){ 
            if ($ogrenci === '*') {

            } else {
            // Retrieve employees based on the entered name
                if($siralamaTuru === 'id'){
                    $sql = "SELECT * FROM ogrenci_info WHERE soyisim LIKE ? ORDER BY ogrenci_id ASC";
                }else if($siralamaTuru === 'isim'){
                     $sql = "SELECT * FROM ogrenci_info WHERE soyisim LIKE ? ORDER BY isim ASC";
                }else if($siralamaTuru === 'soyisim'){
                    $sql = "SELECT * FROM ogrenci_info WHERE soyisim LIKE ? ORDER BY soyisim ASC";
                }else if($siralamaTuru === 'yas'){
                    $sql = "SELECT * FROM ogrenci_info WHERE soyisim LIKE ? ORDER BY dogum_tarihi ASC";
                }  
            }
        }else if($filtrelemeTuru === 'yas'){ 
            if ($ogrenci === '*') {

            } else {
            // Retrieve employees based on the entered name
                if($siralamaTuru === 'id'){
                    $sql = "SELECT * FROM ogrenci_info WHERE ogrenci_age = $ogrenci ORDER BY ogrenci_id ASC";
                }else if($siralamaTuru === 'isim'){
                    $sql = "SELECT * FROM ogrenci_info WHERE ogrenci_age = $ogrenci ORDER BY isim ASC";
                }else if($siralamaTuru === 'soyisim'){
                    $sql = "SELECT * FROM ogrenci_info WHERE ogrenci_age = $ogrenci ORDER BY soyisim ASC";
                }else if($siralamaTuru === 'yas'){
                    $sql = "SELECT * FROM ogrenci_info WHERE ogrenci_age = $ogrenci ORDER BY dogum_tarihi ASC";
                }  
            }
        }


        // Prepare the SQL statement
        $stmt = $db->prepare($sql);

        if ($ogrenci !== '*') {
            // Bind parameters only if a specific name is entered
            // For '*' case, no binding is necessary
            $ogrenciParam = "%$ogrenci%";
            $stmt->bind_param("s", $ogrenciParam);
        }

        // Execute the query
        $stmt->execute();

        // Get the result set
        $result = $stmt->get_result();

        // Check if there are rows in the result set
        if ($result->num_rows > 0) {
            // Output data of each row
           echo "<table border='1'>";
        echo "<tr><th>ID</th><th>İsim</th><th>Soyisim</th><th>Cinsiyet</th><th>Doğum Tarihi</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ogrenci_id"] . "</td>";
            echo "<td>" . $row["isim"] . "</td>";
            echo "<td>" . $row["soyisim"] . "</td>";
            echo "<td>" . $row["cinsiyet"] . "</td>";
            echo "<td>" . $row["dogum_tarihi"] . "</td>";
            // Add more fields as needed
            echo "</tr>";
        }
        echo "</table>";
        } else {
            echo "No results found";
        }

        // Close the prepared statement and the database connection
        $stmt->close();
        $db->close();
    }
?>
