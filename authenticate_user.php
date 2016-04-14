<?php 
	session_start();

	if (isset($_POST['username']) and isset($_POST['password'])){//code to only run if there is  a username and password set
		
		include_once "lib/dblib.php";

		$dbconn = new dbconnection();
		$con =$dbconn->getConnection();

		if ($con){
			$username = mysqli_real_escape_string($con,$_POST['username']);	
			$password = md5(mysqli_real_escape_string($con,$_POST['password']));	
			
			
			if (strtoupper($username)=="ADMIN" OR strtoupper($username)=="GUEST"){
				
					$authenticate = $dbconn->authenticateUser($username,$password); //authenticate user	
					
					if($authenticate!=0){
					
					$_SESSION["login_id"]   = $authenticate['login_id'];
					$_SESSION["role_id"]    = $authenticate['role_id'];
					$_SESSION['logged_user']= strtolower($authenticate['username']);
					$_SESSION["Authorised"] = "Y";//authorise user
					header("Location: home.php"); 
					}
					else{
						$login_msg="username or password incorrect";
						header("Location: index.php?login_msg=".$login_msg); 
					}
				
			}else {
					$authenticate = $dbconn->authenticateUser($username,$password); //authenticate user		
					
					if($authenticate!=0){
						
						if($password==md5('default')){
						   $_SESSION["username"] = $username;
						   header("Location: user_passreset.php"); 
							
						}
						else{
						/*set sessions for login and tracking of the logged user*/
						$_SESSION["login_id"]   = $authenticate['login_id'];
						$_SESSION["role_id"]    = $authenticate['role_id'];
						$_SESSION["staff_id"]	= $authenticate['staff_id'];
						$_SESSION['logged_user']= strtolower($authenticate['fname'] . " " .$authenticate['lname']); 
						$_SESSION["Authorised"]= "Y";//authorise user
					
						header("Location: home.php"); 
						}
					}
					else{
						$login_msg="username or password incorrect...";
						header("Location: index.php?login_msg=".$login_msg); 
					}
			}
			
			
		}else
		{
			echo mysqli_error($con) . "<br />";
			echo "Contact the system Admin for assistance";
		}	
	}
	else {
		/*force user to login before accessing system part*/
		
		header("Location: not_authorised.php"); 
		
	}


?>