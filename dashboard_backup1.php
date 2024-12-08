<?php
require_once 'db.php';

// Pagination variables
$limit = 5;
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Customer query
$customer_query = "SELECT * FROM customers LIMIT $offset, $limit";
$customers = mysqli_query($conn, $customer_query);

// Total customers count
$total_customers = mysqli_query($conn, "SELECT COUNT(*) as total FROM customers");
$total_customers = mysqli_fetch_assoc($total_customers)['total'];

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customers</title>
  <link rel="stylesheet" href="styles.css">

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
  								background:black;">
				<button id="DB" idname="DB" class="tweet-button" onclick="refreshListGrid(this.id)">Dashboard</button>
				<button id="NPJ" idname="NPJ" class="tweet-button" onclick="refreshListGrid(this.id)">New Printing Job</button>
				<button id="JH" idname="JH" class="tweet-button" onclick="refreshListGrid(this.id)">Job History</button>
				<button id="PT" idname="PT" class="tweet-button" onclick="refreshListGrid(this.id)">Price Teriff</button>
				<button id="USR" idname="USR" class="tweet-button" onclick="refreshListGrid(this.id)">Users</button>
				<button id="AL" idname="AL" class="tweet-button" onclick="refreshListGrid(this.id)">Audit Log</button>
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				<img class="thumbnail" src="acubelogo.jpg">

			</div>

			<div style="border:1px solid black;
							width:89%;
							height:800px;
						background:grey;">
				<h1>Customers</h1>
				<table id="customer-table" class="table table-striped table-bordered" >
				  <thead>
					<tr>
					  <th>ID</th>
					  <th>Name</th>
					  <th>Email</th>
					  <th>Phone</th>
					</tr>
				  </thead>
				  <tbody>
					<?php while ($customer = mysqli_fetch_assoc($customers)) { ?>
					<tr class="<?php echo $class; ?>">
					  <td><?php echo $customer['ID']; ?></td>
					  <td><?php echo $customer['NAME']; ?></td>
					  <td><?php echo $customer['EMAIL']; ?></td>
					  <td><?php echo $customer['PHONE']; ?></td>

					</tr>
					<?php } ?>
				  </tbody>
				</table>
				<div class="pagination">
				      <?php
				      $total_pages = ceil($total_customers / $limit);
				      $previous_page = $page - 1;
				      $next_page = $page + 1;

				      if ($page > 1) {
				        echo '<a href="?page=' . $previous_page . '">Previous</a> ';
				      }

				      for ($i = 1; $i <= $total_pages; $i++) {
				        if ($i == $page) {
				          echo '<span>' . $i . '</span> ';
				        } else {
				          echo '<a href="?page=' . $i . '">' . $i . '</a> ';
				        }
				      }

				      if ($page < $total_pages) {
				        echo '<a href="?page=' . $next_page . '">Next</a> ';
				      }
				      ?>
    			</div>

			</div>
		</div>
			<div style="border:1px solid black;
			  					width:99%;
			  					height:80px;
			  					background:#8686f1;
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




  <script>
    //$(document).ready(function() {
    //  $('#customer-table').DataTable();
    //});
  </script>
</body>
</html>

