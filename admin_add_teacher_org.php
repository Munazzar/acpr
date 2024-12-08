<?php
    session_start();
    //error_reporting(0);

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

    if(isset($_POST['add_teacher']))
    {
        $name = $_POST['name'];
        $desc = $_POST['description'];
        
        $file_name = rand(100,1000) . "_" . $_FILES['image']['name'];

        $imgData=addslashes(file_get_contents($_FILES['image']['tmp_name']));
        //$imgData=file_get_contents($_FILES['image']['tmp_name']);

        $file_path = $_FILES["image"]["tmp_name"];

        $uploads_dir='/files';
        
        move_uploaded_file($file_path, $uploads_dir.'/'.$file_name);      

                    $message=   $file_name;
                    echo "<script type='text/javascript'>
                        alert('$message');
                    </script>";
                
        $sql="INSERT INTO TEACHER (NAME, DESCRIPTION, file_name, long_file) VALUES ('$name', '$desc', '$file_name','{$imgData}')";

                $result = mysqli_query($data, $sql);

                if($result)
                {
                    header('location:admin_add_teacher.php');
                    $message="Data uploaded successfully";
                    echo "<script type='text/javascript'>
                        alert('$message');
                    </script>";
                }
                else{
                    header('location:admin_add_teacher.php');
                    $message="Data upload failed";
                    echo "<script type='text/javascript'>
                        alert('$message');
                    </script>";
                }
        
    }  
    
    
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Admin Dashboard</title>

    <style type="text/css">
        label
        {
            display: inline-block;
            text-align: right;
            width: 100px;
            padding-top: 10px;
            padding-botton: 10px;
        }

        .dev_deg 
        {
            background-color:skyblue;
            width: 400px;
            padding-top: 70px;
            padding-bottom: 70px;
        }
        
    </style>

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
                <h1>Add Teacher</h1>

                <div class="dev_deg">
                    <form action="#" method="POST" enctype="multipart/form-data">>
                        <div>
                            <label>Teacher Name</label> <input type="text" name="name">
                        </div>
                        <div>
                            <label>Description</label> <input type="text" name="description">
                        </div>
                        <div>
                            <label>Image</label> <input type="file" name="image"  accept=".pdf">
                        </div>
                        
                        <div>
                            <input type="submit" class="btn btn-primary" name="add_teacher" 
                            value="Add Teacher">
                        </div>
                    </form>

                </div>

            </center>
        </div>

            

    </body>
</html>
