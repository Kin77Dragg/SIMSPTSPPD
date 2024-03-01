<?php
include('koneksi.db.php');
?><!DOCTYPE html>
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
  <h2>Master Tabel Pengguna</h2>
  <form method="post">
  <div class="form-group row">
    <label for="Golongan" class="col-4 col-form-label">Golongan</label> 
    <div class="col-8">
      <input id="Golongan" name="Golongan" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <label for="Pangkat" class="col-4 col-form-label">Nama Pangkat</label> 
    <div class="col-8">
      <input id="Pangkat" name="Pangkat" type="text" class="form-control">
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Simpan Rekord Baru</button>
    </div>
  </div>
</form>
<?php 
if (isset($_POST['submit'])) {
    $Golongan=filter_var($_POST['Golongan'],FILTER_SANITIZE_STRING);
    $Pangkat=filter_var($_POST['Pangkat'],FILTER_SANITIZE_STRING);
    $sql="INSERT INTO `golongan`(`Golongan`, `Pangkat`) VALUES ('".$Golongan."','".$Pangkat."')";
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
  <h2>Tabel Daftar Golongan ASN</h2>           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No.</th>
        <th>Golongan</th>
        <th>Nama Pangkat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $sqlg="select * from Golongan";
        $qg=mysqli_query($koneksi,$sqlg);
        $rg=mysqli_fetch_array($qg);
        if (!empty($rg)) {
        do {
        ?>
      <tr>
        <td><?php @$nmr++;echo $nmr;?></td>
        <td><?php echo $rg['Golongan'];?></td>
        <td><?php echo $rg['Pangkat'];?></td>
        <td>
        <a href="koreksigolongan.php?Golongan=<?php echo $rg['Golongan'];?>" target="frmmain" class="btn btn-success" title="Koreksi">🖊️</a>
		<a href="hapusgolongan.php?Golongan=<?php echo $rg['Golongan'];?>" target="frmmain" class="btn btn-danger" title="Hapus" onclick="return confirm('Apakah yakin ingin dihapus?')" >🗑️</a>
        </td>
      </tr>
      <?php
        } while($rg=mysqli_fetch_array($qg));
    }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>