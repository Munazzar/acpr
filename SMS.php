<?php
    error_reporting(0);
    session_start();
    session_destroy();

    if($_SESSION['message'])
    {
        $message = $_SESSION['message'];
        echo "<script type='text/javascript'>
            alert('$message');
        </script>";
    }


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset=""utf-8">
        <title> Student Management System</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        
        <!-- latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- optional theme -->
    <script rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027vyjSMfHjOMaLKfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

       </head>
    <body> 
        <nav>
            <label class="logo">W-School</label>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Contact</a></li>
                <li><a href="">Admission</a></li>
                <li><a href="login.php" class="btn btn-success">Login</a></li>
            </ul>
        </nav>

        <div class="section1">
           <label class="img_text">We Teach STudents With Care</label>
            <img class="main_img" src="school_management.jpg">
        </div>

        <div class="container"> 
            
            <div class="row">

                <div class="col-md-4">
                    <img class="welcome_img" src="school2.jpg">
                </div>

                <div class="col-md-8">
                    <h1>Welcome to W-School </h1>
                    <p>Bootstrap · The most popular HTML, CSS, and JS library in the world Bootstrap ttps://getbootstrap.com Get started any way you want. Jump right into building with Bootstrap—use the CDN, install it via package manager, or download the source code. Read ...
                        </p>
                </div>
            
            </div>
        </div>

        <center>
            <h1>Our Teachers<h1>
        </center>

        <div class="container"> 
            
            <div class="row">

                <div class="col-md-4">
                    <img class="teacher" src="teacher1.jpg">
                    <p>Bootstrap · The most popular HTML, CSS, and JS library in the world Bootstrap 
                        </p>
                </div>
                <div class="col-md-4">
                    <img class="teacher" src="teacher2.jpg">
                    <p>Bootstrap · The most popular HTML, CSS, and JS library in the world Bootstrap 
                        </p>
                </div>
                <div class="col-md-4">
                    <img class="teacher" src="teacher3.jpg">
                    <p>Bootstrap · The most popular HTML, CSS, and JS library in the world Bootstrap 
                        </p>
                </div>
            
            </div>

        <center>
            <h1>Our Course<h1>
        </center>

        <div class="container"> 
            
            <div class="row">

                <div class="col-md-4">
                    <img class="teacher" src="marketing.jpg">
                    <h3>Project Printing
                    </h3>
                </div>
                <div class="col-md-4">
                    <img class="teacher" src="marketing.jpg">
                    <h3>Thesis Printing and Binding 
                        </h3>
                </div>
                <div class="col-md-4">
                    <img class="teacher" src="marketing.jpg">
                    <h3>Thermal Binding 
                        </h3>
                </div>
            
            </div>
        </div>

        <center>
            <h1 class="adm">Registration Form<h1>
        </center>

        <div align="center" class="admission_form"> 
            <Form action="data_check.php" method="POST">
                <div class="adm_int">
                    <label class="label_text">Name</label>
                    <input class="input_deg" type="text" name="name">
                </div>
                <div class="adm_int">
                    <label class="label_text">Email</label>
                    <input class="input_deg" type="text" name="email">
                </div>
                <div class="adm_int">
                    <label class="label_text">Phone</label>
                    <input class="input_deg" type="text" name="phone">
                </div>
                <div class="adm_int">
                    <label class="label_text">Message</label>
                    <textarea class="input_txt" name="message"></textarea>
                </div>
                <div>
                    <input class="btn btn-primary" type="submit" id="submit" 
                    value="apply" name="apply">
                </div>
            </form>
        </div>

        <footer>
            <h3 class="footer_text">All @opyright reserved by ACube Xerox</h3>
        </footer>

    </body>
</html>
