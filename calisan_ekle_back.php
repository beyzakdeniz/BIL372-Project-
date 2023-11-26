<?php
    include "database.php";

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Escape user inputs to prevent SQL injection
        $meslek = $db->real_escape_string($_POST['meslek']);
        $dersKodu = $db->real_escape_string($_POST['dersKodu']);
        $digerDersKodu = $db->real_escape_string($_POST['digerDersKodu']);
        $calismaZamani = $db->real_escape_string($_POST['calismaZamani']);
        $gun = $db->real_escape_string($_POST['gun']);
        $saat = $db->real_escape_string($_POST['saat']);
        $tcKimlik = $db->real_escape_string($_POST['tcKimlik']);
        $cinsiyet = $db->real_escape_string($_POST['cinsiyet']);
        $dogumTarihi = $db->real_escape_string($_POST['dogumTarihi']);
        $isim = $db->real_escape_string($_POST['isim']);
        $soyisim = $db->real_escape_string($_POST['soyisim']);
        $maas = $db->real_escape_string($_POST['maas']);
        $mail = $db->real_escape_string($_POST['mail']);
        $telefonNo = $db->real_escape_string($_POST['telefonNo']);
        $today = date("Y-m-d");

        // Insert into the calisan table
        $sql = "INSERT INTO calisan (cinsiyet, dogum_tarihi, isim, soyisim) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssss", $cinsiyet, $dogumTarihi, $isim, $soyisim);
        $stmt->execute();
        $stmt->close();

        // Get the last inserted ID
        $calisan_id = $db->insert_id;

        // Insert into the appropriate table based on the selected occupation
        if ($meslek === 'temizlikPersoneli') {
            $sql = "INSERT INTO temizlik (calisan_id) VALUES (?)";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("i", $calisan_id);
            $stmt->execute();
            $stmt->close();
        } elseif ($meslek === 'ogretmen') {
            $sql = "INSERT INTO ogretmen (calisan_id, ders_kodu) VALUES (?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("is", $calisan_id, $dersKodu);
            $stmt->execute();
            $stmt->close();

            // Insert into the ders table
            $sql = "INSERT INTO ders (ders_kodu) VALUES (?)";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $dersKodu);
            $stmt->execute();
            $stmt->close();
        } elseif ($meslek === 'idari') {
            $sql = "INSERT INTO idari (calisan_id) VALUES (?)";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("i", $calisan_id);
            $stmt->execute();
            $stmt->close();
        }

        // Insert additional information based on the selected working time
        if ($calismaZamani === 'yariZamanli') {
            $sql = "INSERT INTO partTime (calisan_id, musaitlik_id) VALUES (?, ?)";
            $stmt = $db->prepare($sql);
            $musaitlik_id = $gun . $saat;
            $stmt->bind_param("is", $calisan_id, $musaitlik_id);
            $stmt->execute();
            $stmt->close();
        }

        // Insert into the calisan_tc, calisan_mail, calisan_telefon tables
        $sql = "INSERT INTO calisan_tc (calisan_id, TC) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("is", $calisan_id, $tcKimlik);
        $stmt->execute();
        $stmt->close();

        $sql = "INSERT INTO calisan_mail (calisan_id, mail) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("is", $calisan_id, $mail);
        $stmt->execute();
        $stmt->close();

        $sql = "INSERT INTO calisan_telefon (calisan_id, telefon) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("is", $calisan_id, $telefonNo);
        $stmt->execute();
        $stmt->close();

        // Insert into the gider table
        $sql = "INSERT INTO gider (tarih, tur, harcama_turu) VALUES (?, 's', 'maaş')";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $today);
        $stmt->execute();
        $stmt->close();

        // Get the last inserted ID
        $gider_id = $db->insert_id;

        // Insert into the maasOdenir table
        $sql = "INSERT INTO maasOdenir (calisan_id, gider_id, maas) VALUES (?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("iii", $calisan_id, $gider_id, $maas);
        $stmt->execute();
        $stmt->close();

        echo "Staff added successfully!";
        
        // Close the connection
        $db->close();
    }
?>