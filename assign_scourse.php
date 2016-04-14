<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<title>Assign Staff to Course</title>

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
                           Assign Staff to Course
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>  <a href="home.php">Home</a>
                            </li>
							
							<li>
                                <i class="fa fa-text"></i>  System Administration </a>
                            </li>
							<li>
                                <i class="fa fa-text"></i>  Staff</a>
                            </li>
                          							
							<li class="active">
                                <i class="fa fa-file-text"></i> Assign Staff to Course
                            </li>
							
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
		
	<div id="page-wrapper">
		<div class="container-fluid">

		<div class="row">
			<div class ="table-responsive">
			
			<form action = "savescripts/save_staffcourse.php" method="POST"  name="frm_rpermission" id="frm_rpermission" >
				<!-- on validateRegistration line to be used to validate user registration details -->
				<table id="tbl_rpermission" class='table table-condensed table-small-font'>
					
					<tr>
					<td>
						<div class="row">
							
							<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
								<?php 
									
									if (isset($_POST['table_id'])){
										$username = $_POST['table_id'];
										$sql_fac="SELECT s.staff_id,
														 s.fname AS Firstname,
														 s.lname AS Lastname,
														 s.email AS Email, 
														 f.faculty_id,
														 f.fname AS Faculty
													FROM staff s INNER JOIN staff_role r ON r.staff_id =s.staff_id 
													INNER JOIN faculty_role b ON b.frole_id= r.frole_id
													INNER JOIN faculty f ON f.faculty_id = b.faculty_id
													INNER JOIN staff_login p ON p.staff_id = s.staff_id
													INNER JOIN user_account x ON x.login_id=p.login_id 
													WHERE x.username ='$username'";
										
										
													
										$udetails = $dbconn->getDataItem($sql_fac);
										$staff_id = $udetails['staff_id'];
										$fname 	  = ucfirst(strtolower($udetails['Firstname']));
									    $lname	  = ucfirst(strtolower($udetails['Lastname']));
										$fac_id   = $udetails['faculty_id'];
										$fac_name = $udetails['Faculty'];
										
										echo "<h4> Assign courses to " . $fname . " " . $lname . "</h4>";
										echo "<input type='hidden' name='staff_id' value='$staff_id' />";
									
							echo"</div>
								 </div>
								 </td>
								 </tr>";
								 
							$courseq =  "SELECT c.course_id, 
											    c.cname
												FROM course c 
												INNER JOIN faculty f ON f.faculty_id = c.faculty_id
												WHERE c.course_id NOT IN (SELECT c.course_id
														 FROM staff s 
														 INNER JOIN staff_role r ON r.staff_id =s.staff_id 
														 INNER JOIN staff_course p ON p.staff_id = s.staff_id
														 INNER JOIN course c ON c.course_id=p.course_id
														 INNER JOIN staff_login x on x.staff_id =s.staff_id
														 INNER JOIN user_account t ON t.login_id = x.login_id
														 WHERE t.username ='$username') AND f.faculty_id='$fac_id'";
								 $course_rel   = mysqli_query($con,$courseq);
								 
								 $course_count = mysqli_num_rows($course_rel);
							
								 if ($course_count>0){	 
								 
								 echo "
								 					 
								 <tr>
								 <td>
								 <div class='row'>
									<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4'>
									<strong id='permheader'>". ucfirst(strtolower($fac_name)). " Faculty Course List</strong>							
								 </div>
								 </div
								 </td>
								 </tr>";				 
								 
								
									 
									 for($i=0; $i<$course_count; $i++){
										 $rows 	 =mysqli_fetch_array($course_rel);
										 $pid 	  = $rows['course_id'];
										 $cname	  = $rows['cname'];
										 $variable= 'course_'.$i;
											echo "<tr>";
											echo "<td>";
											echo "<div class='checkbx'>";
											echo "<label><input type='checkbox' name='$variable' value='$pid'> ". $cname . "</label>";
											echo "</div>";
											echo "<tr>";
									 }		
									echo"<tr>
										<td>
										<div class='row'>
											<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4'>
											<input class='btn btn-info' type='submit'  value='Assign Course(s)' id='assingpsub_btn' />
											<input type='hidden' name='coursecount' value='$course_count' />
											<input type='hidden' name='staff_id' value='$staff_id' />
											</div>		
												
										</div>
											
										</td>
										</tr>";
										
									 
								 }
								 else {
									 echo "
								 					 
									 <tr>
									 <td>
									 <div class='row'>
										<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4'>
										<strong id='permheader'>No Course Data Available to assign to this user</strong>							
									 </div>
									 </div
									 </td>
									 </tr>
									 
									 <tr>
									 <td>
									 <div class='row'>
										<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4'>
										<a href='search_staff.php'><input class='btn btn-info' type='button'  value='< Back' id='staffsub_btn' /></a>
									 </div>
									 </div
									 </td>
									 </tr>";
									 
									 
									 
									 
								 }
								 
								echo "</table>";
								 
								 
							}
							?>  
					
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
							<a href='search_staff.php'><button type='button' class='btn btn-default'>Close</button></a>
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






