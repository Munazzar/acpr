<?php
session_start();
require_once 'db.php';

// Authentication
//if (!isset($_SESSION['logged_in'])) {
//  header('Location: login.php');
//  exit;
//}

// Get customer and order data
$customers = mysqli_query($conn, "SELECT * FROM customers");
$orders = mysqli_query($conn, "SELECT * FROM orders");
$printers = mysqli_query($conn, "SELECT * FROM printers");
$print_jobs = mysqli_query($conn, "SELECT * FROM print_jobs");

// Close database connection
//mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acube Xerox Dashboard</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="(link unavailable)">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Customers</a></li>
        <li><a href="#">Orders</a></li>
        <li><a href="#">Printers</a></li>
        <li><a href="#">Print Jobs</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <section class="dashboard-overview">
      <h1>Dashboard Overview</h1>
      <div class="card">
        <h2>Customers</h2>
        <p><?php echo mysqli_num_rows($customers); ?></p>
      </div>
      <div class="card">
        <h2>Orders</h2>
        <p><?php echo mysqli_num_rows($orders); ?></p>
      </div>
      <div class="card">
        <h2>Printers</h2>
        <p><?php echo mysqli_num_rows($printers); ?></p>
      </div>
      <div class="card">
        <h2>Print Jobs</h2>
        <p><?php echo mysqli_num_rows($print_jobs); ?></p>
      </div>
    </section>
    <section class="recent-orders">
      <h1>Recent Orders</h1>
      <table>
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Order Date</th>
            <th>Total Cost</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($order = mysqli_fetch_assoc($orders)) { ?>
          <tr>
            <td><?php echo $order['id']; ?></td>
            <td><?php echo $order['customer_id']; ?></td>
            <td><?php echo $order['order_date']; ?></td>
            <td><?php echo $order['total_cost']; ?></td>
            <td><?php echo $order['status']; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </section>
  </main>
  <footer>
    <p>&copy; 2023 Acube Xerox</p>
  </footer>
</body>
</html>
