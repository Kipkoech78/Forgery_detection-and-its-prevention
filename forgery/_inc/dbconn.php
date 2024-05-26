<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_db";
// Create connection

 $conn = new mysqli($servername, $username, $password);
$conn = mysqli_connect($servername, $username, $password);
mysqli_query($conn, "SET SESSION sql_mode = ''");
 // Check connection
 if (mysqli_connect_error())
 	{
 		die("Database connection failed: " . mysqli_connect_error());
 		 }
 mysqli_select_db($conn,"bank_db");
?>
