<?php
    session_start();
    error_reporting(0);
    if(!isset($_SESSION['username']))
    {
        header("location:login.php");
    }
    elseif($_SESSION['usertype']=="student")
    {
        header("location:login.php");
    }

    $host="localhost";
    $user="root";
    $password="";
    $db = "acpr";

    $data=mysqli_connect($host,$user,$password,$db);

    $sql= "SELECT * FROM usrm where usertype='student'";

    $result=mysqli_query($data, $sql);
    
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="admin.css">

    <?php
        include 'admin_css.php';
    ?>

    <style>
        .table_th
        {
            padding:20px;
            font-size:20px;
        }

        .table_td
        {
            padding: 20px; 
            font-size: 15px;
            background-color:skyblue;
        }
    </style>


</head>
    <body>
        <?php
            include 'admin_sidebar.php';
        ?>

        <div class="content">
            <center>
                <h1>Student Data</h1>
                <?php 
                    if ($_SESSION['message'])
                    {
                        echo $_SESSION['message'];
                    }

                    unset($_SESSION['message']);
                ?>
                <br><br>

                <table border="1px">
                    <tr>
                        <th class="table_th">UserName</th>
                        <th class="table_th">Email</th>
                        <th class="table_th">Phone</th>
                        <th class="table_th">Passowrd</th>
                        <th class="table_th">Delete</th>
                        <th class="table_th">Update</th>
                    </tr>
                    <?php

                        while($info=$result->fetch_assoc())
                        {
                    ?>
                    <tr>
                        <td class="table_td"> <?php echo "{$info['username']}"; ?></th>
                        <td class="table_td"> <?php echo "{$info['email']}"; ?></th>
                        <td class="table_td"> <?php echo "{$info['phone']}"; ?></th>
                        <td class="table_td"> <?php echo "{$info['password']}"; ?></th>
                        <td class="table_td"> <?php echo "<a class='btn btn-danger' onClick=\" javascript:return confirm('Are you sure to delete this user?'); \" href='delete.php?student_id={$info['id']}'>Delete</a>"; ?></th>
                        <td class="table_td"> <?php echo "<a class='btn btn-primary'  href='update_student.php?student_id={$info['id']}'>Update</a>"; ?></th>
                    </tr>

                    <?php
                        }
                    ?>
                </table>
            </center>
            
        </div>

    </body>
</html>
