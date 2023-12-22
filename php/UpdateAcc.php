<?php
include_once 'Config.php';

session_start();
$currentScriptPath = $_SERVER['SCRIPT_NAME'];
$subdirectory = rtrim(dirname(dirname($currentScriptPath)), '/\\');
$fileName = isset($_FILES["file"]["name"]) ? basename($_FILES["file"]["name"]) : "";
$targetDir = $_SERVER['DOCUMENT_ROOT'] . $subdirectory . "/uploads/";
$targetFilePath = $targetDir . $fileName;

$result = mysqli_query($con,"SELECT * FROM user WHERE email='" . $_SESSION["email"] . "'");
$row  = mysqli_fetch_array($result);
if(is_array($row)) {

   $firstname = $row["firstname"];
   $lastname = $row["lastname"];
   $email = $row["email"];
   $phone = $row["phone"];

} 
else {
    echo "<script>alert('Invalid Username or Password')</script>";
    echo "<script>setTimeout(\"location.href = '../html/login.html';\",700);</script>";
}

if(isset($_POST['update_profile'])) {

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    if(!empty($fileName) && move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
        
        $sql = "UPDATE user SET firstname='$firstname', lastname='$lastname', email='$email' , phone='$phone', image='".$fileName."' WHERE email='" . $_SESSION['email'] . "'";
    
        if ($con->query($sql) === TRUE) 
        {
            $_SESSION["email"] =$email;
            $_SESSION["firstname"] = $firstname;
            $_SESSION["lastname"] = $lastname;
            header("Location:MyProfile.php");
            exit();
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }else{
        
        $sql = "UPDATE user SET firstname='$firstname', lastname='$lastname', email='$email' , phone='$phone' WHERE email='" . $_SESSION['email'] . "'";

        if ($con->query($sql) === TRUE) 
        {
            $_SESSION["email"] = $email;
            $_SESSION["firstname"] = $firstname;
            $_SESSION["lastname"] = $lastname;
            header("Location: MyProfile.php");
            exit();
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
    
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Treasure Mart</title>
    <link rel="stylesheet" href="../css/Update Acc.css">
    <link rel="stylesheet" href="../css/Header&Footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(function(){
        $("#header").load("../php/Header.php");
        $("#footer").load("Footer.html");
    });
    </script>
</head>

<div id="header"></div>

<br>
<body>
        <form method="POST" enctype="multipart/form-data">
            <div class="container">
                
                    <div class="flex">
                        <div class="inputbox">
                            <center><h2>Update Your Account</h2></center><br>
                            <span class="a1">First Name :</span><br>
                            <input type="text" name="firstname" value='<?php echo $firstname ?>' class="box" ><br>
        
                            <span class="a1">Last Name :</span><br>
                            <input type="text" name="lastname" value='<?php echo $lastname ?>' class="box" ><br>

                            <span class="a1">Your email :</span><br>
                            <input type="email" name="email" value='<?php echo $email ?>' class="box1" ><br><br>

                            <span class="a1">Contact Number :</span><br>
                            <input type="number" name="phone" value='<?php echo $phone ?>' class="num" ><br><br>
        
                            <span class="a1">Updare your picture :</span>
                            <input type="file" name="file" class="box" accept="image/jpg, image/png, image/jpeg"><br><br><br>
                        </div>
                        <br>
                        <input type="submit" value="Update profile" name="update_profile" class="btn btn-1"><br><br>
                        <a href="../html/Home.html" class="delete-btn btn-2">Go Back</a>
                    </div>
                 
            </div>   
        </form><br>    
            
</body>
<br>

<div id="footer"></div>
</html>



