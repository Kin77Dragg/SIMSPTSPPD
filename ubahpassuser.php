<?php 
if (!isset($_SESSION)) session_start();
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
	
	$sql="update petugas set Alamat='".$Alamat."', TempatLahir='".$TempatLahir."', TglLahir='".$TglLahir."'".$ubahpassword." where NamaPetugas='".$uname."'";
	$q=mysqli_query($kon,$sql);
	echo "<script>window.location.href='ubahpassuser.php';</script>";
  }
?>

</body>
</html>
