<?php

$server = "localhost";
$user = "root";
$pass = "";
$databasename = "treasure_mart";

//create connection
$con = new mysqli($server, $user, $pass, $databasename);

//check the connection
if($con -> connect_error){
    die("ERROR: Could not connect. " . $con->connect_error);
}
?>