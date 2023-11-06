<?php
include('config.php');
session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
}
?>
<!Doctype html>
<html>
    <head>
        <title>home</title>
<!-- css file link -->
<link rel="stylesheet" href="css/mainstyle.css"/>

<!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    </head>
<body>
  <div class="header">
  <?php include('header.php'); ?>
</div>
<!-- Quote -->
<div class="Quote">
<h2 id=q1>"Color is the place where our brain and the universe meet".<img id="phquote"src="carousel/img1.jpg" alt=""></h2>

<h2 id="q2">"ART is a line around your throughts".</h2>

<h2 id="q3">~Gustav Kimt.</h2>
</div>
<!-- Video -->
<div class="video">
<video id="video" controls loop autoplay muted>
    <source src="video.mp4" type="video/mp4">
    <source src="video.mp4" type="video/ogg">
</video>
  <div class="desc">
<h5>Inside a gallery of ART!</h5>
</div>
</div>
<!-- Exhibition -->
<div class="Exhibition">
<h4 id="exh1">The Best of 2022:</h4>
<h4 id="exh2"> Top 6 Exhibitions Around the World</h4>
</div>
<?php
$query = "SELECT * FROM exhibition " ;
$query_run = mysqli_query($conn,$query);

while($row = mysqli_fetch_array($query_run))
{
  ?>
    <div class="wrapper">
    <div class="item">
 <div class="polaroid" ><img src="imagehome/<?php echo $row["exhibition_image"] ;?>" alt="images"/>

</div>
<!-- caption (php) -->
<div class="caption">
 <?php echo $row["exhibition_name"];?> </h4>
 "<?php echo $row["exhibition_place"] ?> </h4>
 <?php echo $row["exhibition_address"] ?></h4>
</div>
</div>
<?php
  }
  ?>
</div>
<div class="newstitle">
<h4 id="ph1">The best of 2022:</h4>
<h4 id="ph2">Top news about ART,MUSEUMS and ARTISTS.</h4>
</div>
<!-- news1 -->
<div class="news">
<div class="image1">
  <img id="lucian1" src="imagehome/lucian1.jpg" alt="" >
  <div class="desc1">
  <p><a href="news1.html">National Gallery takes a closer look at Lucian Freud
     with sweeping survey to mark centenary</a></p>
  </div>
</div>
<!-- news2 -->
<div class="image1">
  <img id="lucian2" src="imagehome/lucian2.jpg" alt="" >
  <div class="desc1">
  <p><a href="news2.html">Lucian Freud's self-portraits sure
     to pack a punch in London show </a></p>
  </div>
</div>
<!-- news3 -->
<div class="image1">
  <img id="frida" src="imagehome/frida.jpg" alt="">
  <div class="desc1">
  <p><a href="news3.html">MOST FAMOUS PAINTERS IN THE WORLD</a></p>
  </div>
</div>

<!-- news4 -->
<div class="image1">
  <img id="vatican" src="imagehome/vatican.jpg" alt="">
  <div class="desc1">
  <p><a href="news4.html">Man arrested after attacking
     ancient sculptures at Vatican Museums in Italy</a></p>
  </div>
</div>
</div>

<!-- Footer -->
<?php include('footer.php'); ?>

<script src="Js/script.js"></script>

</body>
</html>
