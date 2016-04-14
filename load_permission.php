<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<title>Assign Role Permissions</title>

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

 //require_once("authorise_check.php");
 include_once "lib/dblib.php";

 $dbconn = new dbconnection();
 $con =$dbconn->getConnection();

 if ($con){
	
	 
	if (isset($_POST['role'])){
		$role_id =$_POST['role'];
		$ptype   =$_POST['ptype'];
		
		if ($ptype=='assign_perm' AND $role_id!=''){
			$permquery	 = "SELECT permission_id, 
							pname 
							FROM permission
							WHERE permission_id NOT IN (SELECT permission_id 
							FROM role_permission WHERE role_id='$role_id') AND permission_id>1";//select permissions that have not been assi
			
			$permqrel	 = mysqli_query($con,$permquery);
			
			if ($permqrel){
				
				$rows_returned =mysqli_num_rows($permqrel);
				
				if($rows_returned>0){
			
					echo "<table class='table table-condensed table-small-font'>";
					echo "<tr>
							<td>
							<div class='row'>
							<div class='col-xs-12 col-sm-4 col-md-3 col-lg-2'><strong id='permheader'>Permissions List</strong></div>
						  
							</div>
						  </td>
						  </tr>";
						   
										
						for ($i=0; $i<$rows_returned;$i++){
							$rows 	  = mysqli_fetch_array($permqrel);
							$pid 	  = $rows['permission_id'];
							$pname	  = $rows['pname'];
							$variable = 'permission_'.$i;
								echo "<tr>";
								echo "<td>";
								echo "<div class='checkbx'>";
								echo "<label><input type='checkbox' name='$variable' value='$pid'> ". $pname . "</label>";
								echo "</div>";
								echo "<tr>";
						}	
						
						echo"<tr>
							<td>
							<div class='row'>
								<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4'>
								<input class='btn btn-info' type='submit'  value='Grant Permission(s)' id='assingpsub_btn' />
								<input type='hidden' name='permcount' value='$rows_returned' />
								</div>		
									
							</div>
								
							</td>
							</tr>";
						
						
						  
					}
					else {
						echo"<tr>
						<td>
						<div class='row'>
							<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4'>
							<strong id='roleheader'>No permission available for role assignment </strong>
							</div>		
								
						</div>
							
						</td>
						</tr>";
					}
					echo "</table>";	
			}
		}
		elseif ($ptype=="revoke_perm" AND $role_id!=''){
			$permquery	 = "SELECT permission_id, 
							pname 
							FROM permission
							WHERE permission_id IN (SELECT permission_id 
							FROM role_permission WHERE role_id='$role_id')";//select permissions that have not been assi
			
			$permqrel	 = mysqli_query($con,$permquery);
			
			if ($permqrel){
				
				$rows_returned =mysqli_num_rows($permqrel);
				
				if($rows_returned>0){
			
					echo "<table class='table table-condensed table-small-font'>";
					echo "<tr>
							<td>
							<div class='row'>
							<div class='col-xs-12 col-sm-4 col-md-3 col-lg-2'><strong id='permheader'>Permissions List</strong></div>
						  
							</div>
						  </td>
						  </tr>";
						   
										
						for ($i=0; $i<$rows_returned;$i++){
							$rows 	  = mysqli_fetch_array($permqrel);
							$pid 	  = $rows['permission_id'];
							$pname	  = $rows['pname'];
							$variable = 'permission_'.$i;
								echo "<tr>";
								echo "<td>";
								echo "<div class='checkbx'>";
								echo "<label><input type='checkbox' name='$variable' value='$pid'> ". $pname . "</label>";
								echo "</div>";
								echo "<tr>";
						}	
						
						echo"<tr>
							<td>
							<div class='row'>
								<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4'>
								<input class='btn btn-info' type='submit'  value='Revoke Permission(s)' id='assingpsub_btn' />
								<input type='hidden' name='permcount' value='$rows_returned' />
								</div>		
									
							</div>
								
							</td>
							</tr>";
						
						
						echo "</table>";	  
					}
					else {
						echo "<strong id='permheader'>The selected role does not have permissions assigned to it</div>";
					}
			}
			
			
			
		}
		
		
			  
		
		
	}
 }
 else {
	
		echo mysqli_error($con) . "<br />";
		echo "Contact the system Admin for assistance";
 }	
 


?>
</body>
</html>