<?php
  // Define application constants
  define('MM_UPLOADPATH', 'images/');
  define('MM_MAXFILESIZE', 32768);      // 32 KB
  define('MM_MAXIMGWIDTH', 120);        // 120 pixels
  define('MM_MAXIMGHEIGHT', 120);       // 120 pixels
  //the calculations
?>

You will create a program that logs your exercise activity and calculates the number of calories burned. The formula for determining calorie burn is:

Male:
((-55.0969 + (0.6309 * HR) + (0.090174 * W) + (0.2017 * A)) / 4.184) * T
Female:
((-20.4022 + (0.4472 * HR) – (0.057288 * W) + (0.074 * A)) / 4.184) * T
Where:

HR: Heart rate (in beats/minute)
W: Weight (in pounds)
A: Age (in years)
T: Exercise duration time (in minutes)
//*
//from https://stackoverflow.com/questions/3776682/php-calculate-age
  //date in mm/dd/yyyy format; or it can be in other formats as well
  $birthDate = "12/17/1983";
  //explode the date to get month, day and year
  $birthDate = explode("/", $birthDate);
  //get age from date or birthdate
  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    ? ((date("Y") - $birthDate[2]) - 1)
    : (date("Y") - $birthDate[2]));
  echo "Age is:" . $age;
?>
codexworld.com
$dateOfBirth = "17-10-1985";
$today = date("Y-m-d");
$diff = date_diff(date_create($dateOfBirth), date_create($today));
echo 'Age is '.$diff->format('%y');
