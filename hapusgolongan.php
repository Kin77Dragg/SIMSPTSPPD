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
	<div class="container">
<?php
	include ('koneksi.db.php');
	if (isset($_GET['idPanGol'])) {
		$idPanGol = filter_var($_GET['idPanGol'], FILTER_SANITIZE_STRING);
		$sql = "DELETE FROM `pangkatgolongan` WHERE `idPanGol`='" .$idPanGol. "'";
		$q = mysqli_query($koneksi, $sql);  //echo $sql;
			
			if ($q){
				?><div class="alert alert-success alert-dismissible">
				<button type="button" class="btn-close" data-bs-dismiss="alert" onclick="window.location.href='formgolongan.php';"></button>
				<strong>Success!</strong>Record Sudah dihapus.
				</div><?php
			} else {
				?><div class="alert alert-danger alert-dismissible">
				<button type="button" class="btn-close" data-bs-dismiss="alert" onclick="window.location.href='formgolongan.php';"></button>
				<strong>Gagal!</strong>Record Gagal dihapus.
				</div><?php
			}
	}
?>
</div>

</body>
</html>