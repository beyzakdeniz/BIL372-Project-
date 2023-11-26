<?php
    include "database.php";

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if form is submitted using the POST method

        // Retrieve form data
        $meslek = $db->real_escape_string($_POST['meslek']);
        $calismaZamani = $db->real_escape_string($_POST['calismaZamani']);
        $tcKimlik = $db->real_escape_string($_POST['tcKimlik']);
        $cinsiyet = $db->real_escape_string($_POST['cinsiyet']);
        $dogumTarihi = $db->real_escape_string($_POST['dogumTarihi']);
        $isim = $db->real_escape_string($_POST['isim']);
        $soyisim = $db->real_escape_string($_POST['soyisim']);
        $maas = $db->real_escape_string($_POST['maas']);
        $mail = $db->real_escape_string($_POST['mail']);
        $telefonNo = $db->real_escape_string($_POST['telefonNo']);
        $today = date("Y-m-d");

        // Additional fields for teachers
        $dersKodu = isset($_POST["dersKodu"]) ? $_POST["dersKodu"] : null;

        // Insert into the calisan table
        $sql = "INSERT INTO calisan (cinsiyet, dogum_tarihi, isim, soyisim)
        VALUES ('$cinsiyet', '$dogumTarihi', '$isim', '$soyisim')";
        $db->query($sql);

        // Get the last inserted ID
        $calisan_id = $db->insert_id;

        // Insert into the appropriate table based on the selected occupation
        if ($meslek === 'temizlikPersoneli') {
            $sql = "INSERT INTO temizlik (calisan_id) VALUES ('$calisan_id')";
        } elseif ($meslek === 'ogretmen') {
            $sql = "INSERT INTO ders (ders_kodu) VALUES ('$dersKodu')";
        } elseif ($meslek === 'idari') {
            $sql = "INSERT INTO idari (calisan_id) VALUES ('$calisan_id')";
        }

        // Insert additional information based on the selected working time
        if ($db->query($sql) === TRUE) {

            // Insert into other related tables based on the selected occupation
            if ($meslek === 'ogretmen') {
                $sql = "INSERT INTO ogretmen (calisan_id, ders_kodu) VALUES ('$calisan_id','$dersKodu')";
                $db->query($sql);
            }

            // Insert additional information based on the selected working time
            if ($calismaZamani === 'yariZamanli') {
                $sql = "INSERT INTO partTime (calisan_id, musaitlik_id) VALUES ('$calisan_id', NULL)";
                $db->query($sql);
            }

            // Insert into the calisan_tc, calisan_mail, calisan_telefon tables
            $sql = "INSERT INTO calisan_tc (calisan_id, TC) VALUES ('$calisan_id', '$tcKimlik')";
            $db->query($sql);

            $sql = "INSERT INTO calisan_mail (calisan_id, mail) VALUES ('$calisan_id', '$mail')";
            $db->query($sql);

            $sql = "INSERT INTO calisan_telefon (calisan_id, telefon) VALUES ('$calisan_id', '$telefonNo')";
            $db->query($sql);

            $sql = "INSERT INTO gider (tarih, tur, harcama_turu) VALUES ('$today', 's', 'maaş')";
            $db->query($sql);

            // Eklenen giderin ID'sini al
            $gider_id = $db->insert_id;

            // Şimdi maasOdenir tablosuna ekle
            $sql = "INSERT INTO maasOdenir (calisan_id, gider_id, maas) VALUES ('$calisan_id', '$gider_id', '$maas')";
            $db->query($sql);

            echo "Staff added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $db->error;
        }

        // Close the database connection
        $db->close();
    } else {
        echo "Error: Invalid request!";
    }
?>
