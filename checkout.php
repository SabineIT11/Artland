<?php
include('config.php');

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_pictures[] = '';

    $cart_query = mysqli_query($conn, "SELECT * FROM cart  WHERE user_id = '$user_id'");
    if(mysqli_num_rows($cart_query) > 0){
        while($cart_item = mysqli_fetch_assoc($cart_query)){
            $cart_pictures[] = $cart_item['author'].' ('.$cart_item['quantity'].') ';
            $sub_total = ($cart_item['picture_price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_items = implode(', ',$cart_pictures);

    $order_query = mysqli_query($conn, "SELECT * FROM orders  WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_items = '$total_items' AND total_price = '$cart_total'");

    if($cart_total == 0){
        $message[] = 'Your cart is empty!';
    }elseif(mysqli_num_rows($order_query) > 0){
        $message[] = 'Order placed already!';
    }else{
        mysqli_query($conn, "INSERT INTO orders (user_id, name, number, email, method, address, total_items, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_items', '$cart_total', '$placed_on')");
        mysqli_query($conn, "DELETE FROM cart WHERE user_id = '$user_id'");
        $message[] = 'Order placed successfully!';
    }
}

?>

<!DOCTYPE html>
<html>
<head>

   <title>Details</title>

  <!-- css file link -->
 <link rel="stylesheet" href="css/mainstyle.css"/>

<!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>   

</head>
<body>
   
<?php include('header.php'); ?>

<section class="heading">
    <h1>Checkout Order</h1>
</section>

<section class="display-order">
    <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id'");
        if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['picture_price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
    ?>    
    <p> <?php echo $fetch_cart['author'] ?> <span>(<?php echo '€'.$fetch_cart['picture_price'].' x '.$fetch_cart['quantity'] ?>)</span> </p>
    <?php
        }
        }else{
            echo '<p class="empty">Your cart is empty</p>';
        }
    ?>
    <div class="grand-total">Total Price : <span>€<?php echo $grand_total; ?></span></div>
</section>

<section class="checkout">

    <form action="" method="POST">

        <h3>Place your order</h3>

        <div class="flex">
            <!-- name -->
            <div class="inputBox">
                <span>Your name :</span>
                <input type="text" name="name" placeholder="">
            </div>

            <!-- number -->
            <div class="inputBox">
                <span>Your number :</span>
                <input type="number" name="number" min="0" placeholder="">
            </div>

            <!-- email -->
            <div class="inputBox">
                <span>Your email :</span>
                <input type="email" name="email" placeholder="">
            </div>

            <!-- Payment-->
            <div class="inputBox">
                <span>Payment method :</span>
                <select name="method">
                    <option value="cash on delivery">Cash on delivery</option>
                    <option value="credit card">Credit card</option>
                </select>
            </div>

            <!-- Address -->
            <div class="inputBox">
                <span>Address  :</span>
                <input type="text" name="flat" placeholder="e.g. Street">
            </div>
           
            <!-- City -->
            <div class="inputBox">
                <span>City :</span>
                <input type="text" name="city" placeholder="">
            </div>
            
            <!-- Country -->
            <div class="inputBox">
                <span>Country :</span>
                <input type="text" name="country" placeholder="">
            </div>

            <!-- Pin -->
            <div class="inputBox">
                <span>Pin code :</span>
                <input type="number" min="0" name="pin_code" placeholder="">
            </div>
        </div>

        <!-- buton -->
        <input type="submit" name="order" value="order now" class="btn">

    </form>

</section>






<?php include('footer.php'); ?>

<script src="Js/script.js"></script>

</body>
</html>