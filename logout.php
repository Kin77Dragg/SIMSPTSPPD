<?php 
if (!isset($_SESSION)) session_start();
$_SESSION['SB_u']='';
unset($_SESSION['SB_u']);
session_destroy();
echo "<script>window.location.href='login.php';</script>";
?>