<?php 

//include_once "authorise_check.php";//check if user has logged in
	include_once "lib/dblib.php";//get dblib class
	include_once "lib/staff_class.php";//get dblib class
	$dbconn = new dbconnection();
	$con =$dbconn->getConnection();
	
	
	if($con){

		if (isset($_POST['search'])){
			
			$username = trim(mysqli_real_escape_string($con,$_POST['search']));
			$staff    = new staff();
			$staff->viewStaff($username);
	
		}
	}
	else {
		
		echo mysqli_error($con);
	}

?>