<?php
include('_inc/dbconn.php');
session_start();
$user=strtoupper($_SESSION['customer_login']);
if(isset($_GET['id'])){
$actno=$_GET['id'];
$clear=("UPDATE beneficiary1 SET status='ACTIVE' WHERE  id='$actno'");
$sql=$conn->query($clear);
if($sql){
header("LOCATION:display_beneficiary.php");
}else{
echo mysqli_error($conn);
}
}
{
echo mysqli_error($conn);
}
?>
