<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<center>

<h4>Formulaire d'inscrition</h4>
<form action="ajoutcpt.php" method="POST">
    <label>lastname :</label>
    <input type="text" name="lastname" required>
    <br><br>
    <label>firstname :</label>
    <input type="text" name ="firstname" required>
    <br><br>
    <label>username :</label>
    <input type="text" name="login" required>
    <br><br>
    <label>mailCompte :</label>
    <input type="mail" name="mail" required>
    <br><br>
    <label>Mot de passe :</label>
    <input type="password" name="mdp" required>
    <br><br>
    
    <button type ="submit">Valider</button>
</form>
</center>
</body>
</html>