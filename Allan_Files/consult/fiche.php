<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fiche</title>

    <?php
        //print_r($_POST);
    ?>
    <?php
        extract($_POST);
        include("../bdd/pdo.php");
        $connect = connect();

        $sql= 'SELECT * FROM fiche WHERE IDFICHE='.$idFiche;
        $request = $connect->query($sql);
        $request = $request->fetch();
    ?>
</head>
<body>
    <br><br>--------------------------<br><br>

    <?php

        //CATEGORIEFICHE
        echo "<br> [";
        $catArray = explode(".", $request['CATEGORIEFICHE']); $catList ="";
        foreach ($catArray as $cat) {
            if($catList == ""){$catList = $cat;}
            else{$catList = $catLis." + ".$cat;}
        }
        echo "Catégories de la fiche: ".$catList;
        echo "] <br>";


        //NOMFICHE
        echo "<br> [";
        echo "Nom de la fiche : ".$request['NOMFICHE'];
        echo "] <br>";

        //DATAFICHE
        echo "<br> [";
        echo "Contenu de la fiche: <br>";
        echo $request['DATAFICHE'];
        echo "] <br>";

        //IDAUTEURFICHE -> USERNAME
        echo "<br> [";
        $rAuteur = $connect->query('SELECT * FROM compte WHERE IDCOMPTE=\''.$request['IDAUTEURFICHE'].'\'');
        $rAuteur = $rAuteur->fetch();
        echo "Auteur de la fiche : ".$rAuteur['USERNAME'];
        echo "] <br>";

        //ISVALIDATE
        echo "<br> [";
        echo "Fiche certifié : ";
        if($request['ISVALIDATE'] == 1){echo "TRUE";}
        else{echo "FALSE";}
        echo "] <br>";

        //DATEFICHE
        echo "<br> [";
        echo "Date de création de la fiche : ".$request['DATEFICHE'];
        echo "] <br>";

        //Button signalement --

        // /!\ ADMIN : Supression fiche
            // Etes vous sûr ?

        // /!\ ADMIN : Certifier / Décertifier
            // Etes vous sûr ?

    ?>

    <br><br>
    ---------------------------------------------------------
    <br><br>

    <?php

    //Button Afficher/Cacher la solution

        //SOLUCEFICHE
        echo "<div id='soluce'>"
        echo "<br> [";
        echo "Solution de la fiche : ".$request['SOLUCEFICHE'];
        echo "] <br>";

            //Button proposé une modif --

        echo "</div>";
    ?>

    <br><br>
    ---------------------------------------------------------
    <br><br>

    <?php

    //Button Afficher/Cacher les commentaires

        //IDREFFICHE = IDFICHE
        echo "<div id='comments'>"
        echo "<br> [";
        echo "Commentaires de la fiche : <br>";
        
        try
        {
            $rComments = $connect->query('SELECT * FROM commentaire WHERE IDREFFICHE=\''.$request['IDFICHE'].'\'');
            foreach ($rComments as $row) {
                echo "[ ";
                $rAuteurCom = $connect->query('SELECT * FROM compte WHERE IDCOMPTE=\''.$row['IDAUTEURCOM'].'\'');
                $rAuteurCom = $rAuteurCom->fetch();
                echo "Auteur : ".$row['USERNAME']."<br>";
                echo "Commentaire : <br>";
                echo $row['DATACOM'];
                echo " ]<br>";

            //Button signalement commentaire --
            // /!\ ADMIN : Supression commentaire
                // Etes vous sûr ?
            }
        }
        catch (Exception $E){/**/}
        
        echo "] <br>";
        echo "<div id='soluce'>"

        //Button Commenter --


    ?>
    
</body>
</html>