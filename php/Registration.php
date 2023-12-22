<?php

include_once 'config.php';

if(isset($_POST["submit"])) {

	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$email=$_POST['email'];
	$phonenumber=$_POST['phonenumber'];
	$gender=$_POST['gender'];
	$password1=$_POST['pwd1'];
	$password2=$_POST['pwd2'];

	$sql="SELECT email FROM user WHERE Email='$email'";

	if($result=$con->query($sql)){
	
		if($result->num_rows>0){
			echo "<script>alert('Username or email already exists...')</script>";
			echo "<script>setTimeout(\"location.href='../html/Signup.html';\",800);</script>";
		}
		else
		{
			if($password1 == $password2){
				$sql = "INSERT INTO user (firstname , lastname , email , phone , gender , password)
				VALUES ('$firstname','$lastname','$email','$phonenumber','$gender','$password1')";
	
				if ($con->query($sql) === TRUE) 
				{
					header("Location: ../html/Login.html");
				}
				else
				{
					echo "Error: " . $sql . "<br>" . $con->error;
				}
			}
			echo "<script>alert('Password did not match...')</script>";
			echo "<script>setTimeout(\"location.href='../html/Registration.html';\",800);</script>";
		}
	}
	else {
		die(mysqli_error($con));
	}

}
?>