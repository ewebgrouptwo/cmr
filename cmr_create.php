<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<title>Add NEW CMR Form</title>

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
	include_once "authorise_check.php";
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
                            New CMR <small>In Progress</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>  <a href="home.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file-text"></i> New CMR
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
		
        <div id="page-wrapper">
		<div class="container-fluid">

		<!-- display a message after a record has been saved -->
		<?php
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
								<a href='cmr_create.php'><button type='button' class='btn btn-default'>Close</button></a>
							</div>
						</div>
						
					</div>
				</div>";
			}
		}
		?>
		
		<div class="row">
			<div class ="table-responsive">

				<form action = "savescripts/save_cmr.php" method="POST" onsubmit="return validateCMRFrm(this)" name="frm_cmr" id="frm_cmr" >
				<!-- on validateRegistration line to be used to validate user registration details -->
				<table id="tbl_cmr" class='table table-condensed table-small-font'>
				<tr>
				<td >
					<div class="row">
						<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">Student Count:</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
							<input class="form-control" type="text" name="scount"  size=3 maxlength=3 required />
						</div>
					</div>
				</td>
				</tr>
				<tr>
				<td >
					<div class="row">
						<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">Session:</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
							<select name="acsession"  class="form-control" required>
								<option></option>
								<option>2016</option>
								<option>2015</option>
							</select>
						</div>
					</div>
				</td>
				</tr>
				<tr>
				<td >
					<div class="row">
						<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">Course Name:</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
							<select name="ccode" class="form-control" required />
							<option></option>
								<?php 
								
								$staff_id 	= $_SESSION['staff_id'];
								$srole_id	= $_SESSION['role_id'];
								
								$cid_query  = "SELECT c.course_id FROM course c INNER JOIN staff_course f 
												ON f.course_id = c.course_id INNER JOIN staff x	
												ON x.staff_id = f.staff_id											  
												WHERE  x.staff_id='$staff_id'";
								$course_id 	 = $dbconn->getData($cid_query);//get the course id's allocated to a CL filling the form array
								$cname_query = "SELECT c.cname FROM course c INNER JOIN staff_course f 
												ON f.course_id = c.course_id INNER JOIN staff x	
												ON x.staff_id = f.staff_id											  
												WHERE  x.staff_id='$staff_id'";
								$cname		 = $dbconn->getData($cname_query);//get the faculty names array
								
								if(count($course_id)>0 and count($cname)>0){
									
									for($i=0;$i<count($course_id);$i++){
									echo "<option value='$course_id[$i]'>". $cname[$i] ."</option>";
									}
								}
								
								?>
		
							</select>	
						</div>
					</div>
				</td>
				</tr>
				</table>

				<table id="tbl_stats" class='table table-condensed table-small-font'>
				<tr>
				<td colspan=5><p id="gradedis_head">Statistical Data</p></td>
				</tr>
				<tr>
				<th class="grade_head"></th>
				<th class="grade_head">Course Work 1</th>
				<th class="grade_head">Course Work 2</th>
				<th class="grade_head">EXAM</th>
				</tr>
				
				<tr>
				<th class="grade_head">Mean</th>

				<td><input type="text" name="cw1_mean" class="form-control" id="numbers" maxlength=3 required /></td>
				<td><input type="text" name="cw2_mean" class="form-control" maxlength=3 required /></td>
				<td><input type="text" name="exam_mean" class="form-control" maxlength=3 required /></td>
				</tr>
				
				<tr>
				<th class="grade_head">Median</th>
				<td><input type="text" name="cw1_med" class="form-control" maxlength=3 required /></td>
				<td><input type="text" name="cw2_med" class="form-control" maxlength=3 required /></td>
				<td><input type="text" name="exam_med" class="form-control" maxlength=3 required /></td>
				</tr>
				
				<tr>
				<th class="grade_head">Standard Deviation</th>
				<td><input type="text" name="cw1_sdev" class="form-control" maxlength=3 required /></td>
				<td><input type="text" name="cw2_sdev" class="form-control" maxlength=3 required /></td>
				<td><input type="text" name="exam_sdev" class="form-control" maxlength=3 required /></td>
				</tr>
				
				</table>

				
				
				<table  class='table table-condensed table-small-font'>
				<tr>
				<td colspan=5><p id="gradedis_head">Grade Distribution</p></td>
				</tr>
				<tr>
				<th class="grade_head"></th>
				<th class="grade_head">Grade A</th>
				<th class="grade_head">Grade B</th>
				<th class="grade_head">Grade C</th>
				<th class="grade_head">Grade D</th>
				</tr>
				<tr>
				<th class="grade_head">Course Work 1</th>
				<td><input type="text" name="cw1_gradea" class="form-control" maxlength=3 required /></td>
				<td><input type="text" name="cw1_gradeb" class="form-control" maxlength=3 required /></td>
				<td><input type="text" name="cw1_gradec" class="form-control" maxlength=3 required /></td>
				<td><input type="text" name="cw1_graded" class="form-control" maxlength=3 required /></td>
				</tr>
				<tr>
				<tr>
				<th class="grade_head">Course Work 2</th>
				<td><input type="text" name="cw2_gradea" class="form-control" maxlength=3 required /></td>
				<td><input type="text" name="cw2_gradeb" class="form-control" maxlength=3 required /></td>
				<td><input type="text" name="cw2_gradec" class="form-control" maxlength=3 required /></td>
				<td><input type="text" name="cw2_graded" class="form-control" maxlength=3 required /></td>
				</tr>
					<tr>
				<th class="grade_head">Course Exam</th>
				<td><input type="text" name="exam_gradea" class="form-control" maxlength=3 required /></td>
				<td><input type="text" name="exam_gradeb" class="form-control" maxlength=3 required /></td>
				<td><input type="text" name="exam_gradec" class="form-control" maxlength=3 required /></td>
				<td><input type="text" name="exam_graded" class="form-control" maxlength=3 required /></td>
				</tr>
				<tr>

				<tr>
				<td id="sb_btn"><input class="btn btn-info" type="submit"  value="Submit CMR Report" id="cmrsub_btn" />
				<td colspan=5 id="dbsave_msg"><strong><em id="cmrfrmv_msg"></em></strong></td>
				</tr>
				</table>
				</form>

			</div>
		</div>
	</div>
		
  
  

<?php 

}else {
	
 echo "Error : " . mysqli_error($con);
}		

?>		
		
</div>

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