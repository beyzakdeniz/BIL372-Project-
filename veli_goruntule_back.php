<?php

    include "database.php";

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Check if form is submitted using the POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Retrieve the entered employee name from the form
        $veliAdi = $_POST["veli"];

        if ($veliAdi === '*') {
            // Retrieve all employees if '*' is entered
            $sql = "SELECT * FROM veli";
        } else {
            // Retrieve employees based on the entered name
            $sql = "SELECT v.v_id, vi.isim , vi.soyisim ,v.ogrenci_id , v.kimin_nesi , vt.tel_no, vm.mail 
            FROM veli v JOIN veli_isim vi ON v.v_id = vi.v_id JOIN veli_mail vm ON vm.v_id = vi.v_id JOIN  veli_tel vt ON vt.v_id = vm.v_id
            WHERE vi.isim LIKE ? ";
        }

        // Prepare the SQL statement
        $stmt = $db->prepare($sql);

        if ($veliAdi !== '*') {
            // Bind parameters only if a specific name is entered
            // For '*' case, no binding is necessary
            $veliAdiParam = "%$veliAdi%";
            $stmt->bind_param("s", $veliAdiParam);
        }

        // Execute the query
        $stmt->execute();

        // Get the result set
        $result = $stmt->get_result();

        // Check if there are rows in the result set
        if ($result->num_rows > 0) {
            // Output data of each row
           echo "<table border='1'>";
        echo "<tr><th>ID</th><th>İsim</th><th>Soyisim</th><th>Öğrenci Numarası</th><th>Yakınlık Durumu</th><th>Telefon Numarası</th><th>Maili</th>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["v_id"] . "</td>";
            echo "<td>" . $row["isim"] . "</td>";
            echo "<td>" . $row["soyisim"] . "</td>";
            echo "<td>" . $row["ogrenci_id"] . "</td>";
            echo "<td>" . $row["kimin_nesi"] . "</td>";
            echo "<td>" . $row["tel_no"] . "</td>";
            echo "<td>" . $row["mail"] . "</td>";
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
