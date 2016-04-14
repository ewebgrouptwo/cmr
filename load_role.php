<?php 

 //require_once("authorise_check.php");
 include_once "lib/dblib.php";

 $dbconn = new dbconnection();
 $con =$dbconn->getConnection();

 if ($con){
	 
	if (isset($_POST['faculty_id'])){
		$faculty_id =$_POST['faculty_id'];
		$action		=$_POST['action'];
		
		if ($action=='staff_role' AND $faculty_id!='' ){
			/*execute code block to load roles for staff create file*/
			$role_idq  = "SELECT role_id FROM role WHERE role_id IN (SELECT role_id FROM faculty_role WHERE faculty_id='$faculty_id' and role_id>2)
							AND role_id NOT IN (SELECT b.role_id FROM faculty_role b INNER JOIN staff_role x ON b.frole_id = x.frole_id
							INNER JOIN faculty d ON d.faculty_id=b.faculty_id
							WHERE b.faculty_id='$faculty_id')";
			$role_id   = $dbconn->getData($role_idq);//get the role id array
			$role_nameq = "SELECT rname FROM role WHERE role_id IN (SELECT role_id FROM faculty_role WHERE faculty_id='$faculty_id' and role_id>2)
							AND role_id NOT IN (SELECT b.role_id FROM faculty_role b INNER JOIN staff_role x ON b.frole_id = x.frole_id
							INNER JOIN faculty d ON d.faculty_id=b.faculty_id
							WHERE b.faculty_id='$faculty_id')";
			$role_name = $dbconn->getData($role_nameq);//get the role name array
			
		
			echo "<select name='role' id='role' class='form-control' required>";
			echo "<optgroup label='Select Role' />";
			echo "<option></option>";
			if(count($role_id)>0 and count($role_name)>0){
						
				for($i=0;$i<count($role_id);$i++){
				echo "<option value='$role_id[$i]'>". $role_name[$i] ."</option>";
				}
			}
			echo "</select>";
		}
		elseif ($action=='faculty_role' AND $faculty_id!='') {
			/*code block to execute when the admin wants to assign faculty roles*/
			
		$rolequery	= "SELECT role_id, 
						rname 
						FROM role
						WHERE role_id NOT IN (SELECT role_id 
						FROM faculty_role WHERE faculty_id='$faculty_id') AND role_id!=1";//select roles that have not been assi
		
		$roleqrel	 = mysqli_query($con,$rolequery);
		
		if ($roleqrel){
			
			$rows_returned =mysqli_num_rows($roleqrel);
			
			if($rows_returned>0){
		
				echo "<table class='table table-condensed table-small-font'>";
				echo "<tr>
						<td>
						<div class='row'>
						<div class='col-xs-12 col-sm-4 col-md-3 col-lg-2'><strong id='roleheader'>Roles List</strong></div>
					  
						</div>
					  </td>
					  </tr>";
					   
					 				
					for ($i=0; $i<$rows_returned;$i++){
						$rows 	  = mysqli_fetch_array($roleqrel);
						$rid	  = $rows['role_id'];
						$rname	  = $rows['rname'];
						$variable = 'role_'.$i;
							echo "<tr>";
							echo "<td>";
							echo "<div class='checkbx'>";
							echo "<label><input type='checkbox' name='$variable' value='$rid'> ". $rname . "</label>";
							echo "</div>";
							echo "<tr>";
					}	
					
					echo"<tr>
						<td>
						<div class='row'>
							<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4'>
							<input class='btn btn-info' type='submit'  value='Assign faculty role(s)' id='assingpsub_btn' />
							<input type='hidden' name='rolecount' value='$rows_returned' />
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
							<strong id='roleheader'>Role data not available for assignment</strong>
							</div>		
								
						</div>
							
						</td>
						</tr>";					
				}
				echo "</table>";
		
		
		
		
		}
			
		
	 }
	}
 }
 else {
	
		echo mysqli_error($con) . "<br />";
		echo "Contact the system Admin for assistance";
 }	
 


?>