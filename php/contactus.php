<?php

include_once 'config.php';

if(isset($_POST["submit"])) {

	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$message=$_POST['message'];
				
    $sql = "INSERT INTO contactus (name , email , phone , message) VALUES ('$name','$email','$phone','$message')";

    if ($con->query($sql) === TRUE) 
    {
        echo "<script>alert('Thank you for contacting us...')</script>";
        echo "<script>setTimeout(\"location.href='../html/Home.html';\",800);</script>";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

}
?>