<?php
if(!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel']==1) {
    header('Location: /phpmotors/');
    exit;
}
$classificationList ='<select name="selectedname" id="selectedname">';
$classificationList .='<option value="" >Choose a Classification</option>';
foreach($classifications as $classification) {
$classificationList .= "<option value='$classification[classificationId]'";
if (isset($_POST['selectedname']) && $_POST['selectedname'] == $classification['classificationId']) {
     {
        $classificationList .= ' selected ';
    }

}
$classificationList .=">$classification[classificationName]</option>";
}
$classificationList .='</select>';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vehicle | PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/template.css">
</head>
<body>
 <div id="wrapper">
 <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
     <nav>
        <?php 
     //require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; 
     echo $navList; ?>
     </nav>
<main>
<h2>Add a Vehicle</h2>
<?php
if (isset($message)) {
 echo $message;
}
?>
<form method="POST" action="/phpmotors/vehicles/index.php">
    
   <label for="invMake">Make</label>
   <input type="text" name="invMake" id="invMake" required <?php if(isset($invMake)){echo "value='$invMake'";}  ?>>
   <label for="invModel">Model</label>
   <input type="text" name="invModel" id="invModel" required <?php if(isset($invModel)){echo "value='$invModel'";} else if (isset($_POST['submit']) && $vehicleOutcome === 1) {unset($invModel);} ?>>
   <label for="invDescription">Description</label>
   <input type="text" name="invDescription" id="invDescription" required <?php if(isset($invDescription)){echo "value='$invDescription'";}  ?>>
   <label for="invImage">Image Path</label>
   <input type="text" name="invImage" value="/images/no-image.png" id="invImage" required <?php if(isset($invImage)){echo "value='$invImage'";}  ?>>
   <label for="invThumbnail">Thumbnail</label>
   <input type="text" name="invThumbnail" value="/images/no-image.png" id="invThumbnail" required <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?>>
   <label for="invPrice">Price</label>
   <input type="number" name="invPrice" id="invPrice" required <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?>>
   <label for="invStock">Stock</label>
    <input name="invStock" id="invStock" type="number" placeholder="Stock" required <?php if(isset($invStock)){echo "value='$invStock'";} ?>>
   <label for="invColor">Color</label>
   <input type="text" name="invColor" id="invColor" required <?php if(isset($invColor)){echo "value='$invColor'";}  ?>>
   <?php
    echo $classificationList;
    ?>
   <input type="submit" name="submit" id="regbtn" value="Add Vehicle">
        
    <input type="hidden" name="action" value="addvehicle">
</form>
</main>
<hr>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>   

    </div>
</body>
</html>