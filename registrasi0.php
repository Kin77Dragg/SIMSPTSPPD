<?php require_once('simbvkota.php'); ?>
<?php function GetCheckboxes($table, $key, $Fields, $Label, $Nilai='', $Separator=',', $whr = '', $antar='<br />') {
  $_whr = (empty($whr))? '' : "WHERE $whr";
  include("simbvkota.php");
  
  $s = "select $key, $Fields
    from $table
    $_whr order by $key";
  $r = mysqli_query($kon,$s);
  $_arrNilai = explode($Separator, $Nilai);
  $str = '';
  while ($w = mysql_fetch_array($r)){
    $_ck = (array_search($w[$key], $_arrNilai) === false)? '' : 'checked';
    $str .= "<input type=checkbox name='".$key."[]' value='$w[$key]' $_ck> $w[$Label]$antar";
  } ;
  return $str;
}?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysqli_real_escape_string($kon,$theValue) : mysqli_real_escape_string($kon,$theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	if (empty($_POST['IdPetugas'])) $stridptgs='0'; else $stridptgs=implode(',',$_POST['IdPetugas']);
  $insertSQL = sprintf("INSERT INTO pelanggan (NomorPelanggan, NomorFormPelanggan, NamaLengkap, NamaAlias, TglLahir, JenisKelamin, IdJenisIdentitas, NomorIdentitas, Pekerjaan, AlamatPemasangan, NomorTeleponRumah, NomorHandphone, IdJenisBangunan, IdStatusPenghuni, IdJenisPemasangan, IdPelayananDiminta, JumlahParalel, urlgmap, IdPeriodePembayaran, BesarIuran, IdSistemPembayaran, AlamatPenagihan, ProgramTambahan1, ProgramTambahan2, IdMarketing, IdPemasang, WaktuPemasangan, ApprovedPelanggan, ApprovedManagerArea) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,%s, %s)",
                       GetSQLValueString($_POST['NomorPelanggan'], "text"),
					   GetSQLValueString($_POST['NomorFormPelanggan'], "text"),
                       GetSQLValueString($_POST['NamaLengkap'], "text"),
					   GetSQLValueString($_POST['NamaAlias'], "text"),
                       GetSQLValueString($_POST['TglLahir'], "date"),
                       GetSQLValueString($_POST['JenisKelamin'], "int"),
                       GetSQLValueString($_POST['IdJenisIdentitas'], "int"),
                       GetSQLValueString($_POST['NomorIdentitas'], "text"),
                       GetSQLValueString($_POST['Pekerjaan'], "text"),
                       GetSQLValueString($_POST['AlamatPemasangan'], "text"),
                       GetSQLValueString($_POST['NomorTeleponRumah'], "text"),
                       GetSQLValueString($_POST['NomorHandphone'], "text"),
                       GetSQLValueString($_POST['IdJenisBangunan'], "int"),
                       GetSQLValueString($_POST['IdStatusPenghuni'], "int"),
					   GetSQLValueString($_POST['IdJenisPemasangan'], "int"),
                       GetSQLValueString($_POST['IdPelayananDiminta'], "int"),
                       GetSQLValueString($_POST['JumlahParalel'], "int"),
					   GetSQLValueString($_POST['URLGmap'], "text"),
                       GetSQLValueString($_POST['IdPeriodePembayaran'], "int"),
					   GetSQLValueString($_POST['BesarIuran'], "double"),
                       GetSQLValueString($_POST['IdSistemPembayaran'], "int"),
                       GetSQLValueString($_POST['AlamatPenagihan'], "text"),
                       GetSQLValueString($_POST['ProgramTambahan1'], "text"),
                       GetSQLValueString($_POST['ProgramTambahan2'], "text"),
                       GetSQLValueString($_POST['IdMarketing'], "int"),
                       GetSQLValueString($stridptgs, "text"),
					   GetSQLValueString($_POST['WaktuPemasangan'], "date"),
                       GetSQLValueString($_POST['ApprovedPelanggan'], "int"),
                       GetSQLValueString($_POST['ApprovedManagerArea'], "int"));

  $Result1 = mysqli_query($kon,$insertSQL) or die(mysqli_error());
  if (!empty($_FILES['foto']['name'])) {
  $nopel=$_POST['NomorPelanggan'];
  $ekstensi_diperbolehkan	= array('png','jpg');
  $nama = $_FILES['foto']['name'];
  $x = explode('.', $nama);
  $ekstensi = strtolower(end($x));
  $ukuran	= $_FILES['foto']['size'];
  $file_tmp = $_FILES['foto']['tmp_name'];	
  if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
	if($ukuran < 1044070){	
		move_uploaded_file($file_tmp, 'foto/'.$nopel.'.'.$ekstensi);
		$sqlmhs="update pelanggan set foto='".$nopel.'.'.$ekstensi."' where nomorpelanggan ='".$nopel."'";
		$query = mysqli_query($kon,$sqlmhs);
		if($query){
		  echo "<script>window.alert('FILE BERHASIL DI UPLOAD');</script>";
		} else {
		  echo "<script>window.alert('GAGAL MENGUPLOAD GAMBAR';</script>";
		}
	 }else{
		echo "<script>window.alert('UKURAN FILE TERLALU BESAR';</script>";
	 }
   }else{
	 echo "<script>window.alert('EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';</script>";
   }
  } //end if empty $_FILES['file'];
}

