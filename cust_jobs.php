<?php
	
require_once 'db.php';

$scrid = '';
if (isset($_POST['current_jobs']) )
{
    $filter_name = ''; 
    $filter_email = '';
    $scrid='current_jobs';
    echo '<script type ="text/JavaScript">';  
		echo 'alert("1) filter: ' . $scrid . '" )';  
		echo '</script>'; 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['form_name'])) {
        if (($_POST['form_name'] == 'form2') )
        {
            echo '<script type ="text/JavaScript">';  
            echo 'alert("3) filter: ' . $scrid . '" )';  
            echo '</script>'; 
        }
    }
}

// Define the table and fields to display
$table = 'customers';
$fields = array('id', 'name', 'email', 'phone');

// Process the filter form
$filter_name = $_POST['name'] ?? $_GET['name'] ?? '';
$filter_email = $_POST['email'] ?? $_GET['email'] ?? '';

// Get the current page number
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;

// Build the query
$query = "SELECT ";
$query .= implode(', ', $fields);
$query .= " FROM " . $table;

if ($filter_name || $filter_email) {
    
    echo '<script type ="text/JavaScript">';  
		echo 'alert("2) filter: ' . $scrid . '" )';  
		echo '</script>'; 
    
    $query .= " WHERE ";
    if ($filter_name) {
        $query .= "name LIKE '%" . $filter_name . "%'";
    }
    if ($filter_email) {
        if ($filter_name) {
            $query .= " AND ";
        }
        $query .= "email LIKE '%" . $filter_email . "%'";
    }
}

// Paginate the results
$records_per_page = 10;
$offset = ($page - 1) * $records_per_page;

$query .= " LIMIT $offset, $records_per_page";

// Execute the query
$result = $conn->query($query);

// Get the total number of records
$total_records = $conn->query("SELECT COUNT(*) as total FROM " . $table)->fetch_assoc()['total'];

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Grid</title>
    <link rel="stylesheet" href="newstyles.css">
</head>

<body>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="dashboard_formm" name="dashboard_form" method="post">
		<input type="hidden" name="form_name" value="form1">		      
        <button class="tweet-button" type="submit" name="current_jobs">Current Jobs</button>
                      <button class="tweet-button" type="submit" name="jobs_history">Jobs History</button>
		</form>

    </div>

    
    <div class="container">
        <?php if ($scrid == 'current_jobs')  { ?>
            <h1>Filter</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="filter_form" name="filter_form" method="post">
            <input type="hidden" name="form_name" value="form2">    
            <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $filter_name; ?>">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $filter_email; ?>">
                <button type="submit" name="filter_submit">Filter</button>
            </form>
        <?php } ?>
    </div>
    
    <div class="container">
        <h1>Database Grid</h1>
        <table id="grid-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <?php foreach ($fields as $field) { ?>
                    <th><?php echo ucfirst($field); ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <?php foreach ($fields as $field) { ?>
                    <td><?php echo $row[$field]; ?></td>
                    <?php } ?>
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
                echo '<a href="?page=' . $previous_page . '&name=' . $filter_name . '&email=' . $filter_email . '">Previous</a> ';
            }
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $page) {
                    echo '<span>' . $i . '</span> ';
                } else {
                    echo '<a href="?page=' . $i . '&name=' . $filter_name . '&email=' . $filter_email . '">' . $i . '</a> ';
                }
            }
            if ($page < $total_pages) {
                echo '<a href="?page=' . $next_page . '&name=' . $filter_name . '&email=' . $filter_email . '">Next</a> ';
            }
            ?>
        </div>
    </div>
</body>
</html>