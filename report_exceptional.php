<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Exceptional Report</title>

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

include_once "lib/report.php";

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
                            Reports <small> Exceptional</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>  <a href="home.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Exceptional Reports
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i>  <strong>You may select a report to view</strong>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-graduation-cap fa-5x"></i>
                                        <i class="fa fa-users fa-1x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
											<?php 
												$course_no_clm = new report;
												echo $course_no_clm->count_courses_with_no_cl_or_cm();
											?>								
										</div>
                                        <div>Courses Without CL/CM</div>
                                    </div>
                                </div>
                            </div>
                            <a href="report_exp_detail.php?type=noclm">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
					
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-graduation-cap fa-5x"></i>
                                        <i class="fa fa-file-text-o fa-1x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
											<?php 
												$missing_cmr = new report;
												echo $missing_cmr->count_courses_with_no_cmr();
											?>
										</div>
                                        <div>Courses without a CMR</div>
                                    </div>
                                </div>
                            </div>
                            <a href="report_exp_detail.php?type=nocmr">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
					
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                        <i class="fa fa-comments fa-1x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
											<?php 
												$missing_response = new report;
												echo $missing_response->count_cmr_with_no_response();
											?>										
										</div>
                                        <div>CMRs Without Response!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="report_exp_detail.php?type=noresponse">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
					
                </div>
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
