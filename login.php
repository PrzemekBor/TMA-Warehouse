<?php
session_start();
include("connection.php");

$error = "";
if(isset($_POST["submit"]))
{
    if(empty($_POST["username"]) || empty($_POST["password"]))
    {
        $error = "Both fields are required.";
    }elseif($_POST['postition'] = 'coordinator')
    {

        $username=$_POST['username'];
        $password=$_POST['password'];
        $position=$_POST['postition'];

        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = mysqli_real_escape_string($data, $username);
        $password = mysqli_real_escape_string($data, $password);


        $sql="SELECT user_id, position FROM users WHERE username='$username' and password='$password'";
        $result=mysqli_query($data,$sql);
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);


        if(mysqli_num_rows($result) == 1)
        {
            $_SESSION['username'] = $username;

            if($row["position"] == "coordinator"){
                header("location: coordinator.php");
            }else{ //
                header("location: home.php");
            }
        }
        else{
           header('Location: login_error.php');
        }
    }
}

?>