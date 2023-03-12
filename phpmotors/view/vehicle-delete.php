<?php
if(!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel']==1) {
    header('Location: /phpmotors/');
    exit;
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	 echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> | PHP Motors</title>
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
<h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
elseif(isset($invMake) && isset($invModel)) { 
	echo "Modify$invMake $invModel"; }?></h1>
<?php
if (isset($message)) {
 echo $message;
}
?>
<p>Confirm Vehicle Deletion. The delete is permanent.</p>
<form method="POST" action="/phpmotors/vehicles/index.php">
    
   <label for="invMake">Make</label>
   <input type="text" name="invMake" id="invMake" readonly <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
   <label for="invModel">Model</label>
   <input type="text" name="invModel" id="invModel" readonly <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>
   <label for="invDescription">Description</label>
   <input type="text" name="invDescription" id="invDescription" readonly <?php if(isset($invInfo['invDescription'])) {echo "value='$invInfo[invDescription]'"; }?>>
   <!-- <?php
    echo $classificationList;
    ?> -->
   <input type="submit" name="submit" id="regbtn" value="Delete Vehicle">
        
    <input type="hidden" name="action" value="remVehicle">
    <input type="hidden" name="invId" value="
<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];}  ?>
">
</form>
</main>
<hr>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>   

    </div>
</body>
</html>