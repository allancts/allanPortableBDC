<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fiche</title>

    <?php
        error_reporting(E_ERROR | E_PARSE);
        extract($_POST);
        include("../bdd/pdo.php");
        $connect = connect();

        if(empty($idFiche) && !isset($idFiche)){/* rediriger vers accueil*/}

        $sql= 'SELECT * FROM fiche WHERE IDFICHE='.$idFiche;
        $request = $connect->query($sql);
        $request = $request->fetch();

        if(empty($idCompte) && !isset($idCompte) && $idCompte < 1){$isAnonyme = true;}else{$isAnonyme = false;}
        $rCompte = $connect->query('SELECT * FROM compte WHERE IDCOMPTE=\''.$idCompte.'\'');
        $rCompte = $rCompte->fetch();
        if ($rCompte['isAdmin']){$isAdmin = true;}else{$isAdmin = false;}
    ?>
</head>
<body>
<center>
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
        if(!$isAnonyme)
        {
            echo "<form action='../post/report/fiche.php' method='POST'>";
            echo "<input type='hidden' name='idCompte' value = ".$idCompte.">";
            echo "<input type='hidden' name='idFiche' value = ".$idFiche.">";
            echo "<button type='submit'> SIGNALER LA FICHE </button>";
            echo "</form>";
        }

        // /!\ ADMIN : Supression fiche
        if($isAdmin)
        {
        }
            // Etes vous sûr ?

        // /!\ ADMIN : Certifier / Décertifier
        if($isAdmin)
        {
            echo "<button id='butCertif' type='button'> Certifier ou Uncertifier </button>";
        }
            // Etes vous sûr ?

    ?>

    <br><br>
    ---------------------------------------------------------
    <br><br>

    <script>
        var canDisplaySoluce = true;
        function showSoluce()
        {
            var item = document.getElementById("soluce");
            if (canDisplaySoluce) {item.style.display = "block"; canDisplaySoluce = false;} 
            else {item.style.display = "none"; canDisplaySoluce = true;}
        }
    </script>
    <style>#soluce{display : none;}</style>
    <?php

    //Button Afficher/Cacher la solution
    echo "<div onclick='showSoluce()'>";
    echo "<button id='butDisplaySoluce' type='button'> Afficher / Cacher la solution </button>";
    echo "</div>";

        //SOLUCEFICHE
        
        echo "<div id='soluce'>";
        echo "<br> [";
        echo "Solution de la fiche : ".$request['SOLUCEFICHE'];
        echo "] <br>";

            //Button proposé une modif --
            if(!$isAnonyme)
            {
                echo "<form action='../post/suggest.php' method='POST'>";
                echo "<input type='hidden' name='idCompte' value = ".$idCompte.">";
                echo "<input type='hidden' name='idFiche' value = ".$idFiche.">";
                echo "<button type='submit'> PROPOSER UNE MODIFICATION </button>";
                echo "</form>";
            }

        echo "</div>";
    ?>

    <br><br>
    ---------------------------------------------------------
    <br><br>
    <script>
        var canDisplayCom = true;
        function showComments()
        {
            var item = document.getElementById("comments");
            if (canDisplayCom) {item.style.display = "block"; canDisplayCom = false;} 
            else {item.style.display = "none"; canDisplayCom = true;}
        }
    </script>
    <style>#comments{display : none;}</style>
    <?php

    //Button Afficher/Cacher les commentaires
    echo "<div onclick='showComments()'>";
    echo "<button id='butDisplayComments' type='button'> Afficher / Cacher les commentaires</button>";
    echo "</div>";

        //IDREFFICHE = IDFICHE
        echo "<div id='comments'>";
        echo "<br> [";
        echo "Commentaires de la fiche : <br> <br><br>";
        
        try
        {
            $rComments = $connect->query('SELECT * FROM commentaire WHERE IDREFFICHE=\''.$request['IDFICHE'].'\'');
            foreach ($rComments as $row) {
                echo "[ ";
                $rAuteurCom = $connect->query('SELECT * FROM compte WHERE IDCOMPTE=\''.$row['IDAUTEURCOM'].'\'');
                $rAuteurCom = $rAuteurCom->fetch();
                echo "Auteur : ".$rAuteurCom['USERNAME']."<br>";
                echo "Commentaire : <br>";
                echo $row['DATACOM'];
                    //Button signalement commentaire --
                if(!$isAnonyme)
                {
                    echo "<form action='../post/report/comments.php' method='POST'>";
                    echo "<input type='hidden' name='idCompte' value = ".$idCompte.">";
                    echo "<input type='hidden' name='idCom' value = ".$row['IDCOM'].">";
                    echo "<button type='submit'> SIGNALER COMMENTAIRE </button>";
                    echo "</form>";
                }
                echo " ]<br><br>";

            // /!\ ADMIN : Supression commentaire
            if($isAdmin)
            {
            }
                // Etes vous sûr ?
            }
        }
        catch (Exception $E){/**/}
        
        echo "<br>] <br>";
        echo "</div>";

        //Button Commenter --
        if(!$isAnonyme)
        {
            echo "<form action='../post/comments.php' method='POST'>";
            echo "<input type='hidden' name='idCompte' value = ".$idCompte.">";
            echo "<input type='hidden' name='idFiche' value = ".$idFiche.">";
            echo "<button type='submit'> AJOUTER COMMENTAIRE </button>";
            echo "</form>";
        }
    ?>
</center>
</body>
</html>