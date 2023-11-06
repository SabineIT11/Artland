<?php

include('config.php');

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

?>

<!DOCTYPE html>
<html>
<head>
   <title>Dashboard</title>
  <!-- css file link -->
<link rel="stylesheet" href="css/adminstyle.css"/>

<!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>

</head>
<body>
   
<?php include('admin_header.php'); ?>

<section class="dashboard">

   <h1 class="title">Dashboard</h1>

   <div class="box-container">


     <!-- orders items -->
      <div class="box">
         <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM orders");
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
         <h3><?php echo $number_of_orders; ?></h3>
         <p>Orders</p>
      </div>

   <!-- items picture -->
      <div class="box">
         <?php
            $select_pictures= mysqli_query($conn, "SELECT * FROM picture");
            $number_of_pictures = mysqli_num_rows($select_pictures);
         ?>
         <h3><?php echo $number_of_pictures; ?></h3>
         <p>Items Add</p>
      </div>

     <!-- User-->
      <div class="box">
         <?php
            $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'");
            $number_of_users = mysqli_num_rows($select_users);
         ?>
         <h3><?php echo $number_of_users; ?></h3>
         <p>Normal users</p>
      </div>
    
       <!-- Admin -->
      <div class="box">
         <?php
            $select_admin = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
            $number_of_admin = mysqli_num_rows($select_admin);
         ?>
         <h3><?php echo $number_of_admin; ?></h3>
         <p>Admin Users</p>
      </div>


          <!-- nr of acc -->
      <div class="box">
         <?php
            $select_account = mysqli_query($conn, "SELECT * FROM users");
            $number_of_account = mysqli_num_rows($select_account);
         ?>
         <h3><?php echo $number_of_account; ?></h3>
         <p>Total accounts</p>
      </div>

    



  <script src="Js/Adminsc.js"></script>

   </body>
   </html>