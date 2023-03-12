<?php

function getPageModificationDate() {
    $filename = basename($_SERVER['PHP_SELF']);
    return date("F d Y H:i:s.", filemtime($filename));
}

function checkEmail($clientEmail) {
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

function checkPassword($clientPassword) {
    $pattern =  '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
   }
// function to check the length of the classification name
function checkClassificationName($classificationName) {
    $pattern = '/^[A-Za-z0-9]{1,30}$/';
    return preg_match($pattern, $classificationName);
}

function buildNavigation($classifications){
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/'>Home</a></li>";
    foreach ($classifications as $classification){
        $navList .="<li><a href='/phpmotors/vehicles/?action=classification&classificationName=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .='</ul>';
    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications){ 
    $classificationList = '<select name="selectedname" id="selectedname">'; 
    $classificationList .= "<option>Choose a Classification</option>"; 
    foreach ($classifications as $classification) { 
     $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>"; 
    } 
    $classificationList .= '</select>'; 
    return $classificationList; 
   }
// function to build a display of vehicles within an unordered list

function buildVehiclesDisplay($vehicles){
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
     $dv .= '<li>';
     $dv .= "<a href='/phpmotors/vehicles/?action=vehiclepage&invId=".urlencode($vehicle['invId'])."'><img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
    //  $dv .= '<hr>';
     $dv .= "<a href='/phpmotors/vehicles/?action=vehiclepage&invId=".urlencode($vehicle['invId'])."'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
     $dv .= "<span>$vehicle[invPrice]</span>";
     $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
   }

   function buildVehiclePage($invInfo){
    $price = number_format($invInfo['invPrice'], 2);
    $dv = '<div class="vehicle">';
    $dv .= "<h2>{$invInfo['invMake']} {$invInfo['invModel']} Details</h2>";
    $dv .= "<h3>\${$price}</h3>";
    $dv .= "<img src='{$invInfo['invImage']}' alt='Image of $invInfo[invMake] $invInfo[invModel]'>";
    $dv .= "<p>{$invInfo['invDescription']}</p>";
    $dv .= "<p class='color'>Color: {$invInfo['invColor']}</p>";
    $dv .= "<p class='stock'>Number in Stock: {$invInfo['invStock']}</p>";
    $dv .='</div>';

    return $dv;
}

?>