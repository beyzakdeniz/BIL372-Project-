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

        // Insert into the calisan table
        $sql = "INSERT INTO calisan (cinsiyet, dogum_tarihi, isim, soyisim)
                VALUES ('$cinsiyet', '$dogumTarihi', '$isim', '$soyisim')";

        // Insert additional information based on the selected working time
        if ($db->query($sql) === TRUE) {

            // Get the last inserted ID
            $calisan_id = $db->insert_id;

            // Temizlik Personeli Information
            if ($meslek == "temizlikPersoneli") {
                $insertTemizlikQuery = "INSERT INTO temizlik (calisan_id) 
                                        VALUES ('$calisan_id')";
                $db->query($insertTemizlikQuery);
            }

            // Öğretmen Information
            if ($meslek == "ogretmen") {

                $dersKodu = $_POST["dersKodu"];
                $insertDersQuery = "INSERT INTO ders (ders_kodu, ders_adi) 
                                        VALUES ('$dersKodu', NULL)";

                if ($dersKodu == "diger") {
                    $digerDersKodu = $_POST["digerDersKodu"];
                    $insertDersQuery = "INSERT INTO ders (ders_kodu, ders_adi) 
                                        VALUES ('$digerDersKodu', NULL)";
                }
                    
                $db->query($insertDersQuery);

                $insertOgretmenQuery = "INSERT INTO ogretmen (calisan_id, ders_kodu) 
                                        VALUES ('$calisan_id', '$dersKodu')";
                $db->query($insertOgretmenQuery);
            }

            // İdari Information
            if ($meslek == "idari") {
                $insertIdariQuery = "INSERT INTO idari (calisan_id) 
                                    VALUES ('$calisan_id')";
                $db->query($insertIdariQuery);
            }

            // Insert additional information based on the selected working time
            if ($calismaZamani === 'yariZamanli') {
                // Schedule Information
                $schedule = $_POST["schedule"];

                // Insert Schedule Information
                foreach ($schedule as $saat => $gunler) {
                    foreach ($gunler as $gun => $value) {
                        if ($value) {
                            $insertScheduleQuery = "INSERT INTO partTime (calisan_id, musaitlik_id) 
                                                VALUES ('$calisan_id', '$value')";
                            $db->query($insertScheduleQuery);
                        }
                    }
                }
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