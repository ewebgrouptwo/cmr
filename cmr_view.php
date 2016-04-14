<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMR Approval</title>

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

<?php

	include_once "lib/cmr_approve_class.php";
	
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
                            Course Monitoring Report <small> Review</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>  <a href="home.php">Home</a>
                            </li>
                            <li>
                                <i class="fa fa-list-ul"></i> <a href="cmr_list.php">Review CMRs</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file-text-o"></i> CMR # <?php echo ($_POST['cmr_id']); ?>
                            </li>
                        </ol>

                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
					<div class ="table-responsive">
						<?php
							$open_cmr = new open_cmr;
							$faculty_id =1;
							$cmr_id = ($_POST['cmr_id']);
							$cmr_status = ($_POST['cmr_status'])
							$open_cmr->login_id =1;
							echo $open_cmr->display_cmr($cmr_id);

						?>
                    </div>
					</div>
                </div>
                <!-- /.row -->

						<?php
							$open_cmr = new open_cmr;
							$cmr_id = ($_POST['cmr_id']);
							$cmr_status = ($_POST['cmr_status'])
							$open_cmr->login_id =1;
							$cmr_status = ($_POST['cmr_status'])
							if ($cmr_status="Not Approved"){
								echo $open_cmr->approve_or_decline_cmr($cmr_id);			
								echo $open_cmr->cmr_response($cmr_id);
							} elseif ($cmr_status="Completed"){
								echo $open_cmr->cmr_response($cmr_id, $cmr_status);
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

</body>

</html>
