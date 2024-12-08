<?php
    session_start();
    $host="localhost";
    $user="root";
    $password="";
    $db = "acpr";

    $conn=mysqli_connect($host,$user,$password,$db);

    if($_GET['job_id'])
    {
        $job_id=$_GET['job_id'];

        $sql = "SELECT mobile, file_name, long_file FROM teacher WHERE id = '$job_id'";
        //$result = $conn->query($sql);
        $result = mysqli_query($conn, $sql);

        // Check if the file exists
        if ($result->num_rows > 0) {
            // Get the file data
            $row = $result->fetch_assoc();
            //$row = mysqli_fetch_object($result);
            $mobile = $row['mobile'];
            $file_name = $row['file_name'];
            $file_data = $row['long_file'];

            $directory_path = 'C:/acubejobs/' . $mobile . '/' . $job_id;

            // Check if the directory already exists
            if (!file_exists($directory_path)) {
                // Create the directory
                if (mkdir($directory_path, 0777, true)) {
                    echo "Directory created successfully!";
                } else {
                    echo "Error creating directory!";
                }
            } 
             
            

            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file_name . '"');
            header('Content-Length: ' . strlen($file_data));
            echo $file_data;
            
            $file_path = $directory_path . '/' . $file_name;
            $fp = fopen($file_path, 'wb');
            fwrite($fp, $file_data);
            fclose($fp);

            
            exit;
            
            
        } else {
            echo "File not found.";
        }
    } else {
        echo "File ID not set.";
    }

?>