<?php 

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMR user password reset</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<link href="css/cmr.css" rel="stylesheet">
	
	<script src="js/jquery.min.js"></script>
	<script src="js/cmr_javascript.js"></script>
	
</head>

<body>


<?php

	//include_once "authorise_check.php";
	include_once "lib/dblib.php";//get dblib class
	
	$dbconn = new dbconnection();
	$con =$dbconn->getConnection();
		
	if($con){
	/*get the session variables*/
	
	
?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="home.php"><i class="fa fa-fw fa-university"></i>  University CMR Web App</a>
	</div>

</nav>


<div id="page-wrapper">
		<div class="container-fluid">

		<div class="row">
			<?php 
				/*execute data modal if we have data*/
				
				echo 	"<script> $(document).ready(function(){
					 $('#testmodal').modal();
					});

			</script>";
			
	

	if (isset($_GET['update_head'])){
		$head       = $_GET['update_head'];
		$message    = $_GET['update_msg'];
			
			echo "	<!-- database save message modal -->
				<div class='modal fade' id='testmodal' data-backdrop='static' >
				<div class='modal-dialog'>
				
					<div class='modal-content'>
							<div class='modal-header'>
							<h4 id='msg_header'> $head</h4>
							</div>
							<div class='modal-body'>
								$message
							</div>
							    <div class='modal-footer'>
							<a href='index.php'><button type='button' class='btn btn-default'>Close</button></a>
							</div>
						</div>
						
				</div>
					
				</div>
				</div>";
	}
				
				
				
				/*run php code to get user details for the userpass with default password*/
				 $username = $_SESSION["username"];
				 $password = md5("default");
				 
				  $query	  	= "SELECT a.login_id, a.role_id, s.staff_id,s.fname,lname FROM user_account a INNER JOIN
								 staff_login f ON f.login_id =a.login_id INNER JOIN staff s ON f.staff_id =s.staff_id
								 WHERE a.username='$username' and a.password='$password'";
				
				 $query_rel = $dbconn->getDataItem($query);
				
				 if($query_rel){

			?>
			<div class ="table-responsive">
				<form action = "savescripts/update_userpass.php" method="POST" onsubmit="return validatepassresetForm(this)" name="frm_userpass" id="frm_userpass" >
				
				<table id="tbl_userpass" class='table table-condensed table-small-font'>
					<tr>
					<td>
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-3 col-lg-4"></div>
							<div class="col-xs-12 col-sm-4 col-md-3 col-lg-4"><?php echo ucfirst(strtolower($query_rel['fname'])) . " " .ucfirst(strtolower($query_rel['lname'])) . " change your default password to proceed"; ?> </div>
							
					</td>
					</tr>
					
					
					<tr>
					<td>
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-3 col-lg-4"></div>
							<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
								<input class="form-control" type="password" name="oldpass" onclick='clearErrorMsg()' placeholder='Current password' size=30 required />
							</div>
						</div>
					</td>
					</tr>
					<tr>
					<td>
						<div class="row">
						<div class="col-xs-12 col-sm-4 col-md-3 col-lg-4"></div>
						<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
								<input class="form-control" type="password" name="newpass" onclick='clearErrorMsg()' placeholder='New Password' size=30 required />
							</div>
							
						<?php 
						
							echo "<input type='hidden' name='username' value='$username' />" ;
							
							?>
						
						</div>
					</td>
					</tr>
					
					<tr>
					<td>
						<div class="row">
						<div class="col-xs-12 col-sm-4 col-md-3 col-lg-4"></div>
						<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
								<input class="form-control" type="password" name="confpass" onclick='clearErrorMsg()' placeholder='Confirm New Password' size=30 required /> 
							</div>
						</div>
					</td>
					</tr>
					<tr>
					<td>
						<div class="row">
						<div class="col-xs-12 col-sm-4 col-md-3 col-lg-4"></div>
						<div class="col-xs-12 col-sm-4 col-md-3 col-lg-4">		
						<em id='confpasswrd'></em></div>
						</div>
					</td>
					</tr>	
					<tr>
					<td>
					<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-3 col-lg-4"></div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
							<input class="btn btn-info" type="submit"  value="Update Password" id="userpasssub_btn" />
							
							</div>		
								
					</div>
							
					</td>
					</tr>
					
				</table>
				</form>
		
			  </div>
			</div>
		</div>
		
<?php 
	
		 }
	}
	else {
		echo "user details not found";
	}

	
?>

  <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>