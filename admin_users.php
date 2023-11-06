<?php

include('config.php');

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM users WHERE id = '$delete_id'");
   header('location:admin_users.php');
}

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

<section class="users">

   <h1 class="title">Users account</h1>

   <div class="box-container">
      <?php
         $select_users = mysqli_query($conn, "SELECT * FROM users");
         if(mysqli_num_rows($select_users) > 0){
            while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="box">
         <p>User id : <span><?php echo $fetch_users['id']; ?></span></p>
         <p>Username : <span><?php echo $fetch_users['name']; ?></span></p>
         <p>Email : <span><?php echo $fetch_users['email']; ?></span></p>
         <p>User type : <span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; }; ?>"><?php echo $fetch_users['user_type']; ?></span></p>
         <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Delete this user?');" class="delete-btn">delete</a>
      </div>
      <?php
         }
      }
      ?>
   </div>

</section>

<script src="Js/Adminsc.js"></script>

</body>
</html>