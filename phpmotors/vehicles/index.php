<?php 
//Vehicles Controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
//Get the Vehicles model
require_once '../model/vehicles.php';
//Get the functions library
require_once '../library/functions.php';


// Get the array of classifications
$classifications = getClassifications();

// var_dump($classifications);
// 	exit;

// Build a navigation bar using the $classifications array
$navList = buildNavigation($classifications);

// $classificationList ='<select name="selectedname" id="selectedname">';
// $classificationList .='<option value="">Choose a Classification</option>';
// foreach($classifications as $classification) {
// $classificationList .= "<option value=$classification[classificationId]>$classification[classificationName]</option>";
// }
// $classificationList .='</select>';

// echo $classificationList;

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){

 case 'carclassification':
   include '../view/carclassification.php';
   break;
   
 case 'addclassification':
    // Filter and store the data
    $classificationName = filter_input(INPUT_POST, 'classificationName');
    $validClassificationName = checkClassificationName($classificationName);
 
    // Check for missing data
 if(empty($validClassificationName)){
    $message = '<p>Please provide the classification name.</p>';
    include '../view/carclassification.php';
    exit; 
   }
   $addOutcome = addClassification($classificationName);
 
   if($addOutcome === 1){
    header('Location: ../vehicles');
   } else {
    $message = "<p>An error occured and $classificationName could not be added to the database. Please try again.</p>";
    include '../view/carclassification.php';
    exit;
   }
    break;
    case 'vehicle':
      include '../view/vehicle.php';
      break;

    case 'addvehicle':
      
        // Filter and store the data
       
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $classificationId = trim(filter_input(INPUT_POST, "selectedname", FILTER_SANITIZE_NUMBER_INT));
        


        // Check for missing data
     if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail)|| empty($invPrice) ||  empty($invStock) || empty($invColor) || empty($classificationId)){
        $message = '<p>Please provide all the required information.</p>';
        include '../view/vehicle.php';
        exit; 
       }
       $vehicleOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
     
       if($vehicleOutcome === 1){
        $message = "<p>The vehicle has been added to the inventory.</p>";
        unset($invMake);
        unset($invModel);
        unset($invDescription);
        unset($invImage);
        unset($invThumbnail);
        unset($invPrice);
        unset($invStock);
        unset($invColor);
        unset($classificationId);
        include '../view/vehicle.php';
        exit;
       }
  break;
  case 'getInventoryItems':
   $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
   // Fetch the vehicles by classificationId from the DB 
 $inventoryArray = getInventoryByClassification($classificationId); 
 // Convert the array to a JSON object and send it back 
 echo json_encode($inventoryArray); 
 break;


 case 'mod':
   $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
   $invInfo = getInvItemInfo($invId);
 if(count($invInfo)<1){
  $message = 'Sorry, no vehicle information could be found.';
 }
 include '../view/vehicle-update.php';
 exit;
   break;
 case 'editVehicle':
   // Filter and store the data
       
   $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
   $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
   $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
   $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
   $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
   $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
   $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
   $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
   $classificationId = trim(filter_input(INPUT_POST, "selectedname", FILTER_SANITIZE_NUMBER_INT));
   $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
   


   // Check for missing data
if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail)|| empty($invPrice) ||  empty($invStock) || empty($invColor) || empty($classificationId)){
   $message = '<p>Please provide all the required information.</p>';
   include '../view/vehicle-update.php';
   exit; 
  }
  $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);

  if($updateResult === 1){
   $message = "<p>The inventory has been modified.</p>";
   $_SESSION['message'] = $message;
   unset($invMake);
   unset($invModel);
   unset($invDescription);
   unset($invImage);
   unset($invThumbnail);
   unset($invPrice);
   unset($invStock);
   unset($invColor);
   unset($classificationId);
   header('location: /phpmotors/vehicles/');
   exit;
  } else
   {
      $message = "<p>The update attempt failed.</p>";
   $_SESSION['message'] = $message;
   include '../view/vehicle-update.php';
   exit;
   }
   break;
 case 'del':
   $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
   $invInfo = getInvItemInfo($invId);
 if(count($invInfo)<1){
  $message = 'Sorry, no vehicle information could be found.';
 }
 include '../view/vehicle-delete.php';
 exit;
 break;
 case 'remVehicle':
   $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
   $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
   $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
   $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
   


   // Check for missing data

  $deleteResult = deleteVehicle($invId);

  if($deleteResult === 1){
   $message = "<p>The vehicle has been deleted.</p>";
   $_SESSION['message'] = $message; 
   header('location: /phpmotors/vehicles/');
   exit;
  } else
  $message = "<p>The vehicle could not be deleted.</p>";
  $_SESSION['message'] = $message; 
  header('location: /phpmotors/vehicles/');
  exit;
 break;

 case 'classification':
  $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $vehicles = getVehiclesByClassification($classificationName);
  if(!count($vehicles)){
    $message = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
  } else {
    $vehicleDisplay = buildVehiclesDisplay($vehicles);
    // echo $vehicleDisplay;
    // exit;
    include '../view/classification.php';
  }
 break;

 case 'vehiclepage':
  $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
  // echo $invId;
  $invInfo = getInvItemInfo($invId);
  // var_dump($invInfo);
  $vehicleInfo = buildVehiclePage($invInfo);

  if(count($invInfo)<1){
    $message = 'Sorry, no vehicle information could be found.';
   }
   include '../view/vehiclepage.php';
   exit;
  
  // var_dump($vehicleInfo);
 break;

 default:
  $classificationList = buildClassificationList($classifications);
    include '../view/vmanagement.php';
    break;
 }
