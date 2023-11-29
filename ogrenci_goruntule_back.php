<?php

    include "database.php";

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Check if form is submitted using the POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $siralamaTuru = $db->real_escape_string($_POST['siralamaTuru']);
        // Retrieve the entered employee name from the form
        $ogrenciAdi = $_POST["ogrenci"];

        if ($ogrenciAdi === '*') {
            // Retrieve all employees if '*' is entered
            if($siralamaTuru === 'id'){
                $sql = "SELECT * FROM ogrenci ORDER BY ogrenci_id ASC";
            }else if($siralamaTuru === 'isim'){
                $sql = "SELECT * FROM ogrenci ORDER BY isim ASC";
            }else if($siralamaTuru === 'soyisim'){
                $sql = "SELECT * FROM ogrenci ORDER BY soyisim ASC";
            }else if($siralamaTuru === 'dogumTarihi'){
                $sql = "SELECT * FROM ogrenci ORDER BY dogum_tarihi ASC";
            }  

     } else {
            // Retrieve employees based on the entered name
            if($siralamaTuru === 'id'){
                $sql = "SELECT * FROM ogrenci WHERE isim LIKE ? ORDER BY ogrenci_id ASC";
            }else if($siralamaTuru === 'isim'){
                $sql = "SELECT * FROM ogrenci WHERE isim LIKE ? ORDER BY isim ASC";
            }else if($siralamaTuru === 'soyisim'){
                $sql = "SELECT * FROM ogrenci WHERE isim LIKE ? ORDER BY soyisim ASC";
            }else if($siralamaTuru === 'dogumTarihi'){
                $sql = "SELECT * FROM ogrenci WHERE isim LIKE ? ORDER BY dogum_tarihi ASC";
            }  
        }

        // Prepare the SQL statement
        $stmt = $db->prepare($sql);

        if ($ogrenciAdi !== '*') {
            // Bind parameters only if a specific name is entered
            // For '*' case, no binding is necessary
            $ogrenciAdiParam = "%$ogrenciAdi%";
            $stmt->bind_param("s", $ogrenciAdiParam);
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