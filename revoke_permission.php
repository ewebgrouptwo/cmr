<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<title>Revoke Role Permissions</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!--custom css-->
	<link href="css/cmr.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script src="js/cmr_javascript.js"></script>

</head>
<body>

<?php

	include_once "lib/dblib.php";
	$dbconn = new dbconnection();
	$con = $dbconn ->getConnection();

if($con){
	
	
?>

<div id="wrapper">

       <!-- Navigation -->
		<?php include('lib/nav_bar.php' ); // get the navigation contents, and echo it out.?>

        <div id="page-wrapper">
		
		<div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Revoke Role Permissions
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>  <a href="home.php">Home</a>
                            </li>
							
							<li>
                                <i class="fa fa-text"></i>  System Administration </a>
                            </li>
							<li>
                                <i class="fa fa-text"></i>  Role</a>
                            </li>
                          							
							<li class="active">
                                <i class="fa fa-file-text"></i> Revoke Role Permission
                            </li>
							
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
		
	<div id="page-wrapper">
		<div class="container-fluid">

		<div class="row">
			<div class ="table-responsive">
			
			<form action = "savescripts/revoke_perm.php" method="POST"  name="frm_revokeperm" id="frm_revokeperm" >
				<!-- on validateRegistration line to be used to validate user registration details -->
				<table id="tbl_rperm" class='table table-condensed table-small-font'>
					
					<tr>
					<td>
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2"><strong>Select Role</strong></div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
								<select name="role_id" id="role" class="form-control" onchange="loadpermission(this)" required>
								<optgroup label="Select Role" />
								<option></option>
								<?php 
								
								$role_idq   = "SELECT role_id from role WHERE role_id>1";
								$role_id    = $dbconn->getData($role_idq);//get the role  id's array
								$rnameq 	= "SELECT rname from role WHERE role_id>1";
								$rname  	= $dbconn->getData($rnameq);//get the role names array
								
								if(count($role_id)>0 and count($rname)>0){
									
									for($i=0;$i<count($role_id);$i++){
									echo "<option value='$role_id[$i]'>". $rname[$i] ."</option>";
									}
								}
								
								?>
								</select>		
							<input type='hidden' name='ptype' value='revoke_perm' id='ptype' />								
							</div>
						</div>
					</td>
					</tr>
					
				</table>
				
				<p id='tbl_permchkbox'></p>
				
				
				
				</form>

			</div>
		</div>
		</div>

<?php 

/* check if there is a database save message to display to the user*/

	if (isset($_GET['msg_head'])) {
        $msg_head = $_GET['msg_head'];
        $msg_cont = $_GET['msg_cont'];
		
		if ($msg_head!=""){
		   echo 	"<script> $(document).ready(function(){
					 $('#testmodal').modal();
					});

			</script>";
			
			echo "	<!-- database save message modal -->
				<div class='modal fade' id='testmodal'>
				<div class='modal-dialog'>
					<div class='modal-content'>
						<div class='modal-header'>
								<h4 id='msg_header'> $msg_head </h4>
						</div>
						<div class='modal-body'>
								<p> $msg_cont</p>
						</div>
						<div class='modal-footer'>
							<a href='revoke_permission.php'><button type='button' class='btn btn-default'>Close</button></a>
						</div>
					</div>
					
				</div>
			</div>";
		}
	}
	
	echo "</div>";
	
}else {
	
 echo "Error : " . mysqli_error($con);
}		

?>		
		

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
		
</body>
</html>