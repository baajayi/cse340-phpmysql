<?php 

//Accounts Controller


// Create or access a Session
session_start();


// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
//Get the functions library
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();

// var_dump($classifications);
// 	exit;

// Build a navigation bar using the $classifications array
$navList = buildNavigation($classifications);

// echo $navList;
// exit;

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){
   case 'register':
      // Filter and store the data
      $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);

      // Check if email already exists in the database
      $checkExistingEmail = checkEmailExists($clientEmail);
      if($checkExistingEmail) {
         $_SESSION['message'] = '<p class="notice"> The email you are trying to use is already registered. Please login </p>';
         include '../view/login.php';
         unset($_SESSION['message']);
         exit;
      }
   
      // Check for missing data
      if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){   
         $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
         include '../view/registration.php';
         exit; 
     }


     // Hash the checked password
      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
      $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
   
     if($regOutcome === 1){
      setcookie('firstname', $clientFirstname, strtotime('+1 year',), '/');
      $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
      include '../view/login.php';
      exit;
     } else {
      $_SESSION['message'] = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      header('Location: /phpmotors/accounts/?action=login');
      exit;
     }
      break;
 case 'login':
    include '../view/login.php';
    break;
 case 'registration':
    include '../view/registration.php';
  break;
 case 'Login':
   $clientEmail = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
   $clientPassword = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
   $clientEmail = checkEmail($clientEmail);
   $checkPassword = checkPassword($clientPassword);
   

   if(empty($clientEmail) || empty($clientPassword)){
      $_SESSION['message'] = '<p>Please provide a valid email address and password.</p>';
      include '../view/login.php';
      exit;
     }
     

      
// A valid password exists, proceed with the login process
// Query the client data based on the email address
   $clientData = getClient($clientEmail);
   // echo $clientData['clientEmail'];
  
   // Compare the password just submitted against
   // the hashed password for the matching client
   $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
   // If the hashes don't match create an error
   // and return to the login view
   if(!$hashCheck) {
   $message = '<p class="notice">Please check your password and try again.</p>';
   include '../view/login.php';
   exit;
   }
   // A valid user exists, log them in
   $_SESSION['loggedin'] = TRUE;
   // Remove the password from the array
   // the array_pop function removes the last
   // element from an array
   array_pop($clientData);
   // Store the array into the session
   $_SESSION['clientData'] = $clientData;
   // Send them to the admin view
   include '../view/admin.php';
   exit;
   break;
   case 'Logout':
      session_unset();
      session_destroy();
      header('Location: /phpmotors/');
  break;

  case 'updateInfo':
   $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientId = $_SESSION['clientData']['clientId'];
      $checkExistingEmail = checkEmailExists($clientEmail);

   if ($_SESSION['clientData']['clientEmail']!=$clientEmail) {
      if($checkExistingEmail) {
         $_SESSION['message'] = '<p class="notice"> The email you are trying to use is already registered. Please check again</p>';
         include '../view/client-update.php';
         exit;
      }
      
   } 

//   if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) ){
//             $message = '<p>Please provide information for all empty form fields.</p>';
//             include '../view/client-update.php';
//             exit; 
//         }

        $updateInfo = updateInfo($clientFirstname, $clientLastname, $clientEmail, $clientId);
        if ($updateInfo) {
         
            $clientData = getClientById($clientId);
            
            // Remove the password from the array the array_pop function removes the last element from an array
            array_pop($clientData);
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            $message = "<p>$clientFirstname, Your information has been updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, we could not update your account information. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }

 case 'updatePassword':
         $clientId = $_SESSION['clientData']['clientId'];
         $clientPassword = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
         var_dump($clientPassword);
 
         // Check for missing data
         if(empty($clientPassword) ){
             $message = '<p class="warningMessage">Please enter the password followed by the prompt in order to update the password.</p>';
             include '../view/client-update.php';
             exit; 
         }
         $checkPassword = checkPassword($clientPassword);
         if($checkPassword == 0){
             $message = '<p class="warningMessage">Please make sure your password matches the desired pattern.</p>';
             include '../view/client-update.php';
             exit; 
         }
         // Hash the checked password
         $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
 
         $updatePassword = updatePassword($hashedPassword, $clientId);
         if ($updatePassword) {
             $clientData = getClientById($clientId);
             // Remove the password from the array the array_pop function removes the last element from an array
             array_pop($clientData);
             // Store the array into the session
             $_SESSION['clientData'] = $clientData;
             $clientFirstname = $_SESSION['clientData']['clientFirstname'];
             $message = "<p class='success'>$clientFirstname, Your password has been updated.</p>";
             $_SESSION['message'] = $message;
             header('location: /phpmotors/accounts/');
             exit;
         } else {
             $message2 = "<p class='warningMessage'>Sorry $clientFirstname, we could not update your account password. Please try again.</p>";
             include '../view/client-update.php';
             exit;
         }
     break;


   default:
   include '../view/admin.php';
   break;
 case 'updateAccount':
   include '../view/client-update.php';
 break;

 
}

?>