$query_piljeniskelamin = "SELECT * FROM jeniskelamin";
$piljeniskelamin = mysqli_query($kon,$query_piljeniskelamin) or die(mysqli_error());
$row_piljeniskelamin = mysqli_fetch_assoc($piljeniskelamin);

$query_piljenisbangunan = "SELECT * FROM jenisbangunan";
$piljenisbangunan = mysqli_query($kon,$query_piljenisbangunan) or die(mysqli_error());
$row_piljenisbangunan = mysqli_fetch_assoc($piljenisbangunan);
$totalRows_piljenisbangunan = mysqli_num_rows($piljenisbangunan);

$query_piljenisidentitas = "SELECT * FROM jenisidentitas";
$piljenisidentitas = mysqli_query($kon,$query_piljenisidentitas) or die(mysql_error());
$row_piljenisidentitas = mysqli_fetch_assoc($piljenisidentitas);
$totalRows_piljenisidentitas = mysqli_num_rows($piljenisidentitas);

$query_pilpelayanandiminta = "SELECT * FROM pelayanandiminta";
$pilpelayanandiminta = mysqli_query($kon,$query_pilpelayanandiminta) or die(mysqli_error());
$row_pilpelayanandiminta = mysqli_fetch_assoc($pilpelayanandiminta);
$totalRows_pilpelayanandiminta = mysqli_num_rows($pilpelayanandiminta);

$query_pilsistempembayaran = "SELECT * FROM sistempembayaran";
$pilsistempembayaran = mysqli_query($kon,$query_pilsistempembayaran) or die(mysqli_error());
$row_pilsistempembayaran = mysqli_fetch_assoc($pilsistempembayaran);
$totalRows_pilsistempembayaran = mysqli_num_rows($pilsistempembayaran);

$query_pilstatuspenghuni = "SELECT * FROM statuspenghuni";
$pilstatuspenghuni = mysqli_query($kon,$query_pilstatuspenghuni) or die(mysqli_error());
$row_pilstatuspenghuni = mysqli_fetch_assoc($pilstatuspenghuni);
$totalRows_pilstatuspenghuni = mysqli_num_rows($pilstatuspenghuni);

$query_pilpetugasmarketing = "SELECT * FROM petugas";
$pilpetugasmarketing = mysqli_query($kon,$query_pilpetugasmarketing) or die(mysqli_error());
$row_pilpetugasmarketing = mysqli_fetch_assoc($pilpetugasmarketing);
$totalRows_pilpetugasmarketing = mysqli_num_rows($pilpetugasmarketing);

