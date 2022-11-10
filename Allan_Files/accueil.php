<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>

    <?php
        error_reporting(E_ERROR | E_PARSE);
        global $listCat;
        global $totalCat;
        //print_r($_POST);
    ?>
    <?php
        extract($_POST);
        include("bdd/pdo.php");
        $connect = connect();

        if(empty($idCompte) && !isset($idCompte) && $idCompte < 1){$isAnonyme = true;}else{$isAnonyme = false;}
    ?>
</head>
<body>
    <?php
        if(!$isAnonyme)
        {
            echo "<form action='post/fiche.php' method='POST'>";
            echo "<input type='hidden' name='idCompte' value = ".$idCompte.">";
            echo "<button type='submit'> CREER FICHE </button>";
            echo "</form>";
        }
    ?>

    <br><br>
    ---------------------------------------------------------
    <br><br>

    <form action="accueil.php" method="POST">

    <?php //******** Début CHECKBOX
        if(!isset($listCat)){$listCat = "";}

        function insertCheck($var) // FONCTION D'AJOUT DES CHECKBOX
        {
            echo "<label for='".$var."'>".$var."</label>";
            echo "<input type='checkbox' id='cat_".$var."' name='cat_".$var."'  value='".$var."'>";
        }

        function addCat($var) // tkt
        {
            $GLOBALS['listCat'] = $GLOBALS['listCat'].$var;
            $GLOBALS['totalCat'] = $GLOBALS['listCat'];
        }

        $sql= 'SELECT * FROM categorie'; //AFFICHAGE DES CHECKBOX
        $resultCAT = $connect->query($sql);
        echo "Choissez une ou plusieurs catégorie(s) : ";
        foreach ($resultCAT as $row) {
            insertCheck($row["NOMCAT"]);
            addCat(".cat_".$row["NOMCAT"]);
        }
        //******** FIN CHECKBOX
    ?>
    <br>
    <?php
        if(!$isAnonyme){echo "<input type='hidden' name='idCompte' value = ".$idCompte.";>";}   
    ?>
    <input type="hidden" name="haveCat" value = 1>
    <input type='hidden' name='totalCat' value=<?php echo $totalCat;?>>
    <button type='submit'> SEARCH </button>
    </form>

    <br><br>
    ---------------------------------------------------------
    <br><br>

    <?php
        if (isset($haveCat)) // AFFICHAGE DES FICHES
        {
            $list = $GLOBALS['totalCat'];
            $catArray = explode(".", $list);
            $CATEGORIEFICHE_value = "";

            foreach ($catArray as $item) {
                if(isset($$item))
                {
                    $CATEGORIEFICHE_value = $CATEGORIEFICHE_value . "." .$$item;
                }
            }
            $sql= 'SELECT * FROM fiche WHERE CATEGORIEFICHE=\''.$CATEGORIEFICHE_value.'\'';
            try{
                $resultFICHE = $connect->query($sql);
                
                if (isset($resultFICHE))
                {
                    foreach ($resultFICHE as $row) {
                        echo "<form action='consult/fiche.php' method='POST'>";
                        echo "[ ".$row["IDFICHE"] ." : ".$row["CATEGORIEFICHE"]." : ".$row["NOMFICHE"]." ]";
                        if(!$isAnonyme){echo "<input type='hidden' name='idCompte' value = ".$idCompte.";>";}                 
                        echo "<input type='hidden' name='idFiche' value = ".$row["IDFICHE"].";>";
                        echo "<button type='submit'> -> </button>";
                        echo "</form>"."<br><br>";
                    }
                }
                else{echo "[ AUCUN RESULTAT ! ]";}
            }
            catch (Exception $E){/**/}

            //NAV BAR
        }
    ?>

</body>
</html>
