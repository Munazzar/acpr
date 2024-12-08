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

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name = $_POST['username'];
        $pass = $_POST['password'];

        $sql="select * from usrm where username='".$name."' and password='".$pass."'";

        $result=mysqli_query($data, $sql);

        $row=mysqli_fetch_array($result);

        if($row["usertype"]=="student")
        {
            $_SESSION['username']=$name;
            $_SESSION['usertype']="student";
            header("location:studenthome.php");
        }
        elseif($row["usertype"]=="admin")
        {
            $_SESSION['username']=$name;
            $_SESSION['usertype']="admin";
            header("location:adminhome.php");
        }
        else
        {
            session_start();
            $message= "Username or password do not match";

            $_SESSION['loginMessage']=$message;
            header("location:login.php");
        }
    }
?>