<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Statistics</title>

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

	<link rel="stylesheet" href="css/plugins/morris.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/plugins/morris/raphael.min.js"></script>
	<script src="js/plugins/morris/morris.min.js"></script>

</head>

<body>

<?php
	include_once('lib/report.php');
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
                            Reports <small> Statistical Charts</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>  <a href="home.php">Home</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart"></i> Statistical Report 
                            </li>
                        </ol>

                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
					<div class ="table-responsive">

					<!-- Morris Charts -->

					<div class="row">
						<div class="col-lg-4">
							<div class="panel panel-yellow">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Number of Completed CMRs </h3>
								</div>
								<div class="panel-body">
									<!--the chart -->
									<div id="complete_cmr_number"></div>

									<div class="text-right">
										<a href="report_stat_detail.php?type=complete_cmr_num">View Details <i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="panel panel-red">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Completed CMRs (%) </h3>
								</div>
								<div class="panel-body">
									<div id="complete_cmr_percentage"></div>
									<div class="text-right">
										<a href="report_stat_detail.php?type=complete_cmr_per">View Details <i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-4">
							<div class="panel panel-red">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> CMR Responses (%) </h3>
								</div>
								<div class="panel-body">
									<div id="response_cmr_percentage"></div>
									<div class="text-right">
										<a href="report_stat_detail.php?type=response_cmr_per">View Details <i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>
							</div>
						</div>
                    </div>
					
					<div class="row">
						<div class="col-lg-4">
							<div class="panel panel-red">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> Overall Student Pass Rate</h3>
								</div>
								<div class="panel-body">
									<div id="pass_rate"></div>
									<div class="text-right">
										<a href="report_stat_detail.php?type=pass_rate">View Details <i class="fa fa-arrow-circle-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> CMR Summary - Numbers </h3>
								</div>
								<div class="panel-body">
									<div id="sum_cmr"></div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="panel panel-red">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-long-arrow-right"></i> CMR Summary (%) </h3>
								</div>
								<div class="panel-body">
									<div id="percent_cmr"></div>
								</div>
							</div>
						</div>
						</div>

					</div>
					</div>
					</div>
                <!-- /.row -->

				<?php
					//create cmr report object
					$statistical_result = new report;
					//get values for Completed CMR graph
					$rows = $statistical_result->getCompletedCMR();
					//get values for percentage of cmr pie chart
					$percentage_completed = $statistical_result->getPercentageCMR();
					//get values for cmr percentage of response pie chart
					$response = $statistical_result->getPercentageResponse();
					//get value for statistical summary (numbers) bar chart
					$statistics = $statistical_result->getStatisticSummary();
					//get values for cmr overall in percentage for bar chart
					$percentage_overall = $statistical_result->getOverallPercentage();
					//get value for overall student passrate
					$pass_rate = $statistical_result->get_pass_rate();
				?>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

	<!--this is where the charts are created-->
	<script>
	 
	Morris.Line({
		// ID of the element in which to draw the chart.
		element: 'complete_cmr_number',
		behaveLikeLine: true,
		// Chart data records -- each entry in this array corresponds to a point
		// on the chart.
		data: <?php echo json_encode($rows);?>,
	 
		// The name of the data record attribute that contains x-values.
		xkey: 'academic_session',
	 
		// A list of names of data record attributes that contain y-values.
		ykeys: ['completed_cmr'],
	 
		// Labels for the ykeys -- will be displayed when you hover over the
		// chart.
		labels: ['Completed CMRs'],
	 
		lineColors: ['#0b62a4'],
		xLabels: 'year',
	 
		// Disables line smoothing
		smooth: true,
		resize: true
	});

		Morris.Donut({
		  element: 'complete_cmr_percentage',
		  data: <?php echo json_encode($percentage_completed);?>,
		  formatter: function (x) { return x + "%"}
	  });	
		  
		Morris.Donut({
		  element: 'pass_rate',
		  data: <?php echo json_encode($pass_rate);?>,
			  labelColor: '#000',
			  colors: [
				'#FF0000',
				'#FFFF00',
				'#FFA500',
				'#008000'
			  ],
		  formatter: function (x) { return x + "%"}
	  });	
		  
		Morris.Donut({
		  element: 'response_cmr_percentage',
		  data: <?php echo json_encode($response);?>,
		    backgroundColor: '#ccc',
			  labelColor: '#060',
			  colors: [
				'#0BA462',
				'#39B580',
				'#67C69D',
				'#95D7BB'
			  ],
		  formatter: function (x) { return x + "%"}
	  });	
		  
		Morris.Bar({
		  element: 'sum_cmr',
		  data: <?php echo json_encode($statistics);?>,
		  xkey: 'Academic Year',
		  ykeys: ['Total Completed', 'Total Approved', 'Total Response'],
		  labels: ['Total Completed', 'Total Approved', 'Total Response']
		}).on('click', function(i, row){
		  console.log(i, row);
		});	

		Morris.Bar({
		  element: 'percent_cmr',
		  data: <?php echo json_encode($percentage_overall);?>,

		  xkey: 'Academic Year',
		  ykeys: ['Percentage Completed', 'Percentage Approved', 'Percentage Response'],
		  labels: ['Percentage Completed', 'Percentage Approved', 'Percentage Response']

		}).on('click', function(i, row){
		  console.log(i, row);
		});	
		
	</script>

	
    <!-- jQuery -->	



    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

    <!-- Flot Charts JavaScript -->
    <!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="js/plugins/flot/flot-data.js"></script>

</body>

</html>
