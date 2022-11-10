<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php
$_SESSION["login"] = 'Nadir';

require("fonctions.php");
$bdd=connect();

//$sql= "select * from compte where username = '$login' and mdp=md5('$mdp')";
//$resultat=$bdd ->query($sql);

//    $nb_lignes= $resultat-> rowcount();
if(!empty($_SESSION["login"])){

   header("location:mon_Compte.php");
}
else{
   header("location:test.php");
}

?>