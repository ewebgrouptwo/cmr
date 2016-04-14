<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<title>Add New Faculty</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<script src="js/jquery.min.js"></script>
	
	<!--custom css-->
	<link href="css/cmr.css" rel="stylesheet">
	

	<script src="js/cmr_javascript.js"></script>
	<script src="js/jquery.min.js"></script>
	
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
                           New Staff 
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>  <a href="home.php">Home</a>
                            </li>
							
							<li>
                                <i class="fa fa-text"></i>  System Administration </a>
                            </li>
							<li>
                                <i class="fa fa-text"></i>  Staff </a>
                            </li>
                          							
							<li class="active">
                                <i class="fa fa-file-text"></i> New Staff
                            </li>
							
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
		
        <div id="page-wrapper">
		<div class="container-fluid">

		<div class="row">
			<div class ="table-responsive">
				<form action = "savescripts/save_staff.php" method="POST" onsubmit="return validateStaffForm(this)" name="frm_staff" id="frm_staff" >
				<!-- on validateRegistration line to be used to validate user registration details -->
				<table id="tbl_staff" class='table table-condensed table-small-font'>
					<tr>
					<td>
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2"><strong>Firstname</strong></div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
								<input class="form-control" type="text" name="fname"  size=30 required />
							</div>
						</div>
					</td>
					</tr>
					<tr>
					<td>
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2"><strong>Lastname</strong></div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
								<input class="form-control" type="text" name="lname"  size=30 required />
							</div>
						</div>
					</td>
					</tr>
					
					<tr>
					<td >
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2"><strong>Sex</strong></div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
								<select name="sex" id="sex" class="form-control" required >
									<optgroup label="Sex" />
									<option></option>
									<option>Male</option>
									<option>Female</option>
								</select>
								
							</div>
						</div>
					</td>
					</tr>
					
					<tr>
					<td >
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2"><strong>Date of Birth</strong></div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
								<select name="dob_day" id="dob_day" required >
								<optgroup label="Day" />
								<option></option>
								<?php 
								for ($i=1; $i < 32; $i++){
								echo "<option>" . $i . "</option>";
								}
								?>
								</select>
								<select name="dob_month"  id="dob_month" required >
								<optgroup label="Month" />
								<option></option>
								<?php 
								
								$month_lbl = array("January", "February", "March","April","May","June","July","August","September","October","November","December");
									for ($i=1; $i<13;$i++){
										echo "<option value='$i'>" . $month_lbl[$i-1] . "</option>";
									}			
								?>
								</select>	
								
								<select name="dob_year"  id="dob_year" required >
								<optgroup label="Year" />
								<option></option>
								<?php
									$current_year = date("Y")-18;
									$start_year   = $current_year - 48;
									
									for ($i=$current_year; $i > $start_year; $i--){
										echo "<option>" . $i . "</option>";
									}
								?>
								</select>

								
							</div>
						</div>
					</td>
					</tr>
					<tr>
					<td>
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2"><strong>Email</strong></div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
								<input class="form-control" type="text" name="email" onclick="clearControl()" size=30 required />
								
							</div>
							<div class="col-xs-6 col-sm-3 col-md-3 col-lg-2">
							 <p><em id="email_msg"></em></p>
							 
							</div>
						</div>
					</td>
					</tr>
					
					<tr>
					<td>
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2"><strong>Qualification</strong></div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
								<input class="form-control" type="text" name="qualification"  size=30 required />
							</div>
						</div>
					</td>
					</tr>
					
					<tr>
					<td>
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2"><strong>Assign Faculty</strong></div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
								<select name="faculty_id" id="faculty" class="form-control" onchange="loadrole(this)" required>
								<optgroup label="Select Faculty" />
								<option></option>
								<?php 
								
								$fac_idq   = "SELECT faculty_id from faculty";
								$fac_id    = $dbconn->getData($fac_idq);//get the faculty  id's array
								$fac_nameq = "SELECT fname from faculty";
								$fac_name  = $dbconn->getData($fac_nameq);//get the faculty names array
								
								if(count($fac_id)>0 and count($fac_name)>0){
									
									for($i=0;$i<count($fac_id);$i++){
									echo "<option value='$fac_id[$i]'>". $fac_name[$i] ."</option>";
									}
								}
								
								?>
								</select>	

							<input type='hidden' name='action' value='staff_role' id='action' />
							</div>
						</div>
					</td>
					</tr>
					
					<tr>
					<td>
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2"><strong>Assign Role</strong></div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
							<p id="dynamic_role" ><select name="role" id="role" class="form-control" required>
												<optgroup label="Select Role" />
												<option></option>
													
												</select>
							</p>
							</div>
						</div>
					</td>
					</tr>
					
					<tr>
					<td>
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2"><strong>Username</strong></div>
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
								<input class="form-control" type="text" name="username" onkeyup="checkUser(this)" size=30 required />
							</div>
							<div class="col-xs-6 col-sm-3 col-md-3 col-lg-2">
							 <p><em id="username_msg"></em></p>
							 
							</div>
						</div>
					</td>
					</tr>	
					

					<tr>
					<td>
					<div class="row">
							
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
							<input class="btn btn-info" type="submit"  value="Add Staff" id="staffsub_btn" />
							
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
							<a href='staff_create.php'><button type='button' class='btn btn-default'>Close</button></a>
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





