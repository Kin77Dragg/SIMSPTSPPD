<?php 
if (!isset($_SESSION)) session_start();
if (empty($_SESSION['SB_u'])) {
echo "<script>window.location.href='login.php';</script>";
exit();

}
?>
<?php
include("simbvkota.php");
if (isset($_GET['id'])) {
	$iddikoreksi=filter_var($_GET['id'],FILTER_SANITIZE_STRING);
} else {
	header('Location: aturpetugas.php');
	exit();
}
$sql="select * from petugas where IdPetugas='".$iddikoreksi."'";
	$q=mysqli_query($kon,$sql);
	$r=mysqli_fetch_array($q);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profil Pengguna</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h3>Profil Pengguna</h3>
  <div class="row">
    <div class="col-xl-3 col-md-6">
      <div class="card bg-success text-white mb-4">
	   <div class="card-body">
  <p>Nama Pengguna : <?php echo $r['NamaPetugas'];?></p>
  <p>Alamat : <?php echo $r['Alamat'];?></p>
  <p>Tempat Lahir : <?php echo $r['TempatLahir'];?></p>
  <p>Tanggal Lahir : <?php echo $r['TglLahir'];?></p>
       </div>
      </div>
	  <div class="card bg-success text-white mb-4">
  
      </div>
	</div>
  </div>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
    Ubah Profil
  </button>
  <a href="aturpetugas.php" class="btn btn-success">&#8416; &nbsp; Batal</a>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post"> 
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">User Profile Form Update</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
         

  <div class="mb-3 mt-3">
    <label for="Username" class="form-label">Username:</label>
    <input type="text" class="form-control" id="Username" placeholder="Enter username" name="Username" value="<?php echo $r['NamaPetugas'];?>" required>
  </div>
  <div class="mb-3 mt-3">
    <label for="Alamat" class="form-label">Alamat:</label>
    <input type="text" class="form-control" id="Alamat" placeholder="Enter Alamat" name="Alamat" value="<?php echo $r['Alamat'];?>">
  </div>
  <div class="mb-3 mt-3">
    <label for="TempatLahir" class="form-label">Tempat Lahir:</label>
    <input type="text" class="form-control" id="TempatLahir" placeholder="Enter Tempat Lahir" name="TempatLahir" value="<?php echo $r['TempatLahir'];?>">
  </div>
  <div class="mb-3 mt-3">
    <label for="TglLahir" class="form-label">TglLahir:</label>
    <input type="date" class="form-control" id="TglLahir" placeholder="Enter Tempat Lahir" name="TglLahir" value="<?php echo $r['TglLahir'];?>">
  </div>
  <div class="mb-3">
    <label for="pwd" class="form-label">Password:</label>
    <input type="password" class="form-control" id="pwd" placeholder="Enter password baru kalau mau diubah !" name="pswd">
  </div>
  <div class="mb-3">
  <label for="agama" class="form-label">Agama:</label>
  <select name="Agama" class="form-select">
        <option value="1" <?php if ($r['Agama']=='1') echo "selected";?> >Islam</option>
        <option value="2" <?php if ($r['Agama']=='2') echo "selected";?> >Katolik</option>
        <option value="3" <?php if ($r['Agama']=='3') echo "selected";?>>Protestan</option>
        <option value="4" <?php if ($r['Agama']=='4') echo "selected";?>>Hindu</option>
        <option value="5" <?php if ($r['Agama']=='5') echo "selected";?>>Budha</option>
      </select>
  </div>
  <div class="mb-3">
  <label for="IdLevel" class="form-label">Id Level:</label>
  <select name="IdLevel" class="form-select">
                <option value="0">Tidak Aktif</option>
                <option value="1" <?php if ($r['IdLevel']=='1') echo "selected";?> >Kolektor</option>
                <option value="2" <?php if ($r['IdLevel']=='2') echo "selected";?>>Teknisi</option>
                <option value="3" <?php if ($r['IdLevel']=='3') echo "selected";?>>Administrasi</option>
                <option value="4" <?php if ($r['IdLevel']=='4') echo "selected";?>>Koordinator</option>
                <option value="5" <?php if ($r['IdLevel']=='5') echo "selected";?>>Superuser</option>
                <option value="6" <?php if ($r['IdLevel']=='6') echo "selected";?>>Teller</option>
                <option value="7" <?php if ($r['IdLevel']=='7') echo "selected";?>></option>
              </select>
  </div>
		<input type="submit" value="Simpan" class="btn-primary"  name="bCloseModal">
		<input type="reset" value="Reset" name="bResetModal">
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php 
if (isset($_POST['bCloseModal']))
  {
	$uname=filter_var($_POST['Username'],FILTER_SANITIZE_STRING);
	$pwd=filter_var($_POST['pswd'],FILTER_SANITIZE_STRING);
	if (empty($pwd)) $ubahpassword=""; else $ubahpassword=", Password='".$pwd."' ";
	$Alamat=filter_var($_POST['Alamat'],FILTER_SANITIZE_STRING);
	$TempatLahir=filter_var($_POST['TempatLahir'],FILTER_SANITIZE_STRING);
	$TglLahir=filter_var($_POST['TglLahir'],FILTER_SANITIZE_STRING);
	$Agama=filter_var($_POST['Agama'],FILTER_SANITIZE_STRING);
	$IdLevel=filter_var($_POST['IdLevel'],FILTER_SANITIZE_STRING);
	
	$sql="update petugas set Alamat='".$Alamat."', TempatLahir='".$TempatLahir."', TglLahir='".$TglLahir."', Agama='".$Agama."',IdLevel='".$IdLevel."'".$ubahpassword." where NamaPetugas='".$uname."'";
	$q=mysqli_query($kon,$sql);
	echo "<script>window.location.href='aturpetugas.php';</script>";
  }
 
?>

</body>
</html>
