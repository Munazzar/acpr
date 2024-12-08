<?php
    session_start();
    if(!isset($_SESSION['username']))
    {
        header("location:login.php");
    }
    elseif($_SESSION['usertype']=="admin")
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

    <!-- latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- optional theme -->
    <script rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027vyjSMfHjOMaLKfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



</head>
    <body>
        <header class="header">
            <a href="">Student Dashboard</a>
            <div class="logout">
                <a href="logout.php" class="btn btn-primary">Logout</a>
            </div>
        </header>

        <aside>
            <ul>
                
                    <li>
                        <a href="">My Courses</a>

                    </li>
                    <li>
                        <a href="">My Result</a>

                    </li>
                                
            </ul>

        </aside>

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