$query_pilteknisi = "SELECT * FROM petugas WHERE IdLevel = 2";
$pilteknisi = mysqli_query($kon,$query_pilteknisi) or die(mysqli_error());
$row_pilteknisi = mysqli_fetch_assoc($pilteknisi);
$totalRows_pilteknisi = mysqli_num_rows($pilteknisi);

$query_pilPegawaiPemasangan = "SELECT * FROM petugas WHERE IdLevel = 2";
$pilPegawaiPemasangan = mysqli_query($kon,$query_pilPegawaiPemasangan) or die(mysqli_error());
$row_pilPegawaiPemasangan = mysqli_fetch_assoc($pilPegawaiPemasangan);
$totalRows_pilPegawaiPemasangan = mysqli_num_rows($pilPegawaiPemasangan);

$query_pilperiode = "SELECT * FROM periodepembayaran";
$pilperiode = mysqli_query($kon,$query_pilperiode) or die(mysqli_error());
$row_pilperiode = mysqli_fetch_assoc($pilperiode);
$totalRows_pilperiode = mysqli_num_rows($pilperiode);

$query_rspiljenispemasangan = "SELECT * FROM jenispemasangan";
$rspiljenispemasangan = mysqli_query($kon,$query_rspiljenispemasangan) or die(mysqli_error());
$row_rspiljenispemasangan = mysqli_fetch_assoc($rspiljenispemasangan);
$totalRows_rspiljenispemasangan = mysqli_num_rows($rspiljenispemasangan);

$cari='';
if (isset($_POST['bCari'])) $cari=" where NomorPelanggan like '%".filter_var($_POST['tcari'],FILTER_SANITIZE_STRING)."%' or NamaLengkap like '%".filter_var($_POST['tcari'],FILTER_SANITIZE_STRING)."%' OR AlamatPemasangan like '%".filter_var($_POST['tcari'],FILTER_SANITIZE_STRING)."%'";
$query_rspelanggan = "SELECT * FROM pelanggan ".$cari." ORDER BY NomorPelanggan DESC";
$rspelanggan = mysqli_query($kon,$query_rspelanggan) or die(mysqli_error());
$row_rspelanggan = mysqli_fetch_assoc($rspelanggan);
$totalRows_rspelanggan = mysqli_num_rows($rspelanggan);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SIMBKLVision V.2</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
		<script>
function lihatdiv(divpart){
   var obj = document.getElementById(divpart);	
  obj.style.visibility="visible";
  obj.style.display="block";
  return false;
}
function tutupdiv(divpart){
	var obj = document.getElementById(divpart);	
 obj.style.visibility="hidden";
 obj.style.display="none";
 return false;
}
</script>
</head>

<body><div class="form-outline mb-4">
<div id="leftside" style="float:left; width:25%;">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" enctype="multipart/form-data">
  <table align="center">
    <tr valign="baseline">
      <td colspan="2" align="center" nowrap="nowrap">Registrasi / Pendaftaran Pelanggan Baru</td>
    </tr>
    <tr valign="baseline">
      <td width="171" align="right" nowrap="nowrap">Nomor Pelanggan:</td>
      <td width="339"><input type="text" name="NomorPelanggan" value="<?php 
	  $sql="select Max(NomorPelanggan) AS NP from pelanggan";
	  $qm=mysql_query($sql,$simbvis);
	  $rm=mysql_fetch_array($qm);
	  echo ++$rm['NP'];
	  ?>" size="32" required /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nomor Form Pelanggan:</td>
      <td><input name="NomorFormPelanggan" type="text" id="NomorFormPelanggan" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nama Lengkap:</td>
      <td><input type="text" name="NamaLengkap" value="" size="32" required /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nama Alias</td>
      <td><input name="NamaAlias" type="text" id="NamaAlias" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tgl. Lahir:</td>
      <td><input type="date" name="TglLahir" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jenis Kelamin:</td>
      <td><select name="JenisKelamin">
        <?php 
do {  
?>
        <option value="<?php echo $row_piljeniskelamin['IdJenisKelamin']?>" ><?php echo $row_piljeniskelamin['JenisKelamin']?></option>
        <?php
} while ($row_piljeniskelamin = mysql_fetch_assoc($piljeniskelamin));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jenis Identitas:</td>
      <td><select name="IdJenisIdentitas">
        <?php 
