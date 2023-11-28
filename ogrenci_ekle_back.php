<?php

    include "database.php";

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Check if form is submitted using the POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Retrieve student information from the form
        $dogumTarihi = $_POST["dogumTarihi"];
        $ad = $_POST["ad"];
        $soyad = $_POST["soyad"];
        $cinsiyet = $_POST["cinsiyet"];

        // Schedule Information
        $schedule = $_POST["schedule"];
        

        // Retrieve parent information from the form
        $veliAd = $_POST["veli_ad"];
        $veliSoyad = $_POST["veli_soyad"];
        $mail = $_POST["mail"];
        $telefonNo = $_POST["telefonNo"];
        $kiminNesi = $_POST["kiminNesi"];

        // Insert student information into the database (replace table and column names)
        $sqlStudent = "INSERT INTO ogrenci (dogum_tarihi, isim, soyisim, cinsiyet) 
                    VALUES ('$dogumTarihi', '$ad', '$soyad', '$cinsiyet')";

        if ($db->query($sqlStudent) === TRUE) {
            $studentId = $db->insert_id;

            // Insert Schedule Information
            foreach ($schedule as $saat => $gunler) {
                foreach ($gunler as $gun => $value) {
                    if ($value) {
                        $insertScheduleQuery = "INSERT INTO aktif (ogrenci_id, musaitlik_id) 
                                            VALUES ('$studentId', '$value')";
                        $db->query($insertScheduleQuery);
                    }
                }
            }
            echo "Student record added successfully";
        } else {
            echo "Error: " . $sqlStudent . "<br>" . $db->error;
        }

        // Insert parent information into the database (replace table and column names)
        $sqlParent = "INSERT INTO veli (ogrenci_id, kimin_nesi) 
                    VALUES ('$studentId', '$kiminNesi')";

        if ($db->query($sqlParent) === TRUE) {
            $parentId = $db->insert_id;
            
            $sqlParentTel = "INSERT INTO veli_tel (v_id, tel_no) 
                    VALUES ('$parentId', '$telefonNo')";
            $db->query($sqlParentTel);
            
            $sqlParentMail = "INSERT INTO veli_mail (v_id, mail) 
                    VALUES ('$parentId', '$mail')";
            $db->query($sqlParentMail);

            $sqlParentName = "INSERT INTO veli_isim (v_id, isim, soyisim) 
                    VALUES ('$parentId', '$veliAd', '$veliSoyad')";
            $db->query($sqlParentName);

            echo "Parent record added successfully";
        } else {
            echo "Error: " . $sqlParent . "<br>" . $db->error;
        }

        // Close the database connection
        $db->close();
    }
?>
