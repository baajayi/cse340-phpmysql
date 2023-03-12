<?php
// session_start(); // start the session

if(!isset($_SESSION['loggedin'])){
    header('Location: /phpmotors');
} else {
    $clientFirstname = $_SESSION['clientData']['clientFirstname'];
        $clientLastname = $_SESSION['clientData']['clientLastname'];
        $clientEmail = $_SESSION['clientData']['clientEmail'];
        $clientId = $_SESSION['clientData']['clientId'];
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Update | PHPMotors</title>
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
<h1>Account Update</h1>
<h2>Update Account</h2>
<?php
            if (isset($message)) {
                echo $message;
            }
        ?>
<form method="POST" action="/phpmotors/accounts/">
    <fieldset>
        <legend>Update Account Information</legend>
        <label for="clientFirstname">Firstname: </label>
        <input type="text" name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){ echo "value='$clientFirstname'"; } ?>>
        <label for="clientLastname">Lastname: </label>
        <input type="text" name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){ echo "value='$clientLastname'"; }  ?>>
        <label for="clientEmail">Email: </label>
        <input type="text" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){ echo "value='$clientEmail'"; } ?>>
        <input type="submit" name="update" id="regbtn" value="Update">

        <input type="hidden" name="action" value="updateInfo">
        <input type="hidden" name="clientId" value="<?php if(isset($clientId)){ echo $clientId;}  ?>
">
    </fieldset>
</form>

<h2>Update Password</h2>
<?php
            if (isset($newmessage)) {
                echo $newmessage;
            }
        ?>
        <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
        <p>*You are about to change your password.</p>
    <form method="POST" action="/phpmotors/accounts/">
        <fieldset>
            <legend>
                Change Password
            </legend>
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
            <input class="btm" type="submit" name="submit" value="Update Password">
            <input type="hidden" name="clientId" value="<?php if(isset($clientId)){ echo $clientId;}  ?>">
            <input type="hidden" name="action" value="updatePassword">
        </fieldset>
    </form>
</main>
<hr>
<?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>   

    </div>
</body>
</html>