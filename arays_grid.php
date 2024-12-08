<?php

// Define the data arrays
$data = array(
    array('Name' => 'John Doe', 'Age' => 25, 'Country' => 'USA'),
    array('Name' => 'Jane Doe', 'Age' => 30, 'Country' => 'Canada'),
    array('Name' => 'Bob Smith', 'Age' => 35, 'Country' => 'UK'),
    array('Name' => 'Alice Johnson', 'Age' => 20, 'Country' => 'Australia'),
    array('Name' => 'Mike Brown', 'Age' => 40, 'Country' => 'USA'),
    array('Name' => 'Emma Taylor', 'Age' => 28, 'Country' => 'Canada'),
    array('Name' => 'David Lee', 'Age' => 32, 'Country' => 'UK'),
    array('Name' => 'Sophia Patel', 'Age' => 25, 'Country' => 'Australia'),
    array('Name' => 'Oliver Kim', 'Age' => 38, 'Country' => 'USA')
);

// Define the column headers
$column_headers = array('Name', 'Age', 'Country');

// Define the filter fields
$filter_fields = array('Name', 'Country');

// Define the pagination settings
$records_per_page = 5;
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;

// Create the filter form
echo '<form method="get">';
foreach ($filter_fields as $filter_field) {
    echo '<label for="' . $filter_field . '">' . $filter_field . ':</label>';
    echo '<input type="text" id="' . $filter_field . '" name="' . $filter_field . '">';
}
echo '<button type="submit">Filter</button>';
echo '</form>';

// Apply the filters
$filtered_data = $data;
foreach ($filter_fields as $filter_field) {
    $filter_value = $_GET[$filter_field] ?? '';
    if ($filter_value) {
        $filtered_data = array_filter($filtered_data, function($row) use ($filter_field, $filter_value) {
            return strpos($row[$filter_field], $filter_value) !== false;
        });
    }
}

// Paginate the data
$paginated_data = array_slice($filtered_data, ($page - 1) * $records_per_page, $records_per_page);

// Create the data grid
echo '<table border="1">';
echo '<tr>';
foreach ($column_headers as $column_header) {
    echo '<th>' . $column_header . '</th>';
}
echo '</tr>';
foreach ($paginated_data as $row) {
    echo '<tr>';
    foreach ($column_headers as $column_header) {
        echo '<td>' . $row[$column_header] . '</td>';
    }
    echo '</tr>';
}
echo '</table>';

// Create the pagination links
echo '<div class="pagination">';
for ($i = 1; $i <= ceil(count($filtered_data) / $records_per_page); $i++) {
    echo '<a href="?page=' . $i . '">' . $i . '</a> ';
}
echo '</div>';

?>