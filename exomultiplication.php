<?php
if (isset($_GET['premier']))
 {

$select1 = $_GET['premier'];
$select2 = $_GET['deuxieme']; 

    if (isset($select1, $select2)){
        $result = ($select1 * $select2);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="boostrap_decouvert.css">
    <title>Multipication</title>
</head>

<body>
    
    <h1>Multiplication</h1>
   
    <form action="exomultiplication.php" method="GET">
    
        <select name="premier">
<?php 
$i = 0;

while ($i < 10): 
    echo $i++ ;
    
?>    
     <option>
     <?= $i ?> 
     </option>   
<?php endwhile; ?>    
        </select>

<p>X</p>

        <select name="deuxieme">
        <?php 
$i = 0;

while ($i < 10): 
    echo $i++ ;
    
?>    
     <option>
     <?= $i ?> 
     </option>   
<?php endwhile; ?>    
        </select>
        </select>

       <input type="submit" value="Calculer">

       <h1><?= $result ?></h1>
    </form>
</body>
</html>



