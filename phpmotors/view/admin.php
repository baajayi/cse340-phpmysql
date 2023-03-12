<?php
// session_start(); // start the session

if(!isset($_SESSION['loggedin'])){
    header('Location: /phpmotors');
} else {
    $clientFirstname = $_SESSION['clientData']['clientFirstname'];
        $clientLastname = $_SESSION['clientData']['clientLastname'];
        $clientEmail = $_SESSION['clientData']['clientEmail'];
        $clientLevel = $_SESSION['clientData']['clientLevel'];
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | PHP Motors</title>
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
<h1>
    <?php 
    echo $_SESSION['clientData']['clientFirstname'], ' ', $_SESSION['clientData']['clientLastname'];
    ?>
</h1>
<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
}
echo 'Hello! ', $_SESSION['clientData']['clientFirstname'], ', You are logged in!'
?>
<ul class="clientdata">
    <li>
    <?php 
    echo 'First name: ', $clientFirstname;
    ?>
    </li>
    <li>
    <?php 
    echo 'Last name:', $clientLastname;
     
     ?>
    </li>
    <li>
    <?php 
    
        echo 'Email:', $clientEmail;
     ?>

    </li>
</ul>
<a href="/phpmotors/accounts/?action=updateAccount">Update your Account</a>


<?php
if($clientLevel > 1){
    echo '<h2> For Admins: Use the link below to manage the inventory</>';
    echo "<p><a href='/phpmotors/vehicles'>Vehicle Management</a></p>";
} 

?>
</main>
<hr>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>   

    </div>
</body>
</html>