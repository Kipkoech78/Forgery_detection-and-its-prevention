<?php


$error = "";
if(isset($_REQUEST['submitBtn'])){
    include '_inc/dbconn.php';
    $username = $_GET['name'];
    $password = $_GET['password'];

    // Salting of password
    $salt = "@g26jQsG&nh*&#8v";
    $password_hash = sha1($password . $salt);

    $sql = "SELECT name, password, adminType FROM customer WHERE name='$username' AND password='$password_hash'";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $rws = mysqli_fetch_array($query);

    if($rws) {
        $user = $rws['name'];
        $stored_password = $rws['password'];

        // Check if 'adminType' key exists in the result array
        if(isset($rws['adminType'])) {
            $type = $rws['adminType'];
        } else {
            // Set default type or handle missing 'adminType' case
            $type = 'default';
        }

        if($user == $username && $stored_password === $password_hash){
            session_start();
            $_SESSION['customer_login'] = 1;
            $_SESSION['cust_id'] = $username;

            if($type == 1){
                // Retrieve super admin account
                $_SESSION["type"] = $type;
                header("location:admin_hompage.php");
            }
            else if($type == 0){
                // Retrieve uneb clerk a/c
                header("location:customer_account_summary.php");
            }
        }
        else {
            $error = 1;
        }
    }
    else {
        $error = 1;
    }
}



// $error="";
// if(isset($_REQUEST['submitBtn'])){
//     include '_inc/dbconn.php';
//     $username=$_GET['name'];
//     $password=$_GET['password'];
//     //salting of password
//     $salt="@g26jQsG&nh*&#8v";
//     $password= sha1($_REQUEST['password'].$salt);

//     $sql="SELECT name,password FROM customer WHERE name='$username' AND password='$password'";
//     //mysqli_select_db($conn,"bank_db");
//     $query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
//     $rws=  mysqli_fetch_array($query);
//     $type = $rws['adminType'];

//     $user=$rws[0];
//     $password=$rws[1];
//     //$text=$rws['adminType'];

//    if($user==$username && $password!=$password){
//         session_start();
//        $_SESSION['customer_login']=1;
//         $_SESSION['cust_id']=$username;
//        if($type==1){

//         //retrieve super admin account
//         $_SESSION["type"]=$type;
//         header("location:admin_hompage.php");

//         }
//         else if($type==2){

//         //retrieve uneb clerk a/c
//         header("location:customer_account_summary.php");

//       }
//   }
//   else 
//   {
//   $error = 1;
//   }
// }

?>


<!DOCTYPE html>

<html>
    <head>

        <noscript><meta http-equiv="refresh" content="0;url=no-js.php"></noscript>


        <meta charset="UTF-8">
        <title >Online Banking System</title>
        <link rel="stylesheet" href="newcss.css">
    </head>
    <body style="background-color: green">
        <div class="wrapper">

        <div class="header">
           <b><img src="ksh.jpeg" alt="This is the image of our currency!" title="THIS AWESOME 1000 KENYAN SHILLING NOTE!!" height="100%" width="100%"/></b>
            </div>
            <div class="navbar">

            <ul>
            <li><a href="index.php">Home </a></li>

            </ul>
            </div>

        <div class="user_login">
            <form action='' method='GET'>
        <table align="left">
            <tr><td><span class="caption">Secure Login</span></td></tr>
            <tr><td colspan="2"><hr></td></tr>
            <tr><td>Username:</td></tr>
            <tr><td><input type="text" name="name" required></td> </tr>
            <tr><td>Password:</td></tr>
            <tr><td><input type="password" name="password" required></td></tr>

            <tr><td class="button1"><input type="submit" name="submitBtn" value="Log In" class="button"></td></tr>
        </table>
      </form>
      <script>
      $.ajax({
  url: "login.php",
  done: function(response) {
    // set the message to display: none to fade it in later.
    var message = $('<div class="alert alert-error error-message" style="display: none;">');
    // a close button
    var close = $('<button type="button" class="close" data-dismiss="alert">&times</button>');
    message.append(close); // adding the close button to the message
    message.append(response); // adding the error response to the message
    // add the message element to the body, fadein, wait 3secs, fadeout
    message.appendTo($('body')).fadeIn(300).delay(3000).fadeOut(500);
  }
});
</script>
      <?php
                if($error == 1){
              	 //echo "<div class=\"error_box\">Wrong Username or Password.</div>";
                 $message = "Username and/or Password incorrect.\\nTry again.";
  echo "<script type='text/javascript'>alert('$message');</script>";
               }
               ?>
            </div>

        <div class="image">
            <img src="home.jpg" height="100%" width="100%"/>
            <div class="text">
  </div>
            </div>

            <div class="left_panel">
                <p>My internet banking portal provides personal banking services that gives you complete control over all your banking demands online.</p>
                <h3 style="background-color: green">Features</h3>
                <ul>
                    <li>Registration for online banking</li>
                    <li>Adding Beneficiary account</li>
                    <li>Funds Transfer</li>
                    <li>Mini Statement</li>
                    <li>Account Statement by date</li>


                </ul>
                </div>

            <div class="right_panel">

                    <h3 style="background-color: green">PERSONAL BANKING</h3>
                    <ul>
                        <li>Personal Banking application provides features to administer and manage non personal accounts online.</li>
                        <li>Phishing is a fraudulent attempt, usually made through email, phone calls, SMS etc seeking your personal and confidential information.</li>
                        <li>Online Bank or any of its representative never sends you email/SMS or calls you over phone to get your personal information, password or one time SMS (high security) password.</li>
                        <li>Any such e-mail/SMS or phone call is an attempt to fraudulently withdraw money from your account through Internet Banking. Never respond to such email/SMS or phone call. Please report immediately on reportif you receive any such email/SMS or Phone call. Please lock your user access immediately.
</li>
                    </ul>
                </div>
              </div>
                    <?php include 'footer.php'?>
                    <p><center>Copyrighted &copy; by Enock Kiptoo!</center></p>

                    