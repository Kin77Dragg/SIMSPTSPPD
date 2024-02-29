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
	if (isset($_GET['idlevel'])){
		$idlevel=filter_var($_GET['idlevel'],FILTER_SANITIZE_STRING);
		$sql="SELECT `idlevel`, `namalevel` FROM `level` WHERE idlevel='".$idlevel."'";
		$q=mysqli_query($koneksi, $sql);
		$r=mysqli_fetch_array($q);
	} 
		?>
	<div class="container">
	<form method="post">
	  <div class="form-group row">
		<label for="namalevel" class="col-4 col-form-label">Nama Level</label> 
		<div class="col-8">
		  <input id="namalevel" name="namalevel" type="text" class="form-control" value="<?php echo $r['namalevel'];?>">
		  <input id="idlevel" name="idlevel" type="hidden" class="form-control" value="<?php echo $r['idlevel'];?>">
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
			$namalevel=filter_var($_POST['namalevel'],FILTER_SANITIZE_STRING);
			$idlevel=filter_var($_POST['idlevel'],FILTER_SANITIZE_STRING);

			$sql="UPDATE `level` SET namalevel='".$namalevel."' WHERE idlevel='".$idlevel."'";
			$q=mysqli_query($koneksi,$sql); //echo $sql;
			
			if ($q){
				?><div class="alert alert-success alert-dismissible">
				<button type="button" class="btn-close" data-bs-dismiss="alert" onclick="window.location.href='formlevel.php';"></button>
				<strong>Success!</strong>Record Sudah diganti.
				</div><?php
			} else {
				?><div class="alert alert-danger alert-dismissible">
				<button type="button" class="btn-close" data-bs-dismiss="alert" onclick="window.location.href='formlevel.php';"></button>
				<strong>Gagal!</strong>Record Gagal diganti.
				</div><?php
			}
		}
	?>
	</div>

</body>
</html>