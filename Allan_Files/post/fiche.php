<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Créer Fiche</title>

    <?php
        error_reporting(E_ERROR | E_PARSE);
        extract($_POST);
        include("../bdd/pdo.php");
        $connect = connect();

        if(empty($idCompte) && !isset($idCompte)){/* rediriger vers login*/}
    ?>
</head>
<body>
    
</body>
</html>