<div class="admin_barı"><br>
<h3 class="text">Menü</h3><br><hr><br>
<ul class="s">
<?php
	if(isset($_SESSION["ogretmen_id"]))
	{
		echo'
			<li class="li"><a href="ogretmen_page_bilgi.php">Bilgi Görüntüle</a></li>
            <li class="li"><a href="bilgi_guncelle.html">Bilgi Güncelle</a></li>
			<li class="li"><a href="ogretmen_page_program.php">Ders Programı Görüntüle</a></li>
			<li class="li"><a href="logout.php">Logout</a></li>
		
		';
	
	}

?>
	

</ul>

</div>