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

    $id=$_GET['student_id'];
    $sql="SELECT * FROM USRM WHERE ID='$id'";
    $result = mysqli_query($data, $sql);

    $info=$result->fetch_assoc();

    if(isset($_POST['update']))
    {
        $username = $_POST['name'];
        $user_email = $_POST['email'];
        $user_phone = $_POST['phone'];
        $user_password = $_POST['password'];
        $user_type = "student";

        $query="update usrm set username='$username', email='$user_email', phone='$user_phone', password='$user_password' WHERE id='$id'";
        $result2=mysqli_query($data, $query);
        
        if($result2)
        {
            header("location:view_student.php");    
            $message="Data update successfully";
                echo "<script type='text/javascript'>
                    alert('$message');
                </script>";
            }
            else{
                $message="Data update failed";
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
    <title> Student Dashboard</title>

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
                <h1>Update Student</h1>

                <div class="dev_deg">
                    <form action="#" method="POST">
                        <div>
                            <label>User Name</label> <input type="text" name="name" value="<?php echo "{$info['username']}"; ?>">
                        </div>
                        <div>
                            <label>Email</label> <input type="email" name="email" value="<?php echo "{$info['email']}"; ?>">
                        </div>
                        <div>
                            <label>Phone</label> <input type="number" name="phone" value="<?php echo "{$info['phone']}"; ?>">
                        </div>
                        <div>
                            <label>Password</label> <input type="password" name="password" value="<?php echo "{$info['password']}"; ?>">
                        </div>
                        <div>
                            <input type="submit" class="btn btn-primary" name="update" value="update">
                        </div>
                    </form>

                </div>

            </center>
        </div>

    </body>
</html>   