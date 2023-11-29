<div class="student_bar"><br>
<h3 class="text">Menü</h3><br><hr><br>
<ul class="s">
<?php
	if(isset($_SESSION["ogrenci_id"]))
	{
		echo'
			<li class="li"><a href="ogrenci_page_bilgi.php">Bilgi Görüntüle</a></li>
            <li class="li"><a href="bilgi_guncelle.html">Bilgi Güncelle</a></li>
            <li class="li"><a href="veli_bilgisi_guncelle.html">Veli Bilgisi Güncelle</a></li>
			<li class="li"><a href="ogrenci_page_program.php">Ders Programı Görüntüle</a></li>
            <li class="li"><a href="ders_talep.html">Ders Talep Ekranı</a></li>
			<li class="li"><a href="logout.php">Logout</a></li>
		
		';
	
	}

?>
	

</ul>

</div>