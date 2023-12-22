<?php
include_once 'config.php';
?>
<?php

if(isset($_POST["submit"])) {
    session_start();
    
    $result = mysqli_query($con,"SELECT * FROM user WHERE email='" . $_POST["email"] . "' and password = '". $_POST["password"]."'");
    $row  = mysqli_fetch_array($result);
    if(is_array($row)) {
        $_SESSION["id"] = $row['id'];
        $_SESSION["email"] =$row["email"];
        $_SESSION["firstname"] = $row["firstname"];
        $_SESSION["lastname"] = $row["lastname"];

        if(isset($_SESSION["email"])) {
            header("Location:MyProfile.php");
        }
    
    } 
    else {
        echo "<script>alert('Invalid Username or Password')</script>";
        echo "<script>setTimeout(\"location.href = '../html/login.html';\",700);</script>";
    }
}
else {
    echo "Error";
}
  
?>
