<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | PHP Motors</title>
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
<h2>Registration Page</h2>
<?php
if (isset($message)) {
 echo $message;
}
?>
<form method="post" action="/phpmotors/accounts/index.php">
    <fieldset>
        <legend>Personal Details</legend>
        <label for="firstname">First name: </label>
        <input type="text" name="clientFirstname" id="firstname" required placeholder="first name" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?>>
        <label for="lastname">Last name: </label>
        <input type="text" name="clientLastname" id="lastname" required placeholder="last name" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?>>
        <label for="email">Email: </label>
            <input type="email" name="clientEmail" id="email" required placeholder="name@example.com" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>>
        <label for="password">Password:</label>
            <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
            <input type="password" name="clientPassword" placeholder="Password"  id="password" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
        
        <input type="submit" name="submit" id="regbtn" value="Register">
        
        <input type="hidden" name="action" value="register">
        <p>Already registered? <a href="/phpmotors/accounts/?action=login">Login</a></p>
    </fieldset>
</form>
</main>
<hr>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>   

    </div>
</body>
</html>