<?php

include ('config.php');

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html>
<head>

   <title>About</title>

 <!-- css file link -->
 <link rel="stylesheet" href="css/mainstyle.css"/>

<!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>

</head>
<body>

<?php include('header.php'); ?>

<div class="about">
    <h3 id="about">About Artland</h3>
    <p id="p">We source and trade art that moves you. Everyone deserves to be moved by art.
       Hence, we source art from across the world make it available to you -
       no matter where you are or what you are moved by. We move galleries closer to their global audience.
     </p>
     <p id="p">We move collectors closer to each other. We move art lovers closer to the art world.</p>
     <img id="gallery1" src="imagehome/gallery.jpg" alt="" >
     <h4 id="titles1">Who we are?</h4>
     <p id="p">We are collectors, entrepreneurs, art experts and engineers.
       Together we are all art lovers and through creativity and technology
       we are changing how the art world is perceived, supported and navigated.
     </p>
     <p id="p">Art exists to evoke our feelings. We exist to enable collectors and art lovers to feel them,
       understand them, and act upon them in new ways. In all its complexity,
       we believe art can be unpretentious, accessible, and simple.
     </p>
     <h4 id="titles1">What we believe in?</h4>
     <p id="p">Everyone deserves to be moved by art.</p>
     <p id="p">Art exists to evoke our feelings - it moves us all. We exist to access, grow and share this aspect
       of our humanity with an ever widening array of digital tools - to make new connections through technology.
       In spite of art's complexity and variety,
       we believe a true passion for it can be unpretentious, and access to it encouraged and facilitated.</p>
       <p id="p">We believe everyone can transform from an aesthetician to a collector.
         We believe everyone can take part in art. No matter if you are an artist, amateur,
         collector, connoisseur, fan or challenger, we believe everyone deserves to be moved.
       </p>
        <img id="gallery1" src="imagehome/gallery1.jpg" alt="" >

        <h4 id="titles1">Get in touch</h4>
        <h6 id="support">Support Team</h6>
        <h7 id="email">SF@artland.com</h7>

</div>
<div class="footer">
<?php include('footer.php'); ?>

<script src="Js/script.js"></script>
</div>
</body>
</html>
