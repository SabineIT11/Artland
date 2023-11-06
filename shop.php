<?php
include('config.php');
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};

if(isset($_POST['add_to_wishlist'])){

 $picture_id = $_POST['picture_id'];
 $picture_author = $_POST['picture_author'];
 $picture_title = $_POST['picture_title'];
 $picture_price = $_POST['picture_price'];
 $image_picture = $_POST['image_picture'];


 $check_wishlist_numbers= mysqli_query($conn,"SELECT author FROM wishlist WHERE author ='$picture_author' AND user_id = '$user_id'");

 $check_cart_numbers = mysqli_query($conn, "SELECT author FROM cart WHERE author='$picture_author' AND user_id = '$user_id'");

 if(mysqli_num_rows($check_wishlist_numbers) > 0){
    $message[] = 'Already added to wishlist';
 }

 elseif(mysqli_num_rows($check_cart_numbers) > 0){
    $message[] = 'Already added to cart';
 }
   else{
     mysqli_query($conn, "INSERT INTO wishlist(user_id,picture_id,author,title,picture_price,image_picture)VALUES('$user_id','$picture_id','$picture_author','$picture_title','$picture_price','$image_picture')");
     $message [] = 'Picture added to wishlist';
   }
}

if(isset($_POST['add_to_cart'])){
    $picture_id = $_POST['picture_id'];
    $picture_author = $_POST['picture_author'];
    $picture_title = $_POST['picture_title'];
    $picture_price = $_POST['picture_price'];
    $image_picture = $_POST['image_picture'];
    $picture_quantity = $_POST['picture_quantity'];

    $check_cart_numbers= mysqli_query($conn,"SELECT author FROM cart WHERE author='$picture_author' AND user_id = '$user_id'");

    if(mysqli_num_rows($check_cart_numbers) > 0 ){
        $message[] = 'Already add to cart';
     }
     else{
            $check_wishlist_numbers = mysqli_query($conn , "SELECT author FROM wishlist WHERE author='$picture_author' AND user_id = '$user_id'");

      if(mysqli_num_rows($check_wishlist_numbers) > 0){
          mysqli_query($conn , "DELETE FROM wishlist  WHERE author='$picture_author'  AND user_id = '$user_id'");
      }

       mysqli_query($conn, "INSERT INTO cart (user_id, picture_id ,author ,title,picture_price,quantity ,image_picture)VALUES('$user_id','$picture_id','$picture_author','$picture_title','$picture_price','$picture_quantity','$image_picture')");
       $message[]=' Added to cart';

     }
}
 ?>

 <!DOCTYPE HTML>
 <html>
    <head>
     <title>Shop</title>
     <!-- css file link -->
    <link rel="stylesheet" href="css/mainstyle.css"/>

      <!-- font awesome cdn link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    </head>
    <body>

  <?php
  include('header.php'); ?>

<section class="products">
    <h1 >Our Shop</h1>

    <div class="box-container">
        <?php

     $select_pictures = mysqli_query($conn, "SELECT * FROM  picture ");
     if(mysqli_num_rows($select_pictures) > 0) {

        while($fetch_pictures = mysqli_fetch_assoc($select_pictures)){
       ?>

<form action="" method="POST" class="box">

         <div class="price">€<?php echo $fetch_pictures['picture_price']; ?></div>
         <img src="imgpicture/<?php echo $fetch_pictures['image_picture']; ?>" alt="" class="image">
         <div class="author"><?php echo $fetch_pictures['author']; ?></div>
         <div class="title"><?php echo $fetch_pictures['title']; ?></div>
         <div class="end_time"><?php echo $fetch_pictures['end_time']; ?></div>
         <div class="type_of_technique"><?php echo $fetch_pictures['type_of_technique']; ?></div>

<!-- inputet -->
         <input type="number" name="picture_quantity" value="1" min="0" class="qty">
         <input type="hidden" name="picture_id" value="<?php echo $fetch_pictures['id']; ?>">
         <input type="hidden" name="picture_author" value="<?php echo $fetch_pictures['author']; ?>">
         <input type="hidden" name="picture_title" value="<?php echo $fetch_pictures['title']; ?>">
         <input type="hidden" name="end_time" value="<?php echo $fetch_pictures['end_time']; ?>">
         <input type="hidden" name="type_of_technique" value="<?php echo $fetch_pictures['type_of_technique']; ?>">

         <!-- price and imgae -->
         <input type="hidden" name="picture_price" value="<?php echo $fetch_pictures['picture_price']; ?>">
         <input type="hidden" name="image_picture" value="<?php echo $fetch_pictures['image_picture']; ?>">

          <!-- button -->
         <input type="submit" value="add to wishlist" name="add_to_wishlist" class="option-btn">
         <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      </form>
      <?php
         }
      }
      else{
         echo '<p class="empty">no items added yet!</p>';
      }
      ?>

   </div>

</section>

<?php include('footer.php'); ?>

<script src="Js/script.js"></script>

</body>
</html>
