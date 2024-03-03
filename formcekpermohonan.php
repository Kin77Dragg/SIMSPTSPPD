<?php
	include('koneksi.db.php');
	if(isset($_POST['NomorSurat'])){
		$NomorSurat=filter_var($_POST['NomorSurat'],FILTER_SANITIZE_STRING);
		$sql="SELECT * FROM `headersurat` WHERE NomorSurat='".$NomorSurat."'";
		$q=mysqli_query($koneksi,$sql);
		$r=mysqli_fetch_array($q);
		if (empty($r)){
			echo "<script>
			alert('Permohonan Baru'); window.location.href='formpermohonankosong.php';</script>";
		}else{
			echo "<script>
			alert('Permohonan Ditemukan'); window.location.href='formpermohonanisi.php?NomorSurat=".$r['NomorSurat']."';</script>";
		}
	}
?>