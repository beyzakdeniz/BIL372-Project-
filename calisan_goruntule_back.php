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
    $filtre = isset($_POST["filtre"]) ? $_POST["filtre"] : array();
    $meslek =$db->real_escape_string($_POST['meslek']);

    // Retrieve the entered employee name from the form
    $calisan = $_POST["calisan"];

    $sira;
    if ($siralamaTuru === 'id') {
        $sira = "calisan_id ASC";
    } else if ($siralamaTuru === 'isim') {
        $sira = "calisan_isim ASC";
    } else if ($siralamaTuru === 'soyisim') {
        $sira = "calisan_soyisim ASC";
    }

    $filter;
    if ($filtrelemeTuru === 'isim') {
        $filter = "calisan_isim";
    } else if ($filtrelemeTuru === 'soyisim') {
        $filter = "calisan_soyisim";
    } else if ($filtrelemeTuru === 'cinsiyet') {
        $filter = "calisan_cinsiyet";
    } else if ($filtrelemeTuru === 'id') {
        $filter = "calisan_id";
    }else if ($filtrelemeTuru === 'dersKodu') {
        $filter = "ders_kodu";
    }

    $vals = implode(',', $filtre);


        if ($calisan === '*') {
            $sql = "SELECT $vals FROM $meslek ORDER BY $sira";
            $stmt = $db->prepare($sql);
        } else {
            $sql = "SELECT $vals FROM $meslek  WHERE $filter LIKE ? ORDER BY $sira";
            $stmt = $db->prepare($sql);

        // Check if the statement is prepared successfully
            if ($stmt) {
                $calisanParam = "%$calisan%";
                $stmt->bind_param("s", $calisanParam);
            } else {
             die("Error preparing statement: " . $db->error);
            }
        }
 

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the execution was successful
    
        // Check if there are rows in the result set
        if ($result->num_rows > 0) {
            // Output data of each row
            $row = $result->fetch_assoc(); // Fetch the first row to get column names

            echo "<table border='1'>";
            echo "<tr>";
            foreach ($row as $columnName => $columnValue) {
                echo "<th>$columnName</th>";
            }
            echo "</tr>";

            // Reset the result set pointer back to the beginning
            $result->data_seek(0);

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $columnValue) {
                    echo "<td>$columnValue</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No results found";
        }

        // Close the result set
        $result->close();
    // Close the prepared statement and the database connection
    $stmt->close();
    $db->close();
}
?>