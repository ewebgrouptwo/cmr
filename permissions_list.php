<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Permission List</title>

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
	
	<!--custom css-->
	<link href="css/cmr.css" rel="stylesheet">
	
	<script src="js/jquery.min.js"></script>
	<script src="js/cmr_javascript.js"></script>

</head>

<body>

<?php

	include_once "lib/permission_class.php";
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
                            Permissions <small> List</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>  <a href="home.php">Home</a>
                            </li>
							
							<li>
                                <i class="fa fa-text"></i>  System Administration </a>
                            </li>
							<li>
                                <i class="fa fa-text"></i>  Permission</a>
                            </li>
							
                            <li class="active">
                                <i class="fa fa-list-ul"></i> Update permissions
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				
                <div class="row">
                    <div class="col-lg-12">
					<div class ="table-responsive">
						<?php
							$fac = new permission();
							$fac->viewpermissionList();
						?>
                    </div>
					</div>
                </div>
				
				
				
				
				
		<?php
		
		$head;
		$message;
		$footer;
		
		
		echo 	"<script> $(document).ready(function(){
					 $('#testmodal').modal();
					});

			</script>";
			
		$head;
		$message;
		$footer='';

		if (isset($_POST['table_id'])) {
			  
			  $id	 		   = $_POST['table_id'];
			  $query 		   = "SELECT * FROM permission WHERE permission_id='$id'";
			  $queryrel		   = $dbconn->getDataItem($query);
			  $permission_id   = $queryrel['permission_id'];
			  $pname		   = $queryrel['pname'];
			  $pdescription    = $queryrel['pdescription'];
			
			$head	 ="UPDATE $pname PERMISSION";
			$message = "
						
							<div class='row'>
								<div class ='table-responsive'>
									<form action = 'savescripts/update_permission.php' method='POST'  name='frm_managerperm' id='frm_managerperm' >
									
									<table id='tbl_managerperm' class='table table-condensed table-small-font'>
										<tr>
										<td>
											<div class='row'>
												<div class='col-xs-12 col-sm-4 col-md-3 col-lg-2'><strong>Name</strong></div>
												<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4'>
													<input class='form-control' type='text' name='pname' placeholder='$pname'  size=30 required />
												</div>
											</div>
										</td>
										</tr>
										
										<tr>
										<td>
											<div class='row'>
												<div class='col-xs-12 col-sm-4 col-md-3 col-lg-2'><strong>Description</strong></div>
												<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4'>
													<input class='form-control' type='text' name='pdescription' placeholder='$pdescription'  size=30 required />
												</div>
											</div>
										</td>
										</tr>
																				
										<tr>
										<td>
										<div class='row'>
													
												<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4'>
												<input class='btn btn-info' type='submit'  value='Update permission' id='permissionsub_btn' />
												<input type='hidden' name='permission_id' value='$permission_id' />
												</div>
										</div>	
										</td>
										</tr>
								     </table>
									 </form>";
								
			
		}
		elseif (isset($_GET['update_head'])){
			$head       = $_GET['update_head'];
			$message    = $_GET['update_msg'];
			$footer     = "<div class='modal-footer'>
							<a href='permissions_list.php'><button type='button' class='btn btn-default'>Close</button></a>
							</div>";
		}
		 
		 if (isset($_GET['update_head']) OR isset($_POST['table_id'])){
			
			echo "	<!-- database save message modal -->
				<div class='modal fade' id='testmodal'>
				<div class='modal-dialog'>
				
					<div class='modal-content'>
							<div class='modal-header'>
							<h4 id='msg_header'> $head</h4>
							</div>
							<div class='modal-body'>
								$message
							</div>
							    $footer
						</div>
						
				</div>
					
				</div>
			</div>";
		 }
	
				
?>
				
				
				
				
			</div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
<?php 

}
else {
	echo mysqli_error($con);
}
?>
</body>

</html>

				
				
				
				
				
				
				