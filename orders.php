<?php

include('config.php');

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
   <title>0rders</title>

  <!-- css file link -->
  <link rel="stylesheet" href="css/mainstyle.css"/>

<!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>

</head>
<body>

<?php include('header.php'); ?>

<section class="placed-orders">

    <h1 > Orders</h1>

    <div class="box-container">

    <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = '$user_id'");
        if(mysqli_num_rows($select_orders) > 0){
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
    ?>
    <div class="box">
        <p> Placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
        <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
        <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
        <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
        <p> Address : <span><?php echo $fetch_orders['address']; ?></span> </p>
        <p> Payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
        <p> Your orders : <span><?php echo $fetch_orders['total_items']; ?></span> </p>
        <p> Total price : <span>€<?php echo $fetch_orders['total_price']; ?></span> </p>
    </div>
    <?php
        }
    }
    else{
        echo '<p class="empty">No orders placed yet!</p>';
    }
    ?>
    </div>

</section>




<?php include('footer.php'); ?>

<script src="Js/script.js"></script>

</body>
</html>
