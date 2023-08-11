<?php 

ob_start();
session_start(); 


$_SESSION['username'] = null;
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;
$_SESSION['role'] = null;

header("Location: ../index.php");
//echo "<script>setTimeout(\"location.href='/CMS_TEMPLATE/admin';\",1500);</script>";
//echo "<script type='text/javascript'>toastr.warning('User Logged out.')</script>";

?>