do {  
?>
        <option value="<?php echo $row_piljenisidentitas['IdJenisIdentitas']?>" ><?php echo $row_piljenisidentitas['JenisIdentitas']?></option>
        <?php
} while ($row_piljenisidentitas = mysql_fetch_assoc($piljenisidentitas));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nomor Identitas:</td>
      <td><input type="text" name="NomorIdentitas" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Pekerjaan:</td>
      <td><input type="text" name="Pekerjaan" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Alamat Pemasangan:</td>
      <td><textarea name="AlamatPemasangan" cols="50" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nomor Telepon Rumah:</td>
      <td><input type="text" name="NomorTeleponRumah" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nomor Handphone:</td>
      <td><input type="text" name="NomorHandphone" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">JenisBangunan:</td>
      <td><select name="IdJenisBangunan">
        <?php 
do {  
?>
        <option value="<?php echo $row_piljenisbangunan['IdJenisBangunan']?>" ><?php echo $row_piljenisbangunan['JenisBangunan']?></option>
        <?php
} while ($row_piljenisbangunan = mysql_fetch_assoc($piljenisbangunan));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Status Penghuni:</td>
      <td><select name="IdStatusPenghuni">
        <?php 
do {  
?>
        <option value="<?php echo $row_pilstatuspenghuni['IdStatusPenghuni']?>" ><?php echo $row_pilstatuspenghuni['StatusPenghuni']?></option>
        <?php
} while ($row_pilstatuspenghuni = mysql_fetch_assoc($pilstatuspenghuni));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jenis Pemasangan</td>
      <td><select name="IdJenisPemasangan" id="IdJenisPemasangan">
        <?php
