<!DOCTYPE html>
<html lang="en">
<head>
  <title>Form Lavel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <?php
	include('koneksi.db.php');
	if (isset($_GET['id_login'])){
		$id_login=filter_var($_GET['id_login'],FILTER_SANITIZE_STRING);
		$sql="SELECT * FROM `pengguna` WHERE id_login='".$id_login."'";
		$q=mysqli_query($koneksi, $sql);
		$r=mysqli_fetch_array($q);
	} 
		?>
	<div class="container">
	<form method="post">
	  <div class="form-group row">
		<label for="username" class="col-4 col-form-label">username</label> 
		<div class="col-8">
		  <input id="username" name="username" type="text" class="form-control" value="<?php echo $r['username'];?>">
		  <input id="id_login" name="id_login" type="hidden" class="form-control" value="<?php echo $r['id_login'];?>">
		</div>
		<label for="username" class="col-4 col-form-label">Nama</label> 
		<div class="col-8">
		  <input id="username" name="username" type="text" class="form-control" value="<?php echo $r['username'];?>">
		  <input id="id_login" name="id_login" type="hidden" class="form-control" value="<?php echo $r['id_login'];?>">
		</div>
	  </div> 
	  <div class="form-group row">
		<div class="offset-4 col-8">
		  <button name="submit" type="submit" class="btn btn-primary">Submit</button>
		</div>
	  </div>
	</form>
	<?php
		if (isset($_POST['submit'])){
			$username=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
			$id_login=filter_var($_POST['id_login'],FILTER_SANITIZE_STRING);

			$sql="UPDATE `unit` SET username='".$username."' WHERE id_login='".$id_login."'";
			$q=mysqli_query($koneksi,$sql); //echo $sql;
			
			if ($q){
				?><div class="alert alert-success alert-dismissible">
				<button type="button" class="btn-close" data-bs-dismiss="alert" onclick="window.location.href='formunit.php';"></button>
				<strong>Success!</strong>Record Sudah diganti.
				</div><?php
			} else {
				?><div class="alert alert-danger alert-dismissible">
				<button type="button" class="btn-close" data-bs-dismiss="alert" onclick="window.location.href='formunit.php';"></button>
				<strong>Gagal!</strong>Record Gagal diganti.
				</div><?php
			}
		}
	?>
	</div>

</body>
</html>