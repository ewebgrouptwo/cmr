<?php
include_once "lib/dblib.php";
$dbcon = new dbconnection();

$con = $dbcon ->getConnection ();

if ($con){

	if (isset($_POST['username']) AND isset($_POST['password'])){
		
		$username = mysqli_real_escape_string($con,$_POST['username']);
		$password = mysqli_real_escape_string($con,$_POST['password']);
		
	}
}
