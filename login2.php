<?php 
if (!isset($_SESSION)) session_start();
?>
<?php 
if (isset($_POST['bLogin'])) {
	include("simbvkota.php");
	$uname=filter_var($_POST['Username'],FILTER_SANITIZE_STRING);
	$upass=filter_var($_POST['Password'],FILTER_SANITIZE_STRING);
	$sql="select * from petugas where NamaPetugas='".$uname."' and Password='".$upass."'";
	//echo $sql;exit();
	@$q=mysqli_query($kon,$sql);
	$r=mysqli_fetch_array($q);
	if (empty($r)) {
	echo 'Gagal login!'; 
	}
	if (!empty($r)) {
		echo $r['NamaPetugas'];
		echo " ";
		echo $r['Password'];
		echo "||";
		exit();
	}
}
?>