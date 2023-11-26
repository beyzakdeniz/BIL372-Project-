<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link style="vertical-align: middle;">  
    <link rel="icon" type="image/x-icon" href="favicon.jpg">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MTE</title>

</head>
<body>
    <form action="calisan_ekle.php" method="POST">
        <h1>Yeni Çalışan Bilgileri</h1>

        <label for="meslek">Mesleği:</label>
        <select type="text" id="meslek"  name="meslek" onchange="checkTeacher()">
            <option value="temizlikPersoneli">Temizlik Personeli</option>
            <option value="ogretmen">Öğretmen</option>
            <option value="idari">İdari</option>
        </select><br>

        <div id="ogretmenContainer" style="display: none">
            <label for="dersKodu">Ders Kodu:</label>
            <select type="text" id="dersKodu" name="dersKodu" onchange="checkOtherOption()">
                <option value="matematik">Matematik</option>
                <option value="ingilizce">Ingilizce</option>
                <option value="almanca">Almanca</option>
                <option value="satranç">Satranç</option>
                <option value="webTasarim">Web Tasarim</option>
                <option value="robotik">Robotik</option>
                <option value="diger">Diğer</option>
            </select><br>
        </div>
        <div id="digerDers" style="display: none;">
            <label for="digerDersKodu">Diğer Ders Kodu:</label>
            <textarea id="digerDersKodu" name="digerDersKodu"></textarea>
        </div><br>

        <label for="calismaZamani">Çalışma Zamanı:</label>
        <select type="text" id="calismaZamani"  name="calismaZamani" onchange="checkWorkerTime()">
            <option value="tamZamanli">Tam Zamanlı</option>
            <option value="yariZamanli">Yarı Zamanlı</option>
        </select><br><br>

        <div id="yariZamanliContainer" style="display: none">
            <label for="gun">Gün:</label>
            <select style="font-size: 14px; padding: 5px;" type="text" id="gun" name="gun" required>
                <option value="Pazartesi">Pazartesi</option>
                <option value="Sali">Salı</option>
                <option value="Çarşamba">Çarşamba</option>
                <option value="Perşembe">Perşembe</option>
                <option value="Cuma">Cuma</option>
            </select><br>

            <label for="saat">Saat:</label>
            <select style="font-size: 14px; padding: 5px;" type="number" id="saat" name="saat" required>
                <option value="8">08.00</option>
                <option value="10">10.00</option>
                <option value="12">12.00</option>
                <option value="14">14.00</option>
                <option value="16">16.00</option>
            </select><br>
        </div>

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
        <input type="text" id="telefonNo" name="telefonNo" required><br>

        <button type="submit" >Çalışanı ekle</button>
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

            function checkTeacher() {
                const selectElement = document.getElementById('meslek');
                const ogretmenContainer = document.getElementById('ogretmenContainer');

                if (selectElement.value === 'ogretmen') {
                    ogretmenContainer.style.display = 'block';
                } else {
                    ogretmenContainer.style.display = 'none';
                }
            }

            function checkOtherOption() {
            const selectElement = document.getElementById('dersKodu');
            const otherOptionContainer = document.getElementById('digerDers');
            const digerTextArea = document.getElementById('digerDersKodu');

            if (selectElement.value === 'diger') {
                otherOptionContainer.style.display = 'block';
                digerTextArea.required = true;
            } else {
                otherOptionContainer.style.display = 'none';
                digerTextArea.required = false;
            }
        }
        </script>
    
    </form>
</body>
</html>