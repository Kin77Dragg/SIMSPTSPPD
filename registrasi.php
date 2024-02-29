<?php 
if (!isset($_SESSION)) session_start();
if (empty($_SESSION['SB_jplg'])) $_SESSION['SB_jplg']='1';
if (empty($_SESSION['SB_u'])) {
echo "<script>window.location.href='login.php';</script>";
exit();

}
?>
<?php
include("simbvkota.php");
$sql="select * from petugas where NamaPetugas='".$_SESSION['SB_u']."'";
	$q=mysqli_query($kon,$sql);
	$r=mysqli_fetch_array($q);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registrasi Pelanggan Baru</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php 
 if (isset($_POST['bpilidjenisusaha'])) {
	 $_SESSION['SB_jplg']=filter_var($_POST['pilidjenisusaha'],FILTER_SANITIZE_STRING);
 }
?>
<div class="container mt-3">
  <h3>&#128106; Registrasi Pelanggan Baru</h3>
   <div class="card-body">
   <form action="" method="post"><fieldset class="form-control">
    <legend>1. Pilih Jenis Pelanggan:</legend>
  <div class="row">
    <div class="col">
    <select class="form-select" name="pilidjenisusaha" placeholder="Pilih jenis pelanggan">
   <?php $sqlpilju="select * from jenisusaha";
   $qju=mysqli_query($kon,$sqlpilju);
   $rju=mysqli_fetch_array($qju);
   do { ?>
    <option value="<?php echo $rju['idjenisusaha'];?>" <?php if ($_SESSION['SB_jplg']==$rju['idjenisusaha']) echo "selected";?>><?php echo $rju['jenisusaha'];?></option>
   <?php $idjenisusahaterakhir=$rju['idjenisusaha'];
   } while($rju=mysqli_fetch_array($qju));
   ?>
    <option value="<?php echo ++$idjenisusahaterakhir;?>" <?php if ($_SESSION['SB_jplg']==$idjenisusahaterakhir) echo "selected";?>>All</option>
   </select>
   </div><div class="col">
	 <input type="submit" value="Pilih" name="bpilidjenisusaha" class="btn btn-sm btn-primary">
	</div>
   </div></fieldset>
  </form>
  <fieldset class="form-control">
   <legend>2. Action Pelanggan</legend>
   <a href="tambahpelanggan.php" target="frmplg" class="btn btn-success">&#128193; Tambah Pelanggan Baru</a>
   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
    &#128269; Cari Pelanggan
  </button>
  <a href="daftarpelanggan.php" target="frmplg" class="btn btn-info">&#128458; Daftar Pelanggan </a>
  <a href="https://cosmo.k-vision.tv/site/login" target="_blank" class="btn btn-info">K-Vision</a>
  <a href="http://bengkulu.bill.faznet.co.id/index.php?_route=admin" target="_blank" class="btn btn-info">Faznet</a>
  </fieldset>
    </div>
  </div>
<div class="container">
<iframe src="" name="frmplg" width="100%" height="400px"></iframe>
</div> <!-- end div container iframe>
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="hasilcaripelanggan.php" target="frmplg"> 
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Form Cari Pelanggan</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         

  <div class="mb-3 mt-3">
    <label for="katakunci" class="form-label">Ketik bagian nama / nomor pelanggan:</label>
    <input type="text" class="form-control" id="katakunci" placeholder="Enter bagian nama/nomor pelanggan" name="katakunci" required>
  </div>
  
		<input type="submit" value="&#128269; Cari" class="btn-primary"  name="bCariPelanggan" data-bs-dismiss="modal">
		<input type="reset" value="Reset" name="bResetModal">
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">&#8416; &nbsp;Close</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php /*
if (isset($_POST['bCloseModal']))
  {
	$uname=filter_var($_POST['Username'],FILTER_SANITIZE_STRING);
	$pwd=filter_var($_POST['pswd'],FILTER_SANITIZE_STRING);
	if (empty($pwd)) $ubahpassword=""; else $ubahpassword=", Password='".$pwd."' ";
	$Alamat=filter_var($_POST['Alamat'],FILTER_SANITIZE_STRING);
	$TempatLahir=filter_var($_POST['TempatLahir'],FILTER_SANITIZE_STRING);
	$TglLahir=filter_var($_POST['TglLahir'],FILTER_SANITIZE_STRING);
	$Agama=filter_var($_POST['Agamat'],FILTER_SANITIZE_STRING);
	$IdLevel=filter_var($_POST['IdLevel'],FILTER_SANITIZE_STRING);
	
	$sql="insert into petugas (NamaPetugas,Alamat,TempatLahir,TglLahir,Password) values('".$uname."','".$Alamat."','".$TempatLahir."','".$TglLahir."','".$pwd."')";
	$q=mysqli_query($kon,$sql);
	echo "<script>window.location.href='aturpetugas.php';</script>";
  } */
?>

</body>
</html>
