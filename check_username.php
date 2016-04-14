<?php

//require_once("authorise_check.php");
 include_once "lib/dblib.php";

 $dbconn = new dbconnection();
 $con =$dbconn->getConnection();

 if ($con){
	 
	 if(isset($_POST['username'])){
		 $username =$_POST['username'];
		 $query    = "SELECT * FROM user_account WHERE username='$username'";
		 $qresults = $dbconn->checkdataitem($query);
		  
		 if ($qresults ==0){
			 /*run code when username does not exist*/
			 echo true;
			
			 
		 }
		 else {
			/*code to run when username match is found in the database*/
			
			echo 0;
		 }
	}
	 
 }
 else {
	 echo mysqli_error($con);
 }


