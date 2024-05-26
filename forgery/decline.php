<?php
include('connection.php');
session_start();
$user=strtoupper($_SESSION['customer']);
if(isset($_GET['id'])){
$actno=$_GET['id'];
$clear=("UPDATE purchase SET status='decline' WHERE  actno='$actno'");
$sql=$conn->query($clear);
$ded=("USELECT * FROM purchase WHERE  actno='$actno'");
$sql2=$conn->query($ded);
$row=mysqli_fetch_array($sql2);
$quantity1=$row['quantity'];
$retun=("USELECT * FROM stock WHERE  actno='$actno'");
$result=$conn->query($retun);
$rows=mysqli_fetch_array($result);
$quantity=$rows['quantity'];
$totquat=$quantity+$quantity1;
$clear=("UPDATE stock SET quantity='$totquat' WHERE  actno='$actno'");
$result2=$conn->query($clear);
if($result2){
header("LOCATION:gd_order.php");
}
else{
echo mysql_error();
}
}
{
echo mysql_error();
}
?>