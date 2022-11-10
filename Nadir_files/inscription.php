<?php
 
 $conn = new mysqli($servername, $username, $password, $dbname);
 // verifier la connexion
 if ($conn->connect_error) {
   die("La connexion a échouée: " . $conn->connect_error);
 }
 ?>

<html>

<form action="index.html" method="post">
 <p>Nom : <input type="text" name="nom" /></p>
 <p>Prenom : <input type="text" name="prenom" /></p>
 <p>Username : <input type="text" name="username" /></p>
 <p>Email : <input type="text" name="email" /></p>
 <p>Mot de passe : <input type="text" name="mdp" /></p>
 <p>Confirmer votre mot de passe : <input type="text" name="confMdp" /></p>
 <p><br>Question 1 : Quel est votre commune de naissance ? </br>
    <input type="text" name="q1" /></p>
<p><br>Question 2 : Quel est le nom de votre premier collège ? </br>
    <input type="text" name="q2" /></p>
<p><br>Question 1 : Quel est le nom de votre animal de compagnie ? </br>
    <input type="text" name="q3" /></p>
 <p><input type="submit" value="Valider"></p>
</form>
</html>

<?php
 
$lastname = $_POST ['nom'];
 
$firstname = $_POST ['prenom'];
 
$username = $_POST ['username'];
 
$mailcompte = $_POST ['email'];
 
if ('$bt') {
 
$query = "INSERT INTO 'compte' ('lastname', 'firstname', 'username', 'mailcompte') VALUES ('$lastname','$firstname',' $username','$mailcompte')";
 
$resultat = mysqli_query ($co, $query ) or die( mysql_error() );