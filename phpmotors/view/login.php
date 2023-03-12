<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | PHP Motors</title>
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
<h2>Login Page</h2>
<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
   }
?>
<form method="POST" action="/phpmotors/accounts/">
    <fieldset>
        <legend>Log in</legend>
        <label for="email">Email: </label>
        <input type="email" name="email" id="email" required placeholder="name@example.com" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>>
        <label for="password">Password:</label>
        <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
            <input type="password" name="password" id="password" placeholder="Password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
        <button>Login</button>
        <input type="hidden" name="action" value="Login">
        <p>New User? <a href="/phpmotors/accounts/?action=registration">Sign up</a></p>
    </fieldset>
</form>
</main>
<hr>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>   

    </div>
</body>
</html>