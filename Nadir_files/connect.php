<?php
 
$host = "localhost";
 
$bddname = "protech";
 
$user = "root";
 
$passwd = "";
 
$co = mysqli_connect($host , $user , $passwd, $bddname) or die("Failed to connect to database");
 
?>