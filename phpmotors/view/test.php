<!DOCTYPE html>
<html>
<body>
<?php

//Create an array with the array() function
$myGroup = array('Bam', 'Tela', 'Ife', 'Ayo');

//Access the first element of the array with index 0
echo $myGroup[0], " is the oldest of all";
echo '<br>';

//Create an array by manually assigning index
$myGroup[0] = 'Bam';
$myGroup[1] = 'Tela';
$myGroup[2] = 'Ife';
$myGroup[3] = 'Ayo';

//Access the first element of the array with index 0
echo $myGroup[0], " is the oldest of all";
echo '<br>';

//Looping through the indexed/Numeric Array
for ($x=0; $x < count($myGroup); $x++) {
    echo $myGroup[$x];
    echo "<br>";
};

//create an associative array
$groupPopulation = array("Group 1"=>16, "Group 2"=>19, "Group 3"=>21);

//Access the first value using its named key
echo 'Group 1 has ', $groupPopulation['Group 1'], ' members';
echo '<br>';

//Assign values to the array using thier named key
$groupPopulation['Group 1'] = 16;
$groupPopulation['Group 2'] = 19;
$groupPopulation['Group 3'] = 21;

//looping through an associative array
foreach($groupPopulation as $x => $x_value) {
    echo $x, ' has', $x_value, ' members.';
    echo '<br>';
};

?>
</body>
</html>