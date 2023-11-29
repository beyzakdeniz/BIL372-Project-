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

    // Retrieve the entered employee name from the form
    $ogrenci = $_POST["ogrenci"];

    $sira;
    if ($siralamaTuru === 'id') {
        $sira = "ogrenci_id ASC";
    } else if ($siralamaTuru === 'isim') {
        $sira = "ogrenci_isim ASC";
    } else if ($siralamaTuru === 'soyisim') {
        $sira = "ogrenci_soyisim ASC";
    } else if ($siralamaTuru === 'yas') {
        $sira = "ogrenci_dogum_tarihi ASC";
    }

    $filter;
    if ($filtrelemeTuru === 'isim') {
        $filter = "ogrenci_isim";
    } else if ($filtrelemeTuru === 'soyisim') {
        $filter = "ogrenci_soyisim";
    } else if ($filtrelemeTuru === 'yas') {
        $filter = "ogrenci_age";
    } else if ($filtrelemeTuru === 'dersKodu') {
        $filter = "ogrenci_ders_kodu";
    }

    $vals = implode(',', $filtre);

    if ($ogrenci === '*') {
        $sql = "SELECT $vals FROM view_ogrenci_info ORDER BY $sira";
        $stmt = $db->prepare($sql);
    } else {
        $sql = "SELECT $vals FROM view_ogrenci_info where $filter like ? ORDER BY $sira";
        $stmt = $db->prepare($sql);

        // Check if the statement is prepared successfully
        if ($stmt) {
            $ogrenciParam = "%$ogrenci%";
            $stmt->bind_param("s", $ogrenciParam);
        } else {
            die("Error preparing statement: " . $db->error);
        }
    }

    // Execute the query
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

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

    // Close the prepared statement and the database connection
    $stmt->close();
    $db->close();
}
?>
