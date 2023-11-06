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

<header class="header">

<div class="flex">

<a href="index.php" class="logo">ARTLAND</a>

<nav class="navbar">
<ul>
    <li><a href="index.php">Home</a></li>

    <!-- pages -->
    <li><a href="#">Page +</a>
    <ul>
        <li><a href="about.php">About</a></li>
    </ul>

</li>
     <li><a href="shop.php">Shop</a></li>
     <li><a href="orders.php">Orders</a></li>

     <!-- account -->
     <li><a href="#">Account +</a>
    <ul>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
</ul>
</li>
</ul>
</nav>

<div class="icons">
    <a href="search_page.php" class="fas fa-search"></a>
    <div id="user-btn" class="fas fa-user"></div>

    <!-- wishlist -->
<?php
$select_wishlist_count=mysqli_query($conn, " SELECT * FROM wishlist WHERE user_id ='$user_id'"); 
$wishlist_num_rows=mysqli_num_rows($select_wishlist_count); //particular row in wishlist table
?>
<a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>

<!-- shopping -->
<?php
$select_cart_count = mysqli_query($conn, "SELECT * FROM cart WHERE user_id ='$user_id'");
$cart_num_rows = mysqli_num_rows($select_cart_count);
?>
<a href="cart.php"><i class="fas fa-cart-shopping"></i><span>(<?php echo $cart_num_rows;?>)</span></a>
</div>

<div class="account-box">
<p>Username: <span><?php echo $_SESSION['user_name']; ?></span></p>
<p>Email: <span><?php echo $_SESSION['user_email']; ?></span></p>
<a href="logout.php" class="delete-btn">Logout</a>
</div>

</div>

</header>


