<?php
    include "database.php";

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if form is submitted using the POST method

        // Retrieve form data
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
        $dersKodu = $db->real_escape_string($_POST['ders_kodu']);
        $dersAdi = $db->real_escape_string($_POST['ders_adi']);

        // Insert into the calisan table
        $sql = "INSERT INTO calisan (cinsiyet, dogum_tarihi, isim, soyisim)
                VALUES ('$cinsiyet', '$dogumTarihi', '$isim', '$soyisim')";

        // Insert additional information based on the selected working time
        if ($db->query($sql) === TRUE) {

            // Get the last inserted ID
            $calisan_id = $db->insert_id;
                $dersKodu = $_POST["ders_kodu"];
                $insertDersQuery = "INSERT INTO ders (ders_kodu, ders_adi) 
                                        VALUES ('$dersKodu', NULL)";

                $insertOgretmenQuery = "INSERT INTO ogretmen (calisan_id, ders_kodu) 
                                        VALUES ('$calisan_id', '$dersKodu')";
                $db->query($insertOgretmenQuery);
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

            $sql = "UPDATE ders_saat
            SET ders_saati = (
                SELECT
                    a.musaitlik_id
                FROM
                    ders_acilacak da
                LEFT OUTER JOIN 
                    ders d ON da.ders_adi = d.ders_adi 
                JOIN 
                    ders_talep dt ON d.ders_adi = dt.ders_adi
                JOIN
                    ogrenci o ON dt.ogrenci_id = o.ogrenci_id
                JOIN
                    aktif a ON o.ogrenci_id = a.ogrenci_id
                WHERE
                    d.ders_kodu = '$dersKodu'
                GROUP BY
                    a.musaitlik_id
                ORDER BY
                    COUNT(a.musaitlik_id) DESC
                LIMIT 1
            )
            WHERE
                ders_kodu = '$dersKodu'";

        $db->query($sql);
        
            echo "Ders ve Öğretmen added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $db->error;
        }

        // Close the database connection
        $db->close();
    } else {
        echo "Error: Invalid request!";
    }
?>