<?php
include('config.php');

session_start();
$admin_id = $_SESSION['admin_id'];
if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_item'])){

   

   //attributes of pictures (db)
   $author = mysqli_real_escape_string($conn, $_POST['author']);
   $title = mysqli_real_escape_string($conn, $_POST['title']);
   $end_time = mysqli_real_escape_string($conn, $_POST['end_time']);
   $type_of_technique = mysqli_real_escape_string($conn, $_POST['type_of_technique']);
   $picture_price = mysqli_real_escape_string($conn, $_POST['picture_price']);
   

    // image upload
   $image = $_FILES['image_picture']['name'];
   $image_size = $_FILES['image_picture']['size'];
   $image_tmp_name = $_FILES['image_picture']['tmp_name'];
   $image_filter = 'imgpicture/'.$image;

   $select_picture_author = mysqli_query($conn, "SELECT author FROM picture WHERE author = '$author'");

   if(mysqli_num_rows($select_picture_author) > 0){
      $message[] = 'Item already exist!';
   }
   else{
      $insert_picture = mysqli_query($conn, "INSERT INTO picture(author,title, end_time,type_of_technique,picture_price,image_picture) VALUES('$author', '$title', '$end_time','$type_of_technique','$picture_price', '$image')");

      if($insert_picture){
         if($image_size > 2000000){
            $message[] = 'Image size is too large!';
         }
         else{
            move_uploaded_file($image_tmp_name, $image_filter);
            $message[] = 'Picture added successfully!';
         }
      }
   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = mysqli_query($conn, "SELECT image_picture FROM picture WHERE picture_id = '$delete_id'");
   $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
   $status=unlink('imgpicture/'.$fetch_delete_image['image_picture']);   
   if($status){  
      echo "File deleted successfully";    
   }else{  
      echo "Sorry!";    
   }  
   mysqli_query($conn, "DELETE FROM picture WHERE picture_id = '$delete_id'");
   mysqli_query($conn, "DELETE FROM wishlist WHERE picture_id = '$delete_id'");
   mysqli_query($conn, "DELETE FROM cart WHERE picture_id = '$delete_id'");
   header('location:admin_items.php');

}












?>

<!DOCTYPE html>
<html>
<head>

   <title>Items</title>
   <!-- css file link -->
<link rel="stylesheet" href="css/adminstyle.css"/>

<!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
</head>

<body>
<?php include('admin_header.php'); ?>

<section class="add-products">

   <form action="" method="POST" enctype='multipart/form-data'>
      <h1>Add New Picture</h1>
      <input type="text" class="box" required placeholder="Enter picture author" name="author">
      <input type="text" class="box" required placeholder="Enter picture title" name="title">
      <input type="text" class="box" required placeholder="Enter picture end time" name="end_time">
      <input type="text" class="box" required placeholder="Enter picture technique" name="type_of_technique">
      <input type="number" min="0" class="box" required placeholder="Enter item price" name="picture_price">

      <!-- image -->
      <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image_picture">
      <!-- button -->
      <input type="submit" value="add picture" name="add_item" class="btn">
   </form>

</section>

<section class="show-products">

   <div class="box-container">

      <?php
         $select_pictures = mysqli_query($conn, "SELECT * FROM picture ");
         if(mysqli_num_rows($select_pictures) > 0){
            while($fetch_pictures = mysqli_fetch_assoc($select_pictures)){
      ?>
      <div class="box">
      <div class="price">€<?php echo $fetch_pictures['picture_price']; ?></div>
         <img class="image" src="imgpicture/<?php echo $fetch_pictures['image_picture']; ?>" alt="">
         <div class="author"><?php echo $fetch_pictures['author']; ?></div>
         <div class="title"><?php echo $fetch_pictures['title']; ?></div>
         <div class="end_time"><?php echo $fetch_pictures['end_time']; ?></div>
         <div class="type_of_technique"><?php echo $fetch_pictures['type_of_technique']; ?></div>

         <!-- delete btn -->
         <a href="admin_items.php?delete=<?php echo $fetch_pictures['picture_id']; ?>" class="delete-btn" onclick="return confirm('Delete this item?');">Delete</a>

         
      
      </div>
      <?php
         }
      }
      else{
         echo '<p class="empty">No items added yet!</p>';
      }
      ?>
   </div>
   

</section>



<script src="Js/Adminsc.js"></script>

</body>
</html>