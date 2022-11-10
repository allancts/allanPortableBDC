<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Commentaire</title>

    <?php
        extract($_POST);
        include("../bdd/pdo.php");
        $connect = connect();

        if(empty($idCompte) && !isset($idCompte)){/* rediriger vers login*/}
        if(empty($idFiche) && !isset($idFiche)){/* rediriger vers accueil*/}
    ?>
</head>
<body>
    
</body>
</html>