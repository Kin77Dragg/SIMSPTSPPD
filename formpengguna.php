<!DOCTYPE html>
<html lang="en">
<head>
  <title>Form pengguna</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  
	<div class="container">
	<form method="post">
	  <div class="form-group row">
		<label for="namapengguna" class="col-4 col-form-label">Nama pengguna</label> 
		<div class="col-8">
		  <input id="namapengguna" name="namapengguna" type="text" class="form-control">
		</div>
	  </div> 
	  <div class="form-group row">
		<div class="offset-4 col-8">
		  <button name="submit" type="submit" class="btn btn-primary">Submit</button>
		</div>
	  </div>
	</form>
	<?php
		include('koneksi.db.php');
		if (isset($_POST['submit'])){
			$namapengguna=filter_var($_POST['namapengguna'],FILTER_SANITIZE_STRING);
			
			$sql="INSERT INTO `pengguna`(`namapengguna`) VALUES ('".$namapengguna."')";
			$q=mysqli_query($koneksi,$sql); //echo $sql;
			
			if ($q){
				echo '<div class="alert alert-success alert-dismissible">
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				<strong>Success!</strong>Record Sudah disimpan.
				</div>';
			} else {
				echo '<div class="alert alert-danger alert-dismissible">
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				<strong>Gagal!</strong>Record Gagal disimpan.
				</div>';
			}
		}
	?>
	</div>
	<div class="container mt-3">
  <h2>Daftar pengguna</h2>          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID pengguna</th>
		<th>Username</th>
        <th>Nama pengguna</th>
		<th>Nik pengguna</th>
		<th>Level pengguna</th>
		<th>Unit pengguna</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
	<?php
		$sql='SELECT * FROM `pengguna`'; 
		$q=mysqli_query($koneksi,$sql);
		$r=mysqli_fetch_array($q);
		if (empty($r)){
			echo '<div class="alert alert-success alert-dismissible">
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				<strong>Success!</strong>Record Record tabel tidak ada.
				</div>';
				exit();
		}
		do {
	?>
      <tr>
        <td><?php echo $r['id_login'];?></td>
        <td><?php echo $r['username'];?></td>
		<td><?php echo $r['nama_lengkap'];?></td>
		<td><?php echo $r['nik'];?></td>
		<td><?php 
			$sqllevel="SELECT * FROM `level` where idlevel = '".$r['idlevel']."'";
			$qlevel=mysqli_query($koneksi, $sqllevel);
			$rlevel=mysqli_fetch_array($qlevel);
			echo $rlevel['namalevel'];?></td>
		<td><?php 
			$sqlunit="SELECT * FROM `unit` where idunit = '".$r['idunit']."'";
			$qunit=mysqli_query($koneksi, $sqlunit);
			$runit=mysqli_fetch_array($qunit);
			echo $runit['namaunit'];?></td>
        <td><a href="koreksipengguna.php?id_login=<?php echo $r['id_login'];?>" target="frmmain" class="btn btn-success" title="Koreksi">🖊️</a>
		<a href="hapuspengguna.php?id_login=<?php echo $r['id_login'];?>" target="frmmain" class="btn btn-danger" title="Hapus" onclick="return confirm('Apakah yakin ingin dihapus?')" >🗑️</a></td>
      </tr>
	  <?php
		} while ($r=mysqli_fetch_array($q));
	  ?>
    </tbody>
  </table>
</div>

</body>
</html>