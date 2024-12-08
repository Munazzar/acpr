<?php
require_once 'db.php';

// Check if button is clicked
if (isset($_POST['display_data_all'])) {
  $query = "SELECT * FROM customers";
  $title = "All Customers";
} elseif (isset($_POST['display_data_active'])) {
  $query = "SELECT * FROM customers WHERE status = 'active'";
  $title = "Active Customers";
} elseif (isset($_POST['display_data_inactive'])) {
  $query = "SELECT * FROM customers WHERE status = 'inactive'";
  $title = "Inactive Customers";
}

if (isset($query)) {


  // Pagination variables
  $limit = 10;
  $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
  $offset = ($page - 1) * $limit;

  // Query with pagination
  $query .= " LIMIT $offset, $limit";
  $result = mysqli_query($conn, $query);

  // Total rows count
  $total_rows = mysqli_query($conn, "SELECT COUNT(*) as total FROM customers");
  $total_rows = mysqli_fetch_assoc($total_rows)['total'];

  // Close database connection
  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Display Database Data</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Display Database Data</h1>
    <form method="post">
      <button type="submit" name="display_data_all">Display All Customers</button>
      <button type="submit" name="display_data_active">Display Active Customers</button>
      <button type="submit" name="display_data_inactive">Display Inactive Customers</button>
    </form>
    <?php if (isset($query)) { ?>
    <h2><?php echo $title; ?></h2>
    <table id="customer-table" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>

        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['phone']; ?></td>

        </tr>
        <?php } ?>
      </tbody>
    </table>
    <div class="pagination">
      <?php
      $total_pages = ceil($total_rows / $limit);
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
    <?php } ?>
  </div>
</body>
</html>