do {  
?>
        <option value="<?php echo $row_rspiljenispemasangan['IdJenisPemasangan']?>"><?php echo $row_rspiljenispemasangan['JenisPemasangan']?></option>
        <?php
} while ($row_rspiljenispemasangan = mysql_fetch_assoc($rspiljenispemasangan));
  $rows = mysql_num_rows($rspiljenispemasangan);
  if($rows > 0) {
      mysql_data_seek($rspiljenispemasangan, 0);
	  $row_rspiljenispemasangan = mysql_fetch_assoc($rspiljenispemasangan);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Foto Bangunan</td>
      <td><input type="file" name="foto" id="foto" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">URL Google Map</td>
      <td><input type="text" name="URLGmap" id="URLGmap" />
        &nbsp;<a href="https://www.google.com/maps" title="Buka G.Map" target="_blank">Buka G.Map</a></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Pelayanan Diminta:</td>
      <td><select name="IdPelayananDiminta">
        <?php 
do {  
?>
        <option value="<?php echo $row_pilpelayanandiminta['IdPelayananDiminta']?>" ><?php echo $row_pilpelayanandiminta['PelayananDiminta']?></option>
        <?php
} while ($row_pilpelayanandiminta = mysql_fetch_assoc($pilpelayanandiminta));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jumlah Paralel (bila ada):</td>
      <td><input type="text" name="JumlahParalel" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Periode Pembayaran:</td>
      <td><select name="IdPeriodePembayaran">
        <?php
do {  
?>
        <option value="<?php echo $row_pilperiode['IdPeriodePembayaran']?>"><?php echo $row_pilperiode['PeriodePembayaran']?></option>
        <?php
} while ($row_pilperiode = mysql_fetch_assoc($pilperiode));
  $rows = mysql_num_rows($pilperiode);
  if($rows > 0) {
      mysql_data_seek($pilperiode, 0);
	  $row_pilperiode = mysql_fetch_assoc($pilperiode);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Sistem Pembayaran:</td>
      <td><select name="IdSistemPembayaran">
        <?php 
do {  
?>
        <option value="<?php echo $row_pilsistempembayaran['IdSistemPembayaran']?>" ><?php echo $row_pilsistempembayaran['SistemPembayaran']?></option>
        <?php
} while ($row_pilsistempembayaran = mysql_fetch_assoc($pilsistempembayaran));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Besar Iuran</td>
      <td><input name="BesarIuran" type="text" id="BesarIuran" value="65000" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Alamat Penagihan:</td>
      <td><textarea name="AlamatPenagihan" cols="50" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Program Tambahan 1:</td>
      <td><input type="text" name="ProgramTambahan1" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Program Tambahan 2:</td>
      <td><input type="text" name="ProgramTambahan2" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Petugas Marketing:</td>
      <td><select name="IdMarketing" id="IdMarketing">
        <option value="0"></option>
        <?php
do {  
?>
        <option value="<?php echo $row_pilpetugasmarketing['IdPetugas']?>"><?php echo $row_pilpetugasmarketing['NamaPetugas']?></option>
        <?php
} while ($row_pilpetugasmarketing = mysql_fetch_assoc($pilpetugasmarketing));
  $rows = mysql_num_rows($pilpetugasmarketing);
  if($rows > 0) {
      mysql_data_seek($pilpetugasmarketing, 0);
	  $row_pilpetugasmarketing = mysql_fetch_assoc($pilpetugasmarketing);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Petugas Teknisi:</td>
      <td>
      <select name="IdTeknisi" id="IdTeknisi">
      <option value="0"></option>
        <?php
do {  
?>
        <option value="<?php echo $row_pilteknisi['IdPetugas']?>"><?php echo $row_pilteknisi['NamaPetugas']?></option>
        <?php
} while ($row_pilteknisi = mysql_fetch_assoc($pilteknisi));
  $rows = mysql_num_rows($pilteknisi);
  if($rows > 0) {
      mysql_data_seek($pilteknisi, 0);
	  $row_pilteknisi = mysql_fetch_assoc($pilteknisi);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Petugas Pemasang:</td>
      <td> <?php $cbIdPetugas = GetCheckboxes("petugas","IdPetugas","NamaPetugas","NamaPetugas",'',",","IdLevel=2");
	echo $cbIdPetugas;
	?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Waktu Pemasangan</td>
      <td><input type="datetime-local" name="WaktuPemasangan" id="WaktuPemasangan" 
      value="<?php //$date = new DateTime('+5 hour'); // Date object using current date and time
$dt= date('Y-m-d\TH:i:s'); echo $dt;?>"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ApprovedPelanggan:</td>
      <td><select name="ApprovedPelanggan">
        <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Belum Disetujui</option>
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Disetujui</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">ApprovedManagerArea:</td>
      <td><select name="ApprovedManagerArea">
        <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Belum Disetujui</option>
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Disetujui</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Rekord Pelanggan Baru" onclick="return confirm('Apakah yakin datanya sudah benar ?');" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
</div>
<div id="rightside" style="width:55%; height:auto; float:right; overflow:auto; " > <!--<a href="#" onClick="tutupdiv('leftside');">&#8633</a>-->
<?php if (!empty($row_rspelanggan)) { ?>
  <form action="" method="post"><table width="524" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="182">Cari Nama / No. Pelanggan / Alamat Pelanggan</td>
    <td width="342"><input type="text" name="tcari" id="tcari" />
      <input type="submit" name="bCari" id="bCari" value="&#128270" /></td>
  </tr>
</table>
</form>
<?php if (isset($_POST['bCari'])) { ?>
  Jumlah yang ditemukan sebanyak  <?php echo $totalRows_rspelanggan;?> rekord sebagai berikut :
  <table border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td>No.</td>
      <td>Koreksi</td>
      <td>Hapus</td>
      <td>Nomor Pelanggan</td>
    <td>Nomor Form Pelanggan</td>
    <td>Nama Lengkap</td>
    <td>Tgl. Lahir</td>
    <td>Jenis Kelamin</td>
      <td>Jenis Identitas</td>
    <td>Nomor Identitas</td>
    <td>Pekerjaan</td>
    <td>Alamat Pemasangan</td>
    <td>Nomor Telepon Rumah</td>
    <td>Nomor Handphone</td>
    <td>Jenis Bangunan</td>
      <td>Foto Bangunan</td>
      <td>Peta Lokasi</td>
    <td>Status Penghuni</td>
    <td>Jenis Pemasangan</td>
    <td>Pelayanan Diminta</td>
    <td>Jumlah Paralel</td>
    <td>Periode Pembayaran</td>
    <td>Besar Iuran</td>
    <td>Sistem Pembayaran</td>
    <td>Alamat Penagihan</td>
    <td>Program Tambahan1</td>
    <td>Program Tambahan2</td>
      <td>Petugas Marketing</td>
      <td>Petugas Pemasang</td>
    <td>Waktu Pemasangan</td>
    <td>Approved Pelanggan</td>
    <td>Approved Manager Area</td>
  </tr
    ><?php do { ?>
      <tr>
        <td align="center"><?php @$nmr++;echo $nmr; ?>&nbsp;</td>
        <td align="center"><a href="koreksipelanggan.php?np=<?php echo $row_rspelanggan['NomorPelanggan']; ?>"><img src="images/b_edit.png" width="16" height="16" alt="Koreksi" /></a></td>
        <td align="center"><a href="#" onclick="return confirm('Apakah yakin akan menghapus pelanggan ini ?');"><img src="images/b_deltbl.png" width="16" height="16" alt="Hapus" /></a></td>
        <td><?php echo $row_rspelanggan['NomorPelanggan']; ?></td>
        <td><?php echo $row_rspelanggan['NomorFormPelanggan']; ?></td>
        <td><?php echo $row_rspelanggan['NamaLengkap']; ?></td>
        <td><?php echo $row_rspelanggan['TglLahir']; ?></td>
        <td><?php if (!empty($row_rspelanggan['JenisKelamin'])) { 
		$sqjk="select * from jeniskelamin where IdJenisKelamin=".$row_rspelanggan['JenisKelamin'].";";
		$qjk=mysql_query($sqjk,$simbvis);$rjk=mysql_fetch_array($qjk); echo $rjk['JenisKelamin'];}?></td>
        <td><?php if (!empty($row_rspelanggan['IdJenisIdentitas'])){ $sqjk="select * from jenisidentitas where IdJenisIdentitas=".$row_rspelanggan['IdJenisIdentitas'].";";$qjk=mysql_query($sqjk,$simbvis);$rjk=mysql_fetch_array($qjk); echo $rjk['JenisIdentitas'];}?></td>
        <td><?php echo $row_rspelanggan['NomorIdentitas']; ?></td>
        <td><?php echo $row_rspelanggan['Pekerjaan']; ?></td>
        <td><?php echo $row_rspelanggan['AlamatPemasangan']; ?></td>
        <td><?php echo $row_rspelanggan['NomorTeleponRumah']; ?></td>
        <td><?php echo $row_rspelanggan['NomorHandphone']; ?></td>
        <td><?php echo $row_rspelanggan['IdJenisBangunan']; ?></td>
        <td><img src="foto/<?php echo $row_rspelanggan['foto']; ?>"  width="150" height="150" /><?php echo $row_rspelanggan['foto']; ?></td>
        <td><?php if (!empty($row_rspelanggan['urlgmap'])) {?><a href="<?php echo $row_rspelanggan['urlgmap'];?>" target="_blank">&#127759</a><?php } else echo "Belum diset";?></td>
        <td><?php if (!empty($row_rspelanggan['IdStatusPenghuni'])) {$sqjk="select * from statuspenghuni where IdStatusPenghuni=". $row_rspelanggan['IdStatusPenghuni'].";";$qjk=mysql_query($sqjk,$simbvis);$rjk=mysql_fetch_array($qjk); echo $rjk['StatusPenghuni'];}
		?></td>
        <td><?php if (!empty($row_rspelanggan['IdJenisPemasangan'])) {$sqjk="select * from jenispemasangan where IdJenisPemasangan=". $row_rspelanggan['IdJenisPemasangan'].";";$qjk=mysql_query($sqjk,$simbvis);$rjk=mysql_fetch_array($qjk); echo $rjk['JenisPemasangan'];}
		?></td>
        <td><?php if (!empty($row_rspelanggan['IdPelayananDiminta'])){$sqjk="select * from pelayanandiminta where IdPelayananDiminta=". $row_rspelanggan['IdPelayananDiminta'].";";
		$qjk=mysql_query($sqjk,$simbvis);$rjk=mysql_fetch_array($qjk); echo $row_rspelanggan['IdPelayananDiminta'].' '.$rjk['PelayananDiminta'];}
		?></td>
        <td><?php echo $row_rspelanggan['JumlahParalel']; ?></td>
        <td><?php if (!empty($row_rspelanggan['IdPeriodePembayaran'])){$sqjk="select * from periodepembayaran where IdPeriodePembayaran=".$row_rspelanggan['IdPeriodePembayaran'].";";
		$qjk=mysql_query($sqjk,$simbvis);$rjk=mysql_fetch_array($qjk); echo $rjk['PeriodePembayaran'];}
		?></td>
        <td><?php echo $row_rspelanggan['BesarIuran']; ?></td>
        <td><?php if (!empty($row_rspelanggan['IdSistemPembayaran'])){$sqjk="select * from sistempembayaran where IdSistemPembayaran=". $row_rspelanggan['IdSistemPembayaran'];
		$qjk=mysql_query($sqjk,$simbvis);$rjk=mysql_fetch_array($qjk); echo $row_rspelanggan['IdSistemPembayaran'].' '.$rjk['SistemPembayaran'];}?></td>
        <td><?php echo $row_rspelanggan['AlamatPenagihan']; ?></td>
        <td><?php echo $row_rspelanggan['ProgramTambahan1']; ?></td>
        <td><?php echo $row_rspelanggan['ProgramTambahan2']; ?></td>
        <td><?php if (!empty($row_rspelanggan['IdMarketing'])){$sqlm="select * from petugas where IdPetugas=".$row_rspelanggan['IdMarketing']; $qm=mysql_query($sqlm,$simbvis);$rm=mysql_fetch_array($qm); echo $rm['NamaPetugas'];}?></td>
        <td><?php if (!empty($row_rspelanggan['IdPemasang'])){$idp=explode(',',$row_rspelanggan['IdPemasang']); $i=0;
		 foreach ($idp as $idptgs) {
			 $sqlp="select * from petugas where IdPetugas=".$idptgs;$qp=mysql_query($sqlp,$simbvis);$rp=mysql_fetch_array($qp);
			 echo $rp['NamaPetugas']; $i++;if ($i<count($idp)) echo ", ";
		 }
		}
		?></td>
        <td><?php echo $row_rspelanggan['WaktuPemasangan']; ?></td>
        <td><?php switch($row_rspelanggan['ApprovedPelanggan']) {
			case 0:$stj="Belum disetujui";break;
			case 1:$stj="Disetujui";break;
		};echo $stj;?></td>
        <td><?php switch($row_rspelanggan['ApprovedManagerArea']) {
			case 0:$stj="Belum disetujui";break;
			case 1:$stj="Disetujui";break;
		};echo $stj;?></td>
      </tr>
      <?php } while ($row_rspelanggan = mysql_fetch_assoc($rspelanggan)); ?>
  </table>
<br /> <?php } //end if empty $row_rspelanggan?>
<?php } //end if isset bCari?>
</div></div>
<p>&nbsp;</p>
</body>
</html>
<?php
mysqli_free_result($piljeniskelamin);

mysqli_free_result($piljenisbangunan);

mysqli_free_result($piljenisidentitas);

mysqli_free_result($pilpelayanandiminta);

mysqli_free_result($pilsistempembayaran);

mysqli_free_result($pilstatuspenghuni);

mysqli_free_result($pilpetugasmarketing);

mysqli_free_result($pilteknisi);

mysqli_free_result($pilPegawaiPemasangan);

mysqli_free_result($pilperiode);

mysqli_free_result($rspiljenispemasangan);

mysqli_free_result($rspelanggan);
?>
