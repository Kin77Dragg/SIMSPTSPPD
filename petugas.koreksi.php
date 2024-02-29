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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE petugas SET NamaPetugas=%s, Alamat=%s, TempatLahir=%s, TglLahir=%s, Agama=%s, IdLevel=%s, Password=%s WHERE IdPetugas=%s",
                       GetSQLValueString($_POST['NamaPetugas'], "text"),
                       GetSQLValueString($_POST['Alamat'], "text"),
                       GetSQLValueString($_POST['TempatLahir'], "text"),
                       GetSQLValueString($_POST['TglLahir'], "date"),
                       GetSQLValueString($_POST['Agama'], "int"),
                       GetSQLValueString($_POST['IdLevel'], "int"),
                       GetSQLValueString($_POST['Password'], "text"),
                       GetSQLValueString($_POST['IdPetugas'], "int"));

  mysql_select_db($database_simbvis, $simbvis);
  $Result1 = mysql_query($updateSQL, $simbvis) or die(mysql_error());
  echo "<script>window.location.href='petugas.php';</script>";
}

$colname_rspetugasdikoreksi = "-1";
if (isset($_GET['id'])) {
  $colname_rspetugasdikoreksi = $_GET['id'];
}
mysql_select_db($database_simbvis, $simbvis);
$query_rspetugasdikoreksi = sprintf("SELECT * FROM petugas WHERE IdPetugas = %s", GetSQLValueString($colname_rspetugasdikoreksi, "int"));
$rspetugasdikoreksi = mysql_query($query_rspetugasdikoreksi, $simbvis) or die(mysql_error());
$row_rspetugasdikoreksi = mysql_fetch_assoc($rspetugasdikoreksi);
$totalRows_rspetugasdikoreksi = mysql_num_rows($rspetugasdikoreksi);

mysql_select_db($database_simbvis, $simbvis);
$query_rspillevel = "SELECT * FROM levelpetugas";
$rspillevel = mysql_query($query_rspillevel, $simbvis) or die(mysql_error());
$row_rspillevel = mysql_fetch_assoc($rspillevel);
$totalRows_rspillevel = mysql_num_rows($rspillevel);
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
      <td nowrap="nowrap" align="right">Nama Petugas:</td>
      <td><input type="text" name="NamaPetugas" value="<?php echo htmlentities($row_rspetugasdikoreksi['NamaPetugas'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right" valign="top">Alamat:</td>
      <td><textarea name="Alamat" cols="50" rows="5"><?php echo htmlentities($row_rspetugasdikoreksi['Alamat'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tempat Lahir:</td>
      <td><input type="text" name="TempatLahir" value="<?php echo htmlentities($row_rspetugasdikoreksi['TempatLahir'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Tgl. Lahir:</td>
      <td><input type="date" name="TglLahir" value="<?php echo htmlentities($row_rspetugasdikoreksi['TglLahir'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Agama:</td>
      <td><select name="Agama">
        <option value="1" <?php if (!(strcmp(1, htmlentities($row_rspetugasdikoreksi['Agama'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Islam</option>
        <option value="2" <?php if (!(strcmp(2, htmlentities($row_rspetugasdikoreksi['Agama'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Katolik</option>
        <option value="3" <?php if (!(strcmp(3, htmlentities($row_rspetugasdikoreksi['Agama'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Protestan</option>
        <option value="4" <?php if (!(strcmp(4, htmlentities($row_rspetugasdikoreksi['Agama'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Hindu</option>
        <option value="5" <?php if (!(strcmp(5, htmlentities($row_rspetugasdikoreksi['Agama'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Budha</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">IdLevel:</td>
      <td><select name="IdLevel">
        <?php 
do {  
?>
        <option value="<?php echo $row_rspillevel['IdLevel']?>" <?php if (!(strcmp($row_rspillevel['IdLevel'], htmlentities($row_rspetugasdikoreksi['IdLevel'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_rspillevel['NamaLevel']?></option>
        <?php
} while ($row_rspillevel = mysql_fetch_assoc($rspillevel));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Password:</td>
      <td><input type="password" name="Password" value="<?php echo $row_rspetugasdikoreksi['Password']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="IdPetugas" value="<?php echo $row_rspetugasdikoreksi['IdPetugas']; ?>" />
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="IdPetugas" value="<?php echo $row_rspetugasdikoreksi['IdPetugas']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rspetugasdikoreksi);

mysql_free_result($rspillevel);
?>
