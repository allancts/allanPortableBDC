<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Fiche</title>

    <?php
        extract($_POST);
        include("../bdd/pdo.php");
        $connect = connect();

        if(empty($idCompte) && !isset($idCompte)){/* rediriger vers login*/}
    ?>
</head>
<body>
    
</body>
</html>