<?php
include('config.php');

if(isset($_POST['submit'])){

// name
$filter_name=filter_var($_POST['name'],FILTER_SANITIZE_STRING);
$name=mysqli_real_escape_string($conn,$filter_name);

// email
$filter_email=filter_var($_POST['email'],FILTER_SANITIZE_STRING);
$email=mysqli_real_escape_string($conn,$filter_email);

// password
$filter_pass=filter_var($_POST['pass'],FILTER_SANITIZE_STRING);
$pass=mysqli_real_escape_string($conn,md5($filter_pass));
$filter_cpass=filter_var($_POST['cpass'],FILTER_SANITIZE_STRING);
$cpass=mysqli_real_escape_string($conn,md5($filter_cpass));

$select_users=mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($select_users)>0){
    $message[]="user already exist!";
}

else{
    if($pass != $cpass){
       $message[]="confirm password not matched!";
    }


else{
    mysqli_query($conn,"INSERT INTO users (name,email,password,user_type)VALUES('$name','$email','$pass','user')");
    $message[]="Registered successfully!";
    header('location:login.php');

}
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
<input type="text" name="name" class="box" placeholder="enter your name" required>
<input type="email" name="email" class="box" placeholder="enter your email" required>
<input type="password" name="pass" class="box" placeholder="enter your password" required>
<input type="password" name="cpass" class="box" placeholder="confirm your password" required>
<!-- button -->
<input type="submit" name="submit" class="btn" value="login">
<p>Already have an account? <a href="login.php">login now</a></p>

</form>

</section>





</body>
</html>