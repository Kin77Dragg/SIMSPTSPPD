<?php require_once('Connections/simbvis.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "5";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO petugas (NamaPetugas, Alamat, TempatLahir, TglLahir, Agama, IdLevel, Password) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['NamaPetugas'], "text"),
                       GetSQLValueString($_POST['Alamat'], "text"),
                       GetSQLValueString($_POST['TempatLahir'], "text"),
                       GetSQLValueString($_POST['TglLahir'], "date"),
                       GetSQLValueString($_POST['Agama'], "int"),
                       GetSQLValueString($_POST['IdLevel'], "int"),
                       GetSQLValueString($_POST['Password'], "text"));

  mysql_select_db($database_simbvis, $simbvis);
  $Result1 = mysql_query($insertSQL, $simbvis) or die(mysql_error());
}

mysql_select_db($database_simbvis, $simbvis);
$query_rspillevel = "SELECT * FROM levelpetugas";
$rspillevel = mysql_query($query_rspillevel, $simbvis) or die(mysql_error());
$row_rspillevel = mysql_fetch_assoc($rspillevel);
$totalRows_rspillevel = mysql_num_rows($rspillevel);

mysql_select_db($database_simbvis, $simbvis);
$query_rspetugas = "SELECT * FROM petugas ORDER BY IdPetugas DESC";
$rspetugas = mysql_query($query_rspetugas, $simbvis) or die(mysql_error());
$row_rspetugas = mysql_fetch_assoc($rspetugas);
$totalRows_rspetugas = mysql_num_rows($rspetugas);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td colspan="2" align="center" valign="middle" nowrap="nowrap">Tambah Petugas Baru</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Nama Petugas:</td>
      <td><input type="text" name="NamaPetugas" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Alamat:</td>
      <td><textarea name="Alamat" cols="50" rows="5"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tempat Lahir:</td>
      <td><input type="text" name="TempatLahir" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tgl. Lahir:</td>
      <td><input type="date" name="TglLahir" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Agama:</td>
      <td><select name="Agama">
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>Islam</option>
        <option value="2" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>>Katolik</option>
        <option value="3" <?php if (!(strcmp(3, ""))) {echo "SELECTED";} ?>>Protestan</option>
        <option value="4" <?php if (!(strcmp(4, ""))) {echo "SELECTED";} ?>>Hindu</option>
        <option value="5" <?php if (!(strcmp(5, ""))) {echo "SELECTED";} ?>>Budha</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Level Petugas:</td>
      <td><select name="IdLevel">
        <?php
do {  
?>
        <option value="<?php echo $row_rspillevel['IdLevel']?>"><?php echo $row_rspillevel['NamaLevel']?></option>
        <?php
} while ($row_rspillevel = mysql_fetch_assoc($rspillevel));
  $rows = mysql_num_rows($rspillevel);
  if($rows > 0) {
      mysql_data_seek($rspillevel, 0);
	  $row_rspillevel = mysql_fetch_assoc($rspillevel);
  }
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Password:</td>
      <td><input type="password" name="Password" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan Rekord Baru" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>Daftar Petugas<br />
</p>
<table border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>No.</td>
    <td>Koreksi</td>
    <td>Hapus</td>
    <td>NamaPetugas</td>
    <td>Alamat</td>
    <td>TempatLahir</td>
    <td>TglLahir</td>
    <td>Agama</td>
    <td>IdLevel</td>
  </tr>
  <?php do { ?>
    <tr>
      <td align="center"><?php @$nmr++;echo $nmr; ?>&nbsp;</td>
      <td align="center"><a href="petugas.koreksi.php?id=<?php echo $row_rspetugas['IdPetugas']; ?>"><img src="images/b_edit.png" width="16" height="16" alt="Koreksi" /></a></td>
      <td align="center"><a href="petugas.hapus.php?id=<?php echo $row_rspetugas['IdPetugas']; ?>" onclick="return confirm('Apakah yakin akan menghapus petugas ini ?');"><img src="images/b_deltbl.png" width="16" height="16" alt="Hapus" /></a></td>
      <td><?php echo $row_rspetugas['NamaPetugas']; ?></td>
      <td><?php echo $row_rspetugas['Alamat']; ?></td>
      <td><?php echo $row_rspetugas['TempatLahir']; ?></td>
      <td><?php echo $row_rspetugas['TglLahir']; ?></td>
      <td><?php echo $row_rspetugas['Agama']; ?></td>
      <td><?php echo $row_rspetugas['IdLevel']; ?></td>
    </tr>
    <?php } while ($row_rspetugas = mysql_fetch_assoc($rspetugas)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($rspillevel);

mysql_free_result($rspetugas);
?>
