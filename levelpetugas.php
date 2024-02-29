<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-3">   
<?php include_once('simbvkota.php');
if (isset($_POST['submit'])) {
    $NamaLevel=filter_var($_POST['NamaLevel'],FILTER_SANITIZE_STRING);
    $sql="INSERT INTO `levelpetugas`(`NamaLevel`) VALUES ('".$NamaLevel."')";
    $q=mysqli_query($kon,$sql);
    if ($q) {
        echo '<div class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="window.location.href=\'levelpetugas.php\';"></button>
        <strong>Success!</strong> Rekord baru sudah disimpan !
      </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="window.location.href=\'levelpetugas.php\';"></button>
        <strong>Gagal!</strong> Rekord baru gagal disimpan !
      </div>';
    }
}
if ((isset($_GET['Id'])) or (isset($_GET['m']))) {
  if ($_GET['m']=='1') {
    $Id=filter_var($_GET['Id'],FILTER_SANITIZE_STRING);
    $sqldel="delete from levelpetugas where IdLevel='".$Id."'";
    $qdel=mysqli_query($kon,$sqldel);
    $IdBaru=$Id-1;
    $sqla="alter table levelpetugas auto_increment=".$IdBaru;
    $qa=mysqli_query($kon,$sqla);
    if (($qdel) and ($qa)) {
        echo '<div class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="window.location.href=\'levelpetugas.php\';"></button>
        <strong>Success!</strong> Rekord sudah dihapus !
      </div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="window.location.href=\'levelpetugas.php\';"></button>
        <strong>Gagal!</strong> Rekord gagal dihapus !
      </div>';
    }
  }
  if ($_GET['m']==2) {
    $Id=filter_var($_GET['Id'],FILTER_SANITIZE_STRING);
    $sqlk="select * from levelpetugas where IdLevel='".$Id."'";
    $qk=mysqli_query($kon,$sqlk);
    $rk=mysqli_fetch_array($qk);
    ?>
<h2>Form Koreksi Level Petugas</h2>
<form method="post" name="frmkoreksi">
  <div class="form-group row">
    <label for="NamaLevel" class="col-4 col-form-label">Nama Level</label> 
    <div class="col-8">
    <input id="IdLevel" name="IdLevel" type="hidden" class="form-control" required="required" value="<?php echo $rk['IdLevel'];?>">  
      <input id="NamaLevel" name="NamaLevel" type="text" class="form-control" required="required" value="<?php echo $rk['NamaLevel'];?>">
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="bSimpan" type="submit" class="btn btn-primary">Simpan Hasil Koreksi</button>
    </div>
  </div>
</form>
    <?php
  } //end if get 2 / koreksi
}
if (isset($_POST['bSimpan'])) { 
    $Id=filter_var($_POST['IdLevel'],FILTER_SANITIZE_STRING);
    $NamaLevel=filter_var($_POST['NamaLevel'],FILTER_SANITIZE_STRING);
    $sql="UPDATE `levelpetugas` SET `NamaLevel`='".$NamaLevel."' WHERE `IdLevel`='".$Id."'";
    $q=mysqli_query($kon,$sql);
    if ($q) {
        echo '<div class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="window.location.href=\'levelpetugas.php\';"></button>
        <strong>Success!</strong> Rekord sudah tersimpan !
      </div>';
    } else {
        echo '<div class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="window.location.href=\'levelpetugas.php\';"></button>
        <strong>Gagal!</strong> Rekord gagal disimpan !
      </div>';
    }
} //end if bSimpan
?>   
 <h2>Daftar Level Petugas</h2>
  <p><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal" title="Tambah Level Petugas Baru">📁</button><br>
  Pengubahan ini menyebabkan perubahan semua level petugas yang ada menggunakan level tersebut.</p>            
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Id Level</th>
        <th>Nama Level</th>
        <th>Koreksi/Hapus</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $sql="select * from levelpetugas";
        $q=mysqli_query($kon,$sql);
        $r=mysqli_fetch_array($q);
        if (empty($r)) {
            echo '<div class="alert alert-warning alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Kosong !</strong> Rekord tabel belum ada !.
          </div>';
            exit();
        }
        do {
            ?>
      <tr>
        <td><?php echo $r['IdLevel'];?></td>
        <td><?php echo $r['NamaLevel'];?></td>
        <td><a href="levelpetugas.php?Id=<?php echo $r['IdLevel'];?>&m=2" class="btn btn-success" title="Koreksi Rekord">✏️</a>
            <a href="levelpetugas.php?Id=<?php echo $r['IdLevel'];?>&m=1" onclick="return confirm('Apakah yakin akan dihapus ?')" class="btn btn-danger" title="Hapus Rekord">🗑️</a></td>
      </tr>
      <?php }while($r=mysqli_fetch_array($q));
      ?>
    </tbody>
  </table>
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Level Petugas Baru</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form method="post" name="myModal>
  <div class="form-group row">
    <label for="NamaLevel" class="col-4 col-form-label">Nama Level</label> 
    <div class="col-8">
      <input id="NamaLevel" name="NamaLevel" type="text" class="form-control" required="required">
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Simpan Level Baru</button>
    </div>
  </div>
</form>

      <!-- Modal footer -->
<div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
</div>
</div>
  </div>
</div>
</body>
</html>
