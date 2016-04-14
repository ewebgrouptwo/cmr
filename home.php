<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMR Home</title>

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
	
</head>

<body>


    <div id="wrapper">

       <!-- Navigation -->
		<?php include('lib/nav_bar.php' ); // get the navigation contents, and echo it out.
			  include_once "authorise_check.php";
			  include_once "lib/dblib.php";//get dblib class
			  $role_id	= $_SESSION['role_id'];
			  
			  $perm 	= "SELECT pname FROM permission p 
							   INNER JOIN role_permission b on p.permission_id = b.permission_id
							   INNER JOIN role r ON r.role_id = b.role_id WHERE b.role_id='$role_id'";
			  $perm_rel = mysqli_query($con,$perm);
			  $perm_rows= mysqli_num_rows($perm_rel);

			if(isset($_POST['faculty_id'])){
				$faculty_id = ($_POST['faculty_id']);
			}
			  
		?>
		
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
						<?php 
							
							if (isset($_SESSION['logged_user'])){
								global $logged_user;
								
								if ($_SESSION['logged_user']=='admin'){
								$logged_user = strtolower($_SESSION['logged_user']);
								echo "Welcome Home <small>". ucwords($_SESSION['logged_user']) ."</small>";
								}else {
								echo "Home <small>Statistics Overview</small>";
								}
								
							}
							
						?>
							
                            
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-home"></i> Home
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

				<?php
				if (strtoupper($staffname)=="GUEST"){

				echo "<div class ='table-responsive'>
					<form action = 'home.php' method='POST'>
					<div class='row'>
						<div class='col-xs-12 col-sm-4 col-md-3 col-lg-2'><strong>Select Faculty</strong></div>
						<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4'>
							<select name='faculty_id' id='faculty' class='form-control' onchange=this.form.submit() required>
							<optgroup label='Select Faculty' />
							<option></option>";
						
							$fac_idq   = "SELECT faculty_id from faculty";
							$fac_id    = $dbconn->getData($fac_idq);//get the faculty  id's array
							$fac_nameq = "SELECT fname from faculty";
							$fac_name  = $dbconn->getData($fac_nameq);//get the faculty names array
							
							if(count($fac_id)>0 and count($fac_name)>0){
								
								for($i=0;$i<count($fac_id);$i++){
								echo "<option "; if($faculty_id==$fac_id[$i]){echo 'selected';}; echo " value='$fac_id[$i]'>". $fac_name[$i] ."</option>";
								}

							}
						
						echo "</select>	

					</div>
				</div>
				</form>
			  </div><br />";
					}
				?>
                              
					
				<?php 
				
					if($logged_user=="admin"){
					echo "<table id='tbl_staff' class='table table-condensed table-small-font'>
						<tr>
						<td>
							<div class='row'>
								<div class='col-xs-12 col-sm-5 col-md-6 col-lg-4'></div>
								<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4'>
									<img src='images/admin_lock.jpg' />
								</div>
							</div>
						</td>
						</tr>
						</table>
						 </div>";
					
					}else{
				
					for ($x=0; $x<$perm_rows; $x++){
								
					/*loop to display html links to various cmr tasks*/
						  $rows = mysqli_fetch_array($perm_rel);
						  $val = strtoupper($rows['pname']);
						
						if ($val=='CREATE CMR'){
							echo "<table id='tbl_staff' class='table table-condensed table-small-font'>
						<tr>
						<td>
							<div class='row'>
								<div class='col-xs-12 col-sm-5 col-md-6 col-lg-4'></div>
								<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4'>
									<img src='images/clhome.jpg' />
								</div>
							</div>
						</td>
						</tr>
						</table>
						 </div>";
						 
						 echo "Course Leader Home";
							}
						
						else if ($val=='APPROVE CMR'){

							echo "<div class='row'>
							<div class='col-lg-3 col-md-6'>
								<div class='panel panel-primary'>
									<div class='panel-heading'>
										<div class='row'>
											<div class='col-xs-3'>
												<i class='fa fa-file-text fa-5x'></i>
											</div>
											
											<div class='col-xs-9 text-right'>
												<div class='huge'>";
													
														$cmr = new cmr;
														echo $cmr->newCMR($faculty_id);
												echo"								
												</div>
												<div>CMRs Pending Approval</div>
											</div>
										</div>
									</div>
									<a href='cmr_list.php?cmr_status=Not Approved'>
										<div class='panel-footer'>
											<span class='pull-left'>View Details</span>
											<span class='pull-right'><i class='fa fa-arrow-right'></i></span>
											<div class='clearfix'></div>
										</div>
									</a>
								</div>
							</div>";
						
						}else if ($val=='COMMENT ON CMR'){
							echo "<div class='col-lg-3 col-md-6'>
									<div class='panel panel-red'>
										<div class='panel-heading'>
											<div class='row'>
												<div class='col-xs-3'>
													<i class='fa fa-comments fa-5x'></i>
												</div>
												<div class='col-xs-9 text-right'>
													<div class='huge'>";
														
															$cmr = new cmr;
															$cmr->approvedCMR($faculty_id);
													echo "										
													</div>
													<div>CMRs Pending Response</div>
												</div>
											</div>
										</div>
										<a href='cmr_list.php?cmr_status=Approved'>
											<div class='panel-footer'>
												<span class='pull-left'>View Details</span>
												<span class='pull-right'><i class='fa fa-arrow-right'></i></span>
												<div class='clearfix'></div>
											</div>
										</a>
									</div>
								</div>";
						}else if ($val=='VIEW CMR'){
							
							echo "<div class='col-lg-3 col-md-6'>
                        <div class='panel panel-green'>
                            <div class='panel-heading'>
                                <div class='row'>
                                    <div class='col-xs-3'>
                                        <i class='fa fa-check fa-5x'></i>
                                    </div>
                                    <div class='col-xs-9 text-right'>
                                        <div class='huge'>";
											
												$cmr = new cmr;
												$cmr->completeCMR($faculty_id);
												
									echo "											
										</div>
                                        <div>Completed CMRs!</div>
                                    </div>
                                </div>
                            </div>
                            <a href='cmr_list.php?cmr_status=Completed'>
                                <div class='panel-footer'>
                                    <span class='pull-left'>View Details</span>
                                    <span class='pull-right'><i class='fa fa-arrow-right'></i></span>
                                    <div class='clearfix'></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>";
							
						}
					}
					}
					?>
						
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
		<div id="load_page">
		<!--This is code block is where the system will dynamically change display content depending 
		on user function choice-->

		</div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

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