<?php
include('../_inc/dbconn.php');
session_start();
if(!isset($_SESSION['admin'])){
header("LOCATION:adminindex.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>ADMIN</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media
queries -->
<!-- WARNING: Respond.js doesn't work if you view the page
via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/
html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/
respond.min.js"></script>
<![endif]-->
</head>
<body>
<?php

?>
<div class="container-fluid">
<div class="row" style="text-align:center;background-color:lavender;font-size:2.0em">
<p>OPHIR SEED ACCESS COMPANY ONLINE SYSTEM</p>
</div>
<div class="row" style="text-align:center;background-color:lavender;font-size:1.0em">
<p>Phone NO:... Email:...</p>
</div>
<div class="row" style="text-align:center;background-color:lavender;font-size:1.5em">
<p>ADMIN</p>
</div>
<div class="row" style="font-size:1.0em;background-color:lavender">
<div class="col-lg-3">
</div>
<div class="col-lg-7"></div>
<div class="col-lg-2">

<?php
if(isset($_SESSION['admin'])){
$user=$_SESSION['admin'];
$db=mysqli_query($conn,"SELECT * FROM admin WHERE username='$user'");
$xx=mysqli_fetch_array($db);
echo 'Welcome Admin '.$xx['fname'].'<br>';
}
else
{
header("LOACION:Adminindex.php");
}
?>
</div>
</div>
<div class="row" style="background:lavender;font-size:1.1em;">
<div class="col-lg-10"></div>
<div class="col-sm-2"><ul class="nav navbar-nav">
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<span class="glyphicon glyphicon-user"></span>
					Admin
					<b class="caret"></b></a>
					<ul class="dropdown-menu" style="background-color:#00ff00;font-size:1.0em;color:#ffffff;">
					<li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
					</ul>
</ul></div>

</div>
<div class="row" >
<div class="navbar navbar-vertical navbar-inverse navbar-responsive">
					<div class="navbar-header">
							<a href="" class="navbar-brand" style="color:yellow;"><span class="glyphicon glyphicon-th"></span> <u>Menu</u></a>
						</div>
						<div>

							<ul class="nav navbar-nav" style="color:white;">
							<li><a href="admin.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
							<ul class="nav navbar-nav">
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<span class="glyphicon glyphicon-user"></span>Stock
					<b class="caret"></b></a>
					<ul class="dropdown-menu">
					<li><a href="viewstk.php"><span class="glyphicon glyphicon-user"></span>View Stock</a></li>
					<li><a href="stock.php"><span class="glyphicon glyphicon-off"></span> Add Stock</a></li>
					</ul>
					</li>

					<li class="active">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<span class="glyphicon glyphicon-user"></span>Order
					<b class="caret"></b></a>
					<ul class="dropdown-menu">
					<li><a href="gd_order.php"><span class="glyphicon glyphicon-retweet"></span> view all Order</a></li>
					<li><a href="approved.php"><span class="glyphicon glyphicon-off"></span> Approved Order</a></li>
					<li><a href="declined.php"><span class="glyphicon glyphicon-off"></span> Declined Order</a></li>
					<li><a href="unconfirmed.php"><span class="glyphicon glyphicon-off"></span> Unconfirmed Order</a></li>

					</ul></li>
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<span class="glyphicon glyphicon-user"></span>customer
					<b class="caret"></b></a>
					<ul class="dropdown-menu">
					<li><a href="customer.php"><span class="glyphicon glyphicon-user"></span>View customer</a></li>
					<li><a href="deregister.php"><span class="glyphicon glyphicon-user"></span>De-register customer</a></li>
					</ul>
					</li>
							</ul>
						</div>
</div>
</div>
<div class="row">
<div class="col-lg-2">
</div>
<div class="col-md-10">
<div class="panel panel-default">
<div class="panel-heading">
<h4>Goods Ordered</h4>
</div>
<div class="panel-body">
<table class="table table-responsive table-hover table-bordered table-striped">
<thead>
<tr><th>#</th><th>Ordered By</th><th>Product type</th><th>Date</th><th>Status</th><th>Quantity</th><th>Total</th><th>Mode of payment</th><th>paid after:[month]</</th><th>Confirm</th></tr>
</thead>
<tbody>
<?php
$ordered=mysqli_query($conn,"SELECT * FROM purchase WHERE status='approved'");
if(mysqli_num_rows($ordered)>=1){
$count=1;
while($oo=mysqli_fetch_array($ordered)){
$actno=$oo['actno'];$date=$oo['date'];$status=$oo['status'];$quantity=$oo['quantity'];;$pay=$oo['pay'];$period=$oo['period'];
$username=$oo['username'];
$usr=mysqli_query($conn,"SELECT * FROM customer WHERE username='$username'");
$name=mysqli_fetch_array($usr);
$fname=$name['fname'];$lname=$name['lname'];
$fullname=$fname.'  '.$lname;
$prod=mysqli_query($conn,"SELECT * FROM stock WHERE actno='$actno'");
$sr=mysqli_fetch_array($prod);
$prodtype=$sr['prodtype'];
$price=$sr['price'];
$total=$quantity*$price;
echo'<tr><td>'.$count.'</td><td>'.$fullname.'</td><td>'.$prodtype.'</td><td>'.$date.'</td><td>'.$status.'</td><td>'.$quantity.'</td><td>'.$total.'</td><td>'.$pay.'</td><td>'.$period.'</td><td><a href="approve.php?id='.$actno.'" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Approve</a></td></tr>';
$count++;
}
?>
</tbody>
</table>
<?php
}else{
echo'<div class="alert alert-success">No good in order</div>';
}
?>
</div>
</div>
</div>
</div>
<!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	<div class="footer" style="text-align:center">
&copy 2018. Copyright of Ophir seed access company online system. All rights reserved.
</div>
	</div>
</body>
</html>
