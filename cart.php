<?php

include('config.php');

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM cart WHERE id = '$delete_id'");
    header('location:cart.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'");
    header('location:cart.php');
};

if(isset($_POST['update_quantity'])){
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($conn, "UPDATE cart SET quantity = '$cart_quantity' WHERE id = '$cart_id'");
    $message[] = 'Cart quantity updated!';
}

?>

<!DOCTYPE html>
<html>
<head>
   <title>Cart</title>
   <!-- css file link -->
<link rel="stylesheet" href="css/mainstyle.css"/>
<!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    </head>

<body>

<?php include('header.php'); ?>

<section class="shopping-cart">
    <h1>Shopping Cart</h1>

    <div class="box-container">
    <?php
    $grand_total = 0;
  $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'");
        if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
    ?>
    <div  class="box">
        <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Delete this from cart?');"></a>
        <img src="imgpicture/<?php echo $fetch_cart['image_picture']; ?>" alt="" class="image">
        <div class="author"><?php echo $fetch_cart['author']; ?></div>
        <div class="title"><?php echo $fetch_cart['title']; ?></div>
        <div class="price">€<?php echo $fetch_cart['picture_price']; ?></div>


        <form action="" method="post">
            <input type="hidden" value="<?php echo $fetch_cart['id']; ?>" name="cart_id">
            <input type="number" min="1" value="<?php echo $fetch_cart['quantity']; ?>" name="cart_quantity" class="qty">
            <input type="submit" value="update" class="option-btn" name="update_quantity">
        </form>
        <div class="sub-total"> Price : <span>€<?php echo $sub_total = ($fetch_cart['picture_price'] * $fetch_cart['quantity']); ?></span> </div>
    </div>
    <?php
    $grand_total += $sub_total;
        }
    }else{
        echo '<p class="empty">Your cart is EMPTY</p>';
    }
    ?>
    </div>

    <div class="more-btn">
        <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled' ?>" onclick="return confirm('Delete all from cart?');">Delete all</a>
    </div>

    <div class="cart-total">
        <p>Total : <span>$<?php echo $grand_total; ?></span></p>
        <a href="shop.php" class="option-btn">Continue Shopping</a>
        <a href="checkout.php" class="btn  <?php echo ($grand_total > 1)?'':'disabled' ?>">Checkout</a>
    </div>

</section>

<?php include('footer.php'); ?>

<script src="Js/script.js"></script>

</body>
</html>




















</html>










?>
