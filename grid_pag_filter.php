<?php
	
require_once 'db.php';


// Define the table and fields to display
$table = 'teacher';
$fields = array('ID', 'mobile', 'Name', 'Description', 'File Name', 'Download');

// Process the filter form
$filter_name = $_POST['name'] ?? $_GET['name'] ?? '';
$filter_email = $_POST['email'] ?? $_GET['email'] ?? '';

// Get the current page number
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;

// Build the query
//$query = "SELECT ";
//$query .= implode(', ', $fields);
//$query .= " FROM " . $table;

//$download = "<a class='btn btn-danger' onClick=\" javascript:return confirm('Are you sure to delete this user?'); \" href='delete.php?student_id={$info['id']}'>Delete</a>";

$query ="SELECT id, mobile, name, description, file_name from teacher";
//$query .= " FROM customers";


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
<meta charset="utf-8">
    
    <title> Pagination</title>
    
    <?php
        include 'admin_css.php';
    ?>

    
    <style type="text/css">
        
        .content
        {
            margin-left: 20%;
            margin-top: 5%;
            background-color:#d5cfce;
            width: 1200px;
            height: 720px;
            
        }
        .dev_deg 
        {
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left:5px;
            align: left;
            padding-right:10px;
            display:flex;
        }
        thead
        {
            font-size:21px;
            background-color: black;
            color: red;
        }
        label
        {
            font-size:18px;
            padding-left: 20px;
            color: blue;
            
        }
        

        tr:nth-last-child(odd) 
        {
            background-color: #a3a3a0;
        }

        tr:nth-last-child(even) 
        {
            background-color: #b4ae65;
        }
        

    </style>
      
</head>

<body>
    <?php
        include 'admin_sidebar.php';
    ?>
        
    <div class="content">
        <h2>Database Grid</h2>
        <div class="dev_deg">
            <div>
                <div >
                    
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" id="filter_form" name="filter_form" method="post">
                    <input type="hidden" name="form_name" value="form2" >    
                        <div>
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" value="<?php echo $filter_name; ?>"  class="select-box">
                        
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo $filter_email; ?>"  class="select-box">
                        
                            <button type="submit" name="filter_submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                
                </div>
            
            
                <div class="container">
                    <div class="row">
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
                                    
                                    <td class="table_td"> <?php echo "{$row['id']}"; ?></td>
                                    <td class="table_td"> <?php echo "{$row['mobile']}"; ?></td>
                                    <td class="table_td"> <?php echo "{$row['name']}"; ?></td>
                                    <td class="table_td"> <?php echo "{$row['description']}"; ?></td>
                                    <td class="table_td"> <?php echo "{$row['file_name']}"; ?></td>
                                    <td class="table_td"> <?php echo "<a class='btn btn-danger' onClick=\" javascript:return confirm('Are you sure to Download this Job?'); \" href='job_download.php?job_id={$row['id']}'>Download</a>"; ?></th>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div >
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
                    </div> 
        </div>
    </div>
</body>
</html>