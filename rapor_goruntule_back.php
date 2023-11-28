<?php
    include "database.php"; // Veritabanı bağlantı dosyanız
    
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // POST verilerini al
    $raporTuru = $_POST['tur'];
    $tarih = $_POST['tarih'];

    // Veritabanı sorgusu
    $results = [];

    if ($raporTuru == 'aylik') {
        // Aylık rapor sorgusu
        $query = "SELECT * FROM gider WHERE MONTH(tarih) = MONTH('$tarih') AND YEAR(tarih) = YEAR('$tarih')";
        // Sorguyu çalıştır
        $results = $db->query($query);
    } elseif ($raporTuru == 'haftalik') {
        // Haftalık rapor sorgusu
        // Not: Bu kısım, veritabanınızın yapısına bağlı olarak değişebilir
        $query = "SELECT * FROM gider WHERE WEEK(tarih) = WEEK('$tarih')";
        // Sorguyu çalıştır
        $results = $db->query($query);
    }

    if ($results && $results->num_rows > 0) {
        // Başlık için HTML tablo yapısını başlat
        echo "<table border='1'>";
        echo "<tr><th>Gider ID</th><th>Harcama Türü</th><th>Tarih</th><th>Tur</th><th>";
    
        // Sonuçları göster
        while ($row = $results->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['gider_id'] . "</td>";
            echo "<td>" . $row['harcama_turu'] . "</td>";
            echo "<td>" . $row['tarih'] . "</td>";
            echo "<td>" . $row['tur'] . "</td>";
            echo "</tr>";
        }
    
        // HTML tablo yapısını kapat
        echo "</table>";
    } else {
        echo "Rapor bulunamadı.";
    }
    
?>
