<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
$sql= "select * from compte where ISVALIDATE = 'FALSE'";
$resultat = mysql_query($sql);
echo "$resultat";
?>
</body>
</html>