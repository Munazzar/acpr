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
  <link rel="stylesheet" href="xampp/htdocs/styles.css">
  <link rel="stylesheet" href="(link unavailable)">
</head>
<body>
  <div class="container">
    <h1>Customers</h1>
    <table id="customer-table" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>

          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($customer = mysqli_fetch_assoc($customers)) { ?>
        <tr>
          <td><?php echo $customer['ID']; ?></td>
          <td><?php echo $customer['NAME']; ?></td>
          <td><?php echo $customer['EMAIL']; ?></td>
          <td><?php echo $customer['PHONE']; ?></td>
          <td>
            <a href="edit-customer.php?id=<?php echo $customer['id']; ?>">Edit</a>
            <a href="delete-customer.php?id=<?php echo $customer['id']; ?>">Delete</a>
          </td>
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

  <script src="(link unavailable)"></script>
  <script src="(link unavailable)"></script>
  <script>
    $(document).ready(function() {
      $('#customer-table').DataTable();
    });
  </script>
</body>
</html>

