<?php
if(!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel']==1) {
    header('Location: /phpmotors/');
    exit;
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
   }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Management | PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/template.css">
</head>
<body>
<div id="wrapper">
 <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
     <nav>
        <?php 
        echo $navList; ?> 
     </nav>
<main>
<h2>Vehicle Management Page</h2>
<h3><a href="/phpmotors/vehicles/?action=carclassification">Add Car Classification</a></h3>
<h3><a href="/phpmotors/vehicles/?action=vehicle">Add Vehicle</a></h3>

<?php
if (isset($message)) { 
 echo $message; 
} 
if (isset($classificationList)) { 
 echo '<h2>Vehicles By Classification</h2>'; 
 echo '<p>Choose a classification to see those vehicles</p>'; 
 echo $classificationList; 
}
?>
<noscript>
<p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
</noscript>
<table id="inventoryDisplay"></table>

</main>
<hr>
<?php 
require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; 
?> 
 </div>
 <script src="../js/inventory.js"></script>
</body>
</html>
<?php unset($_SESSION['message']); ?>