<?php
include('config.php');
session_start();

if(isset($_POST['submit'])){

    // login email/pass 
$filter_email = filter_var($_POST['email'],FILTER_SANITIZE_STRING);
$email=mysqli_real_escape_string($conn,$filter_email);
// pass user
$filter_pass= filter_var($_POST['pass'],FILTER_SANITIZE_STRING);
$pass=mysqli_real_escape_string($conn, md5($filter_pass));

$sql="SELECT * FROM users WHERE email='$email' AND password='$pass'";
$select_users=mysqli_query($conn,$sql);


if(mysqli_num_rows($select_users)>0){

    $row = mysqli_fetch_assoc($select_users);

    //admin
if($row['user_type']=='admin'){
    $_SESSION['admin_name']=$row['name'];
    $_SESSION['admin_email']=$row['email'];
    $_SESSION['admin_id']=$row['id'];
    header('location:admin_page.php'); //admin_page.php


}
//user-i
else if($row['user_type']=='user'){
    $_SESSION['user_name']=$row['name'];
    $_SESSION['user_email']=$row['email'];
    $_SESSION['user_id']=$row['id'];
    header('location:index.php'); //index.php
}

else{
    $message[]='no user found';
}

} 

else{
    $message[]='incorrect email or password';
}

}
?>

<!DOCTYPE html>
<html>
<head>
       <title>Login</title>

<!-- css file link -->
<link rel="stylesheet" href="css/mainstyle.css"/>

<!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
</head>

<body>
<?php
if(isset($message)){
    foreach($message as $message){
        echo '
        <div class="message">
        <span>'.$message.'</span>
        <i class="fa fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<!-- form -->
<section class="form-container">

<form action="" method="POST">
<h3>Login </h3>
<input type="email" name="email" class="box" placeholder="enter your email" required>
<input type="password" name="pass" class="box" placeholder="enter your password" required>
<!-- button -->
<input type="submit" name="submit" class="btn" value="login">
<p>Don't have an account? <a href="register.php">register now</a></p>

</form>

</section>



</body>
</html>