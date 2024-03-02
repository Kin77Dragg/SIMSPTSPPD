<!DOCTYPE html>
<html lang="en">
<head>
	<title>Form Golongan</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<?php
		include('koneksi.db.php');
		if (isset($_GET['idPanGol'])){
			$idPanGol=filter_var($_GET['idPanGol'],FILTER_SANITIZE_STRING);
			$sql="SELECT * FROM `panngkatgolongan` WHERE idPanGol='".$idPanGol."'";
			$q=mysqli_query($koneksi, $sql);
			$r=mysqli_fetch_array($q);
		} 
	?>
		<div class="container">
		<form method="post">
		<div class="form-group row">
			<label for="namaunit" class="col-4 col-form-label">Nama Golongan</label> 
			<div class="col-8">
			<input id="Golongan" name="Golongan" type="text" class="form-control" value="<?php echo $r['Golongan'];?>">
			<input id="idPanGol" name="idPanGol" type="hidden" class="form-control" value="<?php echo $r['idPanGol'];?>" readonly>
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
				$Golongan=filter_var($_POST['Golongan'],FILTER_SANITIZE_STRING);
				$idPanGol=filter_var($_POST['idPanGol'],FILTER_SANITIZE_STRING);
				$Pangkat=filter_var($_POST['Pangkat'],FILTER_SANITIZE_STRING);
				
				$sql="UPDATE `pangkatgolongan` SET `idPanGol`='".$idPanGol."',`Golongan`='".$Golongan."',`Pangkat`='".$Pangkat."' WHERE idGolongan='".$idGolongan."'";
				$q=mysqli_query($koneksi,$sql); //echo $sql;
				
				if ($q){
					?><div class="alert alert-success alert-dismissible">
					<button type="button" class="btn-close" data-bs-dismiss="alert" onclick="window.location.href='formgolongan.php';"></button>
					<strong>Success!</strong>Record Sudah diganti.
					</div><?php
				} else {
					?><div class="alert alert-danger alert-dismissible">
					<button type="button" class="btn-close" data-bs-dismiss="alert" onclick="window.location.href='formgolongan.php';"></button>
					<strong>Gagal!</strong>Record Gagal diganti.
					</div><?php
				}
			}
		?>
	</div>

</body>
</html>