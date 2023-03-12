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
    <title>Add Classification | PHP Motors</title>
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
<h2>Add a Car Classification</h2>
<?php
if (isset($message)) {
 echo $message;
}
?>
<form method="POST" action="/phpmotors/vehicles/index.php">
   <label for="classification">Classification Name</label>
   <!-- <span>Limit the Classification to 30 characters</span> -->
   <input type="text" name="classificationName" id="classification" required placeholder="30 characters or less" pattern="[A-Za-z0-9]{1,30}">
   <input type="submit" name="submit" id="regbtn" value="Add Classification">
        
    <input type="hidden" name="action" value="addclassification">
</form>
</main>
<hr>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>   

    </div>
</body>
</html>