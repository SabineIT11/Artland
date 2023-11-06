<?php
$server = "localhost";
$user = "root";
$pw = "";
$db = "artland";

$conn = mysqli_connect($server,$user,$pw,$db);

if(!$conn){
    die("Connection failed :" . mysqli_connect_error());
}

else{
    echo " ";
}


?>
