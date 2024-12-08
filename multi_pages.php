<?php
	
	//echo '<script type ="text/JavaScript">';  
	//echo 'alert("JavaScript Alert Box by PHP")';  
	//echo '</script>';  
	$filter_jobid = 0;
	$filter_phno = '';

	if (isset($_POST['filter_submit'])) {
		$filter_jobid = $_POST['filter_jobid'];
		$filter_phno = $_POST['filter_phno'];
	}

	require_once 'db.php';

	// Pagination variables
	$limit = 5;
	$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
	$offset = ($page - 1) * $limit;

	// Total cust_jobs count
	$total_cust_jobs = mysqli_query($conn, "SELECT COUNT(*) as total FROM CJOBM");
	$total_cust_jobs = mysqli_fetch_assoc($total_cust_jobs)['total'];

	//if (isset($_POST['dashboard_data'])  || isset($_POST['pagination'])) {
		// Customer query
		
		$query = "SELECT CJOBM_COMP_ID, CJOBM_JOB_ID, CJOBM_PH_NB, CJOBM_NO_OF_DOCS, CJOBM_STS, CJOBM_REQ_DT, CJOBM_RAPIDO_ID, CJOBM_RAPIDO_PERSON, CJOBM_RAPIDO_VEHICLE, CJOBM_DELIVERED_DATE FROM CJOBM";
		
		if ($filter_jobid || $filter_phno) {
			$query .= " WHERE ";
			if ($filter_jobid) {
				$query .= "CJOBM_JOB_ID = '$filter_jobid'";
			}
			if ($filter_phno) {
				if ($filter_jobid) {
					$query .= " AND ";
				}
				$query .= "CJOBM_PH_NB = '$filter_phno'";
			}

			//$query .= " LIMIT $offset, $limit";
			//$result = mysqli_query($conn, $query);
		}
		
		$query .= " LIMIT $offset, $limit";

	
		$cust_jobs = mysqli_query($conn, $query);

		//mysqli_close($conn);
	//}
?>

<!DOCTYPE html public>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Customer Jobs</title>
  <link rel="stylesheet" href="newstyles.css">

</head>
<body>

  <div style="width:100%; height:900px">
  		<div style="border:1px solid black;
  					width:99%;
  					height:80px;
  					background:blue;
  					text-align:center;
  					text-align:center;
  					font-family:Arial;
					font-size:60px;
					font-weight:bold;
					color:white;">

  			 Acube Xerox and Printing
  		</div>

  		<div style="display:flex; width=99%; height:800px">
  			<div style="border:1px solid black;
  								width:10%;
  								height:800px;
  								background:#b4a9b4;">
				<button id="NPJ" idname="DB" class="tweet-button" onclick="refreshListGrid(this.id)">Dash Board</button>
				<button id="NPJ" idname="NPJ" class="tweet-button" onclick="refreshListGrid(this.id)">New Printing Job</button>
				<button id="JH" idname="JH" class="tweet-button" onclick="refreshListGrid(this.id)">Job History</button>
				<button id="PT" idname="PT" class="tweet-button" onclick="refreshListGrid(this.id)">Price Teriff</button>
				<button id="USR" idname="USR" class="tweet-button" onclick="refreshListGrid(this.id)">Users</button>
				<button id="AL" idname="AL" class="tweet-button" onclick="refreshListGrid(this.id)">Audit Log</button>

				<form method="post">
				      <button class="tweet-button" type="submit" name="dashboard_data">Customer's Current Jobs</button>
				</form>
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				<img class="thumbnail" src="acubelogo.jpg">

			</div>

			<div style="border:1px solid black;
							width:89%;
							height:800px;
						background:white;">

                    <?php include 'grid_pag_filter.php'; ?>
			</div>

		</div>
			<div style="border:1px solid black;
			  					width:99%;
			  					height:80px;
			  					background:#660d80;
			  					text-align:center;
			  					text-align:center;
			  					font-family:Arial;
								font-size:15px;
								font-weight:bold;
								color:white;">

			  			 #G-7, Manzil Chambers, 12-2-825&826, Santosh Nagar Colony, Pillar No. 17, Mehdipatnam, Opp. Hyderabad, TS
			  			 <br>Ph: 9700654835, 9160934925, 7660977869
						 <br>Business Whatsapp No. : 8977548473
			  			 <br>E-Mail: 2011acx@gmail.com
  			</div>
		</div>
</body>
</html>

