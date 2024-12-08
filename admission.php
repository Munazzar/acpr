<?php
    session_start();
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

    $sql= "SELECT * FROM admission";

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

</head>
    <body>
        
    <?php
        include 'admin_sidebar.php';
    ?>

        <div class="content">
            <center>
                <h1>Applied For Admission</h1>

                <table border="1px">
                    <tr>
                        <th style="padding: 20px; font-size: 15px;">Name</th>
                        <th style="padding: 20px; font-size: 15px;">Email</th>
                        <th style="padding: 20px; font-size: 15px;">Phone</th>
                        <th style="padding: 20px; font-size: 15px;">Message</th>
                    </tr>
                    <?php

                        while($info=$result->fetch_assoc())
                        {
                    ?>
                    <tr>
                        <td style="padding: 20px; font-size: 15px;"> <?php echo "{$info['name']}"; ?></th>
                        <td style="padding: 20px; font-size: 15px;"> <?php echo "{$info['email']}"; ?></th>
                        <td style="padding: 20px; font-size: 15px;"> <?php echo "{$info['phone']}"; ?></th>
                        <td style="padding: 20px; font-size: 15px;"> <?php echo "{$info['message']}"; ?></th>
                    </tr>

                    <?php
                        }
                    ?>
                </table>
            </center>
        </div>

    </body>
</html>
