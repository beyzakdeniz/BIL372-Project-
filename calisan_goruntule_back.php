<?php

    include "database.php";

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Check if form is submitted using the POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Retrieve the entered employee name from the form
        $calisanAdi = $_POST["calisan"];

        if ($calisanAdi === '*') {
            // Retrieve all employees if '*' is entered
            $sql = "SELECT * FROM calisan";
        } else {
            // Retrieve employees based on the entered name
            $sql = "SELECT * FROM calisan WHERE isim LIKE ?";
        }

        // Prepare the SQL statement
        $stmt = $db->prepare($sql);

        if ($calisanAdi !== '*') {
            // Bind parameters only if a specific name is entered
            // For '*' case, no binding is necessary
            $calisanAdiParam = "%$calisanAdi%";
            $stmt->bind_param("s", $calisanAdiParam);
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
            echo "<td>" . $row["calisan_id"] . "</td>";
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
