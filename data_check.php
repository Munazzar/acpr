<?php
    error_reporting(0);
    session_start();
    $host="localhost";
    $user="root";
    $password="";
    $db = "acpr";

    $data=mysqli_connect($host,$user,$password,$db);

    if($data===false)
    {
        die("connecction error");
    }

    IF(isset($_POST['apply']))
    {
        $data_name=$_POST['name'];
        $data_email=$_POST['email'];
        $data_phone=$_POST['phone'];
        $data_msg=$_POST['message'];

        $sql="INSERT INTO admission(name,email,phone,message) 
        VALUES ('$data_name', '$data_email','$data_phone','$data_msg')";

        $result=mysqli_query($data, $sql);

        if($result)
        {
            $_SESSION['message']="Your Application sent successfully";
            header("location:SMS.php");
        }
        else
        {
            $_SESSION['message']="Your Application failed";
            header("location:SMS.php");
        }

    }


?>