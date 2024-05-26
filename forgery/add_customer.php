<?php
session_start();

/*if(!isset($_SESSION['admin_login']))
    header('location:adminlogin.php');*/
?>

<?php
session_start();

if(!isset($_SESSION['admin_login']))
    header('location:adminlogin.php');
?>

<?php

include '_inc/dbconn.php';

$name = isset($_POST['customer_name']) ? mysqli_real_escape_string($conn, $_POST['customer_name']) : '';
$gender = isset($_POST['customer_gender']) ? mysqli_real_escape_string($conn, $_POST['customer_gender']) : '';
$dob = isset($_POST['customer_dob']) ? mysqli_real_escape_string($conn, $_POST['customer_dob']) : '';
$nominee = isset($_POST['customer_nominee']) ? mysqli_real_escape_string($conn, $_POST['customer_nominee']) : '';
$type = isset($_POST['customer_account']) ? mysqli_real_escape_string($conn, $_POST['customer_account']) : '';
$credit = isset($_POST['initial']) ? mysqli_real_escape_string($conn, $_POST['initial']) : '';
$address = isset($_POST['customer_address']) ? mysqli_real_escape_string($conn, $_POST['customer_address']) : '';
$mobile = isset($_POST['customer_mobile']) ? mysqli_real_escape_string($conn, $_POST['customer_mobile']) : '';
$email = isset($_POST['customer_email']) ? mysqli_real_escape_string($conn, $_POST['customer_email']) : '';
$type = isset($_POST['type']) ? mysqli_real_escape_string($conn, $_POST['type']) : '';

// Salting of password
$salt = "@g26jQsG&nh*&#8v";
$password = isset($_REQUEST['customer_pwd']) ? sha1($_REQUEST['customer_pwd'] . $salt) : '';

$branch = isset($_POST['branch']) ? mysqli_real_escape_string($conn, $_POST['branch']) : '';
$date = date("Y-m-d");
switch($branch){
    case 'LONDIANI': $ifsc = "K421A";
        break;
    case 'MOLO': $ifsc = "D30AC";
        break;
    case 'KIPTERE': $ifsc = "B6A9E";
        break;
}

$sql3 = "SELECT MAX(id) from customer";
$result = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
$rws = mysqli_fetch_array($result);
$id = $rws[0] + 1;

// Check if passbook table already exists
$passbook_table_name = "passbook" . $id;
$sql_check_passbook_table = "SHOW TABLES LIKE '$passbook_table_name'";
$result_check_passbook_table = mysqli_query($conn, $sql_check_passbook_table);
if (mysqli_num_rows($result_check_passbook_table) == 0) {
    // Passbook table does not exist, create it
    $sql_create_passbook_table = "CREATE TABLE $passbook_table_name (
        transactionid int(5) AUTO_INCREMENT, 
        transactiondate date, 
        name VARCHAR(255), 
        branch VARCHAR(255), 
        ifsc VARCHAR(255), 
        credit int(10), 
        debit int(10),
        amount float(10,2), 
        narration VARCHAR(255), 
        PRIMARY KEY (transactionid)
    )";
    mysqli_query($conn, $sql_create_passbook_table) or die(mysqli_error($conn));
}

$date = date('Y-m-d h:i:s');
$sql_insert_customer = "insert into customer (`id`, `name`, `gender`, `dob`, `nominee`, `account`, `address`, `mobile`, `email`, `password`, `branch`, `ifsc`, `lastlogin`, `accstatus`) values('$id','$name','$gender','$dob','$nominee','$type','$address','$mobile', '$email','$password','$branch','$ifsc', '$date', 'ACTIVE')";
mysqli_query($conn, $sql_insert_customer) or die(mysqli_error($conn));

$sql_insert_passbook = "insert into $passbook_table_name values('$id','$date','$name','$branch','$ifsc','$credit','0','$credit','Account Open')";
mysqli_query($conn, $sql_insert_passbook) or die(mysqli_error($conn));

header('location:admin_hompage.php');




// include '_inc/dbconn.php';
// $name=  mysqli_real_escape_string($conn,$_POST['customer_name']);
// $gender=  mysqli_real_escape_string($conn,$_POST['customer_gender']);
// $dob=  mysqli_real_escape_string($conn,$_POST['customer_dob']);
// $nominee=  mysqli_real_escape_string($conn,$_POST['customer_nominee']);
// $type=  mysqli_real_escape_string($conn,$_POST['customer_account']);
// $credit=  mysqli_real_escape_string($conn,$_POST['initial']);
// $address=  mysqli_real_escape_string($conn,$_POST['customer_address']);
// $mobile=  mysqli_real_escape_string($conn,$_POST['customer_mobile']);
// $email= mysqli_real_escape_string($conn,$_POST['customer_email']);
// $type= mysqli_real_escape_string($conn,$_POST['type']);

// //salting of password
// $salt="@g26jQsG&nh*&#8v";
// $password=  sha1($_REQUEST['customer_pwd'].$salt);

// $branch=  mysqli_real_escape_string($conn,$_POST['branch']);
// $date=date("Y-m-d");
// switch($branch){
// case 'LONDIANI': $ifsc="K421A";
//     break;
// case 'MOLO': $ifsc="D30AC";
//     break;
// case 'KIPTERE': $ifsc="B6A9E";
//     break;
// }

// $sql3="SELECT MAX(id) from customer";
// $result=mysqli_query($conn,$sql3) or die(mysqli_error($conn));
// $rws=  mysqli_fetch_array($result);
// $id=$rws[0]+1;
// $sql1="CREATE TABLE passbook".$id."
//     (transactionid int(5) AUTO_INCREMENT, transactiondate date, name VARCHAR(255), branch VARCHAR(255), ifsc VARCHAR(255), credit int(10), debit int(10),
//     amount float(10,2), narration VARCHAR(255), PRIMARY KEY (transactionid))";
//     mysqli_query($conn,$sql1) or die(mysqli_error($conn));
// $date=date('Y-m-d h:i:s');
// $sql="insert into customer (`id`, `name`, `gender`, `dob`, `nominee`, `account`, `address`, `mobile`, `email`, `password`, `branch`, `ifsc`, `lastlogin`, `accstatus`, `adminType`) values('$id','$name','$gender','$dob','$nominee','$type','$address','$mobile', '$email','$password','$branch','$ifsc', '$date', 'ACTIVE', '$type')";
// mysqli_query($conn,$sql) or die(mysqli_error($conn));

// //mysqli_query($conn,$sql1) or die(mysqli_error($conn));
// $sql4="insert into passbook".$id." values('$id','$date','$name','$branch','$ifsc','$credit','0','$credit','Account Open')";
// mysqli_query($conn,$sql4) or die(mysqli_error($conn));
// header('location:admin_hompage.php');
?>
