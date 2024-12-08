<?php
require_once 'db.php';

// Filter criteria
$filter_name = '';
$filter_email = '';
$filter_phone = '';

if (isset($_POST['filter_submit'])) {
    $filter_name = $_POST['filter_name'];
    $filter_email = $_POST['filter_email'];
    $filter_phone = $_POST['filter_phone'];
}

// Pagination
$records_per_page = 10;
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Query the database
$query = "SELECT * FROM customers";

$query .= " LIMIT $offset, $records_per_page";

$result = $conn->query($query);

// Get the total number of records
$total_records = $conn->query("SELECT COUNT(*) as total FROM customers")->fetch_assoc()['total'];

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Customer List</h1>
        <form method="post">
            <label for="filter_name">Name:</label>
            <input type="text" id="filter_name" name="filter_name" value="<?php echo $filter_name; ?>">
            <label for="filter_email">Email:</label>
            <input type="email" id="filter_email" name="filter_email" value="<?php echo $filter_email; ?>">
            <label for="filter_phone">Phone:</label>
            <input type="text" id="filter_phone" name="filter_phone" value="<?php echo $filter_phone; ?>">
            <button type="submit" name="filter_submit">Filter</button>
        </form>
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
                <?php while ($row = $result->fetch_assoc()) { ?>
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
            $total_pages = ceil($total_records / $records_per_page);
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
</body>
</html>