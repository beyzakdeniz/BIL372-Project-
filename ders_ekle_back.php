<!DOCTYPE html>
<html lang="en">

<?php
// ders_ekle_back.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the selectedDers is set in the POST data
    if (isset($_POST["selectedDers"])) {
        $selectedDers = $_POST["selectedDers"];

        // Now you can use $selectedDers as needed in your code
        echo "Selected Ders: " . $selectedDers;
    } else {
        // Handle the case where selectedDers is not set
        echo "Selected Ders not found in POST data.";
    }
} else {
    // Handle cases where the form is not submitted using POST
    echo "Form not submitted!";
}
?>
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="favicon.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTE</title>
</head>

<body>


    <form action="ders_ekle_back.php" method="POST">
        <h1>Yeni Ders Bilgileri</h1>


        <div id="DersAdi">
            <label for="DersAdi">Ders Adı:</label>
        </div><br>

        <label for="dersKodu">Ders Kodu:</label>
        <textarea style="font-size: 14px; width: 150px; height: 20px;" id="dersKodu" name="dersKodu"></textarea><br>

        <br>

        <div id="ogretmenContainer" style="display: none;">
            <label for="dersAdi">Ders Adı :</label>
            <select style="font-size: 14px; padding: 5px;" id="dersKodu" name="dersKodu" onchange="checkOtherOption()">
                <option value="matematik">Matematik</option>
                <option value="ingilizce">Ingilizce</option>
                <option value="almanca">Almanca</option>
                <option value="satranç">Satranç</option>
                <option value="webTasarim">Web Tasarim</option>
                <option value="robotik">Robotik</option>
                <option value="diger">Diğer</option>
    
            </select>
        </div>
        <div id="digerDers" style="display: none;">
            <label for="digerDersKodu">Diğer Ders Kodu:</label>
            <textarea id="digerDersKodu" name="digerDersKodu"></textarea>
        </div><br>


        <label for="calismaZamani">Çalışma Zamanı:</label>
        <select type="text" id="calismaZamani" name="calismaZamani" onchange="checkWorkerTime()">
            <option value="tamZamanli">Tam Zamanlı</option>
            <option value="yariZamanli">Yarı Zamanlı</option>
        </select><br><br>

        <div id="yariZamanliContainer" style="display: none">
            <table border="1">
                <tr>
                    <th></th>
                    <th>Pazartesi</th>
                    <th>Sali</th>
                    <th>Carsamba</th>
                    <th>Persembe</th>
                    <th>Cuma</th>
                </tr>
                <tr>
                    <td>08:00</td>
                    <td><input type="radio" name="schedule[08:00][Pazartesi]" value="108"></td>
                    <td><input type="radio" name="schedule[08:00][Sali]" value="208"></td>
                    <td><input type="radio" name="schedule[08:00][Carsamba]" value="308"></td>
                    <td><input type="radio" name="schedule[08:00][Persembe]" value="408"></td>
                    <td><input type="radio" name="schedule[08:00][Cuma]" value="508"></td>
                </tr>
                <tr>
                    <td>10:00</td>
                    <td><input type="radio" name="schedule[10:00][Pazartesi]" value="110"></td>
                    <td><input type="radio" name="schedule[10:00][Sali]" value="210"></td>
                    <td><input type="radio" name="schedule[10:00][Carsamba]" value="310"></td>
                    <td><input type="radio" name="schedule[10:00][Persembe]" value="410"></td>
                    <td><input type="radio" name="schedule[10:00][Cuma]" value="510"></td>
                </tr>
                <tr>
                    <td>12:00</td>
                    <td><input type="radio" name="schedule[12:00][Pazartesi]" value="112"></td>
                    <td><input type="radio" name="schedule[12:00][Sali]" value="212"></td>
                    <td><input type="radio" name="schedule[12:00][Carsamba]" value="312"></td>
                    <td><input type="radio" name="schedule[12:00][Persembe]" value="412"></td>
                    <td><input type="radio" name="schedule[12:00][Cuma]" value="512"></td>
                </tr>
                <tr>
                    <td>14:00</td>
                    <td><input type="radio" name="schedule[14:00][Pazartesi]" value="114"></td>
                    <td><input type="radio" name="schedule[14:00][Sali]" value="214"></td>
                    <td><input type="radio" name="schedule[14:00][Carsamba]" value="314"></td>
                    <td><input type="radio" name="schedule[14:00][Persembe]" value="414"></td>
                    <td><input type="radio" name="schedule[14:00][Cuma]" value="514"></td>
                </tr>
                <tr>
                    <td>16:00</td>
                    <td><input type="radio" name="schedule[16:00][Pazartesi]" value="116"></td>
                    <td><input type="radio" name="schedule[16:00][Sali]" value="216"></td>
                    <td><input type="radio" name="schedule[16:00][Carsamba]" value="316"></td>
                    <td><input type="radio" name="schedule[16:00][Persembe]" value="416"></td>
                    <td><input type="radio" name="schedule[16:00][Cuma]" value="516"></td>
                </tr>
            </table>
        </div><br>

        <label for="tcKimlik">TC Kimliği:</label>
        <input type="number" id="tcKimlik" name="tcKimlik" required><br>

        <label>Cinsiyet:</label>
        <div style="display: flex; align-items: center;">
            <label for="kadin" style="margin-right: 10px;">Kadın:</label>
            <input type="radio" id="kadin" name="cinsiyet" value="kadin">

            <label for="erkek" style="margin-right: 10px; margin-left: 10px;">Erkek:</label>
            <input type="radio" id="erkek" name="cinsiyet" value="erkek">
        </div>


        <label for="dogumTarihi">Doğum Tarihi:</label>
        <input type="date" id="dogumTarihi" name="dogumTarihi" required><br>

        <label for="isim">Ad:</label>
        <input type="text" id="isim" name="isim" required><br>

        <label for="soyisim">Soyad:</label>
        <input type="text" id="soyisim" name="soyisim" required><br>

        <label for="maas">Maaş:</label>
        <input type="number" id="maas" name="maas" required><br>

        <label for="mail">Mail:</label>
        <input type="text" id="mail" name="mail" required><br>

        <label for="telefon">Telefon Numarası:</label>
        <input type="number" id="telefonNo" name="telefonNo" required><br>

        <button type="submit">Ders ve Öğretmen ekle</button>
        <script>
            function checkWorkerTime() {
                const selectElement = document.getElementById('calismaZamani');
                const yariZamanliContainer = document.getElementById('yariZamanliContainer');

                if (selectElement.value === 'yariZamanli') {
                    yariZamanliContainer.style.display = 'block';
                } else {
                    yariZamanliContainer.style.display = 'none';
                }
            }

            function checkOtherOption() {
                const selectElement = document.getElementById('dersAdi');
                const otherOptionContainer = document.getElementById('digerDersAdi');
                const digerTextArea = document.getElementById('digerDersAdi');

            }
        </script>
    </form>
</body>

</html>