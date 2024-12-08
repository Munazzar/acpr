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
            <h1>Sidebar Accordion</h1>

            <p>Bootstrap The most popular HTML, CSS, and JS library in 
                the world Bootstrap ttps://getbootstrap.
                
                com Get started any
                 way you want. Jump right into building with Bootstrap
                 use the CDN </p>
        </div>

    </body>
</html>
