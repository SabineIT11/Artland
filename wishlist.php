<?php
include('config.php');
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

 $picture_id = $_POST['picture_id'];
 $picture_author = $_POST['picture_author'];
 $picture_title = $_POST['picture_title'];
 $picture_price = $_POST['picture_price'];
 $image_picture = $_POST['image_picture'];
 $picture_quantity = 1;

 $check_cart_numbers= mysqli_query($conn,"SELECT * FROM cart WHERE author ='$picture_author'  AND user_id = '$user_id'");

 if( mysqli_num_rows($check_cart_numbers) > 0){
    $message[] = 'Already add to cart';
 }
 else{
        $check_wishlist_numbers = mysqli_query($conn , "SELECT * FROM wishlist  WHERE author='$picture_author'  AND user_id = '$user_id'");

  if( mysqli_num_rows($check_wishlist_numbers) > 0){
      mysqli_query($conn , "DELETE FROM wishlist WHERE author='$picture_author' AND user_id = '$user_id'");
  }

   mysqli_query($conn, "INSERT INTO cart (user_id, picture_id ,author,title,picture_price,quantity ,image_picture)VALUES('$user_id','$picture_id','$picture_author','$picture_title','$picture_price','$picture_quantity','$image_picture')");
   $message[]='Picture added to cart';

 }
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM wishlist WHERE id='$delete_id'");
    header('location:wishlist.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM wishlist WHERE user_id ='$user_id'");
    header('location:wishlist.php');

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Wishlist</title>
<!-- css file link -->
<link rel="stylesheet" href="css/mainstyle.css"/>

<!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
</head>

<body>
 <?php
 include('header.php');
 ?>
<section class="wishlist">
<h1 >PICTURES ADDED</h1>

<div class="box-container">
    <?php
    $grand_total = 0;
    $select_wishlist= mysqli_query($conn,"SELECT * FROM `wishlist` WHERE user_id = '$user_id'");
    if(mysqli_num_rows($select_wishlist) > 0) {
        while($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)){
   ?>
   <form action="" method="POST" class="box">
    <a href="wishlist.php?delete=<?php echo $fetch_wishlist['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from wishlist?');"></a>
    <img src="imgpicture/<?php echo $fetch_wishlist['image_picture']; ?>" alt="" class="image">
    <div class="author"><?php echo $fetch_wishlist['author']; ?></div>
    <div class="title"><?php echo $fetch_wishlist['title']; ?></div>
    <div class="picture_price">€<?php echo $fetch_wishlist['picture_price']; ?></div>

    <input type="hidden" name="picture_id" value="<?php echo $fetch_wishlist['picture_id']; ?>">
    <input type="hidden" name="picture_author" value="<?php echo $fetch_wishlist['author']; ?>">
    <input type="hidden" name="picture_title" value="<?php echo $fetch_wishlist['title']; ?>">
    <input type="hidden" name="picture_price" value="<?php echo $fetch_wishlist['picture_price']; ?>">
    <input type="hidden" name="image_picture" value="<?php echo $fetch_wishlist['image_picture']; ?>">

    <!-- butonat -->
    <input type="submit" value="add to cart" name="add_to cart" class="btn">

        </form>

    <?php
    $grand_total += $fetch_wishlist['picture_price'];
        }
    }

    else{
        echo '<p class="empty">Your WISHLIST is empty</p>';
    }
    ?>

    <div class="wishlist-total">
    <p>Total Price: <span>€<?php echo $grand_total; ?></span></p>
    <a href="shop.php" class="option-btn">Continue Shopping</a>
    <a href="wishlist.php?delete_all" class="delete-btn <?php echo ($grand_total > 1 )?'':'disabled' ?> "onclick="return confirm('Delete all from wishlist?');">DELETE ALL</a>
</div>

</section>


<?php
include('footer.php');
?>

<script scr="Js/script.js"></script>

</body>
</html>
