<?php
//replace all with ibb_cardetails_tracker for your new table name and change ibb in the next line to match your database name
//add else if statements as needed.
//isset and !empty do the same thing but I did both for each variable as a precaution
//to check if a date variable was set use == "" for empty and !="" for not empty

//get connection
$mysqli = new mysqli('127.0.0.1', 'root', '', 'ibb'); //change this to match the database being used 
if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}
if (isset($_POST['state-list']) && !empty($_POST['state-list']) && isset($_POST['country-list']) && !empty($_POST['country-list'])   && 
$_POST['dateTo'] != "" &&  $_POST['dateFrom'] != "" && !isset($_POST['client-list']) && empty($_POST['client-list'])
&& !isset($_POST['location-list']) && empty($_POST['location-list'])) { //date make model
  
    $varModel = $_POST['state-list'];
    $varMake = $_POST['country-list'];
    $dateFrom = $_POST['dateFrom']; 
    $date = DateTime::createFromFormat('m/d/Y',$dateFrom);
$from_date = $date->format("Y-m-d");//start date
$dateTo = $_POST['dateTo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateTo);
$to_date = $fate->format("Y-m-d");//end date
 

$query1 = sprintf("SELECT COUNT(*) as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date' AND make
= '$varMake' AND model = '$varModel'");

     
}
else if(isset($_POST['state-list']) && !empty($_POST['state-list']) && isset($_POST['country-list']) && !empty($_POST['country-list']) &&  
$_POST['dateTo'] == "" &&  $_POST['dateFrom'] == "" && !isset($_POST['client-list']) && empty($_POST['client-list'])
&& !isset($_POST['location-list']) && empty($_POST['location-list'])) { //make model
    $varModel = $_POST['state-list'];
    $varMake = $_POST['country-list'];
  
  $query1 = sprintf("SELECT COUNT(*) as c FROM ibb_cardetails_tracker WHERE make
  = '$varMake' AND model = '$varModel' AND DATE(date_time) >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH");

}
else if(!isset($_POST['state-list']) && empty($_POST['state-list']) && isset($_POST['country-list']) && !empty($_POST['country-list']) && 
$_POST['dateTo'] != "" &&  $_POST['dateFrom'] != "" && !isset($_POST['client-list']) && empty($_POST['client-list'])
&& !isset($_POST['location-list']) && empty($_POST['location-list'])) { //date make
    $varMake = $_POST['country-list'];
    $dateFrom = $_POST['dateFrom']; 
    $date = DateTime::createFromFormat('m/d/Y',$dateFrom);
$from_date = $date->format("Y-m-d");//start date
$dateTo = $_POST['dateTo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateTo);
$to_date = $fate->format("Y-m-d");//end date


$query1 = sprintf("SELECT COUNT(*) as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date' AND make
= '$varMake'");

}
else if(!isset($_POST['state-list']) && empty($_POST['state-list']) && isset($_POST['country-list']) && !empty($_POST['country-list']) && 
$_POST['dateTo'] == "" &&  $_POST['dateFrom'] == "" && !isset($_POST['client-list']) && empty($_POST['client-list'])
&& !isset($_POST['location-list']) && empty($_POST['location-list']) ) { //make
    $varMake = $_POST['country-list'];
//     $query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE make 
// = '$varMake' AND DATE(date_time) >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH GROUP BY CAST(date_time as DATE)"); 
    $query1 = sprintf("SELECT COUNT(*) as c FROM ibb_cardetails_tracker WHERE make = '$varMake'
     AND DATE(date_time) >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH");
     
   
}
else if(!isset($_POST['state-list']) && empty($_POST['state-list']) && !isset($_POST['country-list']) && empty($_POST['country-list']) && 
$_POST['dateTo'] != "" &&  $_POST['dateFrom'] != "" && !isset($_POST['client-list']) && empty($_POST['client-list'])
&& !isset($_POST['location-list']) && empty($_POST['location-list'])) { //just date
  
    $dateFrom = $_POST['dateFrom']; 
    $date = DateTime::createFromFormat('m/d/Y',$dateFrom);
$from_date = $date->format("Y-m-d");//start date
$dateTo = $_POST['dateTo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateTo);
$to_date = $fate->format("Y-m-d");//end date

$query1 = sprintf("SELECT COUNT(*) as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date'");
}
 else if(!isset($_POST['state-list']) && empty($_POST['state-list']) && !isset($_POST['country-list']) && empty($_POST['country-list']) && 
 $_POST['dateTo'] == "" &&  $_POST['dateFrom'] == "" && isset($_POST['client-list']) && !empty($_POST['client-list'])
 && !isset($_POST['location-list']) && empty($_POST['location-list'])){ //client only
    $varClient = $_POST['client-list'];

 $query1 = sprintf("SELECT COUNT(*) as c FROM ibb_cardetails_tracker WHERE cpmodule = '$varClient' AND
  DATE(date_time) >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH ");
 }
 else if(!isset($_POST['state-list']) && empty($_POST['state-list']) && !isset($_POST['country-list']) && empty($_POST['country-list']) && 
 $_POST['dateTo'] == "" &&  $_POST['dateFrom'] == "" && !isset($_POST['client-list']) && empty($_POST['client-list'])
 && isset($_POST['location-list']) && !empty($_POST['location-list'])) { //location only
$varLoc = $_POST['location-list'];

$query1 = sprintf("SELECT COUNT(*) as c FROM ibb_cardetails_tracker WHERE location = '$varLoc' AND
DATE(date_time) >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH ");

 }

 else if(empty($_POST['state-list']) && empty($_POST['country-list']) && 
 $_POST['dateTo'] != "" &&  $_POST['dateFrom'] != "" && !empty($_POST['client-list']) && empty($_POST['location-list'])) { //client date

    $dateFrom = $_POST['dateFrom']; 
        $date = DateTime::createFromFormat('m/d/Y',$dateFrom);
    $from_date = $date->format("Y-m-d");//start date
    $dateTo = $_POST['dateTo'];
    $fate = DateTime::createFromFormat('m/d/Y',$dateTo);
    $to_date = $fate->format("Y-m-d");//end date
    $varClient = $_POST['client-list'];

$query1 = sprintf("SELECT COUNT(*) as c FROM ibb_cardetails_tracker WHERE 
date_time BETWEEN DATE '$from_date' AND '$to_date' AND cpmodule = '$varClient'");
 }
 
 else if(!isset($_POST['state-list']) && empty($_POST['state-list']) && !isset($_POST['country-list']) && empty($_POST['country-list']) && 
 $_POST['dateTo'] != "" &&  $_POST['dateFrom'] != "" && !isset($_POST['client-list']) && empty($_POST['client-list'])
 && isset($_POST['location-list']) && !empty($_POST['location-list'])) { //location date
    $dateFrom = $_POST['dateFrom']; 
    $date = DateTime::createFromFormat('m/d/Y',$dateFrom);
$from_date = $date->format("Y-m-d");//start date
$dateTo = $_POST['dateTo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateTo);
$to_date = $fate->format("Y-m-d");//end date
$varLoc = $_POST['location-list'];


$query1 = sprintf("SELECT COUNT(*) as c FROM ibb_cardetails_tracker WHERE 
date_time BETWEEN DATE '$from_date' AND '$to_date' AND location = '$varLoc'");

 }

 else if(!isset($_POST['state-list']) && empty($_POST['state-list']) && isset($_POST['country-list']) && !empty($_POST['country-list']) && 
 $_POST['dateTo'] == "" &&  $_POST['dateFrom'] == "" && isset($_POST['client-list']) && !empty($_POST['client-list'])
 && !isset($_POST['location-list']) && empty($_POST['location-list'])) { //client make
    $varMake = $_POST['country-list'];
    $varClient = $_POST['client-list'];

    
$query1 = sprintf("SELECT COUNT(*) as c FROM ibb_cardetails_tracker WHERE 
DATE(date_time) >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH AND cpmodule = '$varClient' AND make = '$varMake'");

 }
 else if (!isset($_POST['state-list']) && empty($_POST['state-list']) && isset($_POST['country-list']) && !empty($_POST['country-list']) && 
 $_POST['dateTo'] == "" &&  $_POST['dateFrom'] == "" && !isset($_POST['client-list']) && empty($_POST['client-list'])
 && isset($_POST['location-list']) && !empty($_POST['location-list'])) { //location make
    $varMake = $_POST['country-list'];
    $varLoc = $_POST['location-list'];

$query1 = sprintf("SELECT COUNT(*) as c FROM ibb_cardetails_tracker WHERE location = '$varLoc' AND make = '$varMake' AND DATE(date_time)
     >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH ");


 }

 else if(isset($_POST['state-list']) && !empty($_POST['state-list']) && isset($_POST['country-list']) && !empty($_POST['country-list']) &&  
 $_POST['dateTo'] == "" &&  $_POST['dateFrom'] == "" && isset($_POST['client-list']) && !empty($_POST['client-list'])
 && !isset($_POST['location-list']) && empty($_POST['location-list'])) { //client make model
    $varModel = $_POST['state-list'];
    $varMake = $_POST['country-list'];
    $varClient = $_POST['client-list'];

$query1 = sprintf("SELECT COUNT(*) as c FROM ibb_cardetails_tracker WHERE  make
= '$varMake' AND model = '$varModel' AND cpmodule = '$varClient' AND DATE(date_time) >= last_day(now()) +
 INTERVAL 1 DAY - INTERVAL 3 MONTH");

 }

 else if(isset($_POST['state-list']) && !empty($_POST['state-list']) && isset($_POST['country-list']) && !empty($_POST['country-list']) &&  
 $_POST['dateTo'] == "" &&  $_POST['dateFrom'] == "" && !isset($_POST['client-list']) && empty($_POST['client-list'])
 && isset($_POST['location-list']) && !empty($_POST['location-list'])) { //location make model
    $varModel = $_POST['state-list'];
    $varMake = $_POST['country-list'];
    $varLoc = $_POST['location-list'];

$query1 = sprintf("SELECT COUNT(*) as c FROM ibb_cardetails_tracker WHERE  make
= '$varMake' AND model = '$varModel' AND location = '$varLoc' AND DATE(date_time) >= last_day(now()) +
 INTERVAL 1 DAY - INTERVAL 3 MONTH");

 }

 else if(isset($_POST['state-list']) && !empty($_POST['state-list']) && isset($_POST['country-list']) && !empty($_POST['country-list'])   && 
 $_POST['dateTo'] != "" &&  $_POST['dateFrom'] != "" && isset($_POST['client-list']) && !empty($_POST['client-list'])
 && !isset($_POST['location-list']) && empty($_POST['location-list'])) { //client make model date

    $varModel = $_POST['state-list'];
    $varMake = $_POST['country-list'];
    $dateFrom = $_POST['dateFrom']; 
    $varClient = $_POST['client-list'];
    $date = DateTime::createFromFormat('m/d/Y',$dateFrom);
$from_date = $date->format("Y-m-d");//start date
$dateTo = $_POST['dateTo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateTo);
$to_date = $fate->format("Y-m-d");//end date
  
$query1 = sprintf("SELECT COUNT(*) as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date' AND make
= '$varMake' AND model = '$varModel' AND cpmodule = '$varClient'");
     
 }
 else if(isset($_POST['state-list']) && !empty($_POST['state-list']) && isset($_POST['country-list']) && !empty($_POST['country-list'])   && 
 $_POST['dateTo'] != "" &&  $_POST['dateFrom'] != "" && !isset($_POST['client-list']) && empty($_POST['client-list'])
 && isset($_POST['location-list']) && !empty($_POST['location-list'])) { //location make model date
    $varModel = $_POST['state-list'];
    $varMake = $_POST['country-list'];
    $dateFrom = $_POST['dateFrom']; 
    $varLoc = $_POST['location-list'];
    $date = DateTime::createFromFormat('m/d/Y',$dateFrom);
$from_date = $date->format("Y-m-d");//start date
$dateTo = $_POST['dateTo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateTo);
$to_date = $fate->format("Y-m-d");//end date

$query1 = sprintf("SELECT COUNT(*) as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date' AND make
= '$varMake' AND model = '$varModel' AND location = '$varLoc'");
     
   
 }

 else if(isset($_POST['state-list']) && !empty($_POST['state-list']) && isset($_POST['country-list']) && !empty($_POST['country-list'])   && 
 $_POST['dateTo'] != "" &&  $_POST['dateFrom'] != "" && isset($_POST['client-list']) && !empty($_POST['client-list'])
 && isset($_POST['location-list']) && !empty($_POST['location-list'])) { //client location make model date
    $varModel = $_POST['state-list'];
    $varMake = $_POST['country-list'];
    $dateFrom = $_POST['dateFrom']; 
    $varLoc = $_POST['location-list'];
    $varClient = $_POST['client-list'];
    $date = DateTime::createFromFormat('m/d/Y',$dateFrom);
$from_date = $date->format("Y-m-d");//start date
$dateTo = $_POST['dateTo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateTo);
$to_date = $fate->format("Y-m-d");//end date

$query1 = sprintf("SELECT COUNT(*) as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date' AND make
= '$varMake' AND model = '$varModel' AND location = '$varLoc' AND cpmodule = '$varClient'");
    
 }
 else if(isset($_POST['state-list']) && !empty($_POST['state-list']) && isset($_POST['country-list']) && !empty($_POST['country-list'])   && 
 $_POST['dateTo'] == "" &&  $_POST['dateFrom'] == "" && isset($_POST['client-list']) && !empty($_POST['client-list'])
 && isset($_POST['location-list']) && !empty($_POST['location-list'])) { //make  model location client
    $varModel = $_POST['state-list'];
    $varMake = $_POST['country-list'];
    $varLoc = $_POST['location-list'];
    $varClient = $_POST['client-list'];
    $query1 = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE make 
    = '$varMake' AND model = '$varModel' AND location = '$varLoc' AND cpmodule = '$varClient'
     AND DATE(date_time) >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH"); 
}
 
 else if(!isset($_POST['state-list']) && empty($_POST['state-list']) && !isset($_POST['country-list']) && empty($_POST['country-list'])   && 
 $_POST['dateTo'] == "" &&  $_POST['dateFrom'] == "" && isset($_POST['client-list']) && !empty($_POST['client-list'])
 && isset($_POST['location-list']) && !empty($_POST['location-list'])){ //client location
    $varLoc = $_POST['location-list'];
    $varClient = $_POST['client-list'];
    $query1 = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE location = '$varLoc' AND cpmodule = '$varClient'
     AND DATE(date_time) >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH "); 
 }
 else if(!isset($_POST['state-list']) && empty($_POST['state-list']) && isset($_POST['country-list']) && !empty($_POST['country-list'])   && 
 $_POST['dateTo'] == "" &&  $_POST['dateFrom'] == "" && isset($_POST['client-list']) && !empty($_POST['client-list'])
 && isset($_POST['location-list']) && !empty($_POST['location-list'])){ //client location make
    $varLoc = $_POST['location-list'];
    $varClient = $_POST['client-list'];
    $varMake = $_POST['country-list'];
    $query1 = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE make = '$varMake' AND
    location = '$varLoc' AND cpmodule = '$varClient'
     AND DATE(date_time) >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH "); 
     //ADD THIS TO insert.php
 }
 else if(!isset($_POST['state-list']) && empty($_POST['state-list']) && !isset($_POST['country-list']) && empty($_POST['country-list'])   && 
 $_POST['dateTo'] != "" &&  $_POST['dateFrom'] != "" && isset($_POST['client-list']) && !empty($_POST['client-list'])
 && isset($_POST['location-list']) && !empty($_POST['location-list'])) { //client location date
    $varClient = $_POST['client-list']; 
    $varLoc = $_POST['location-list'];
    $dateFrom = $_POST['dateFrom']; 
    $date = DateTime::createFromFormat('m/d/Y',$dateFrom);
$from_date = $date->format("Y-m-d");//start date
$dateTo = $_POST['dateTo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateTo);
$to_date = $fate->format("Y-m-d");//end date

    $query1 = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date' AND location = '$varLoc' AND
    cpmodule = '$varClient' ");
 }
 else if(isset($_POST['state-list']) && !empty($_POST['state-list']) && isset($_POST['country-list']) && !empty($_POST['country-list'])   && 
 $_POST['dateTo'] != "" &&  $_POST['dateFrom'] != "" && isset($_POST['client-list']) && !empty($_POST['client-list'])
 && isset($_POST['location-list']) && !empty($_POST['location-list'])) {  //location make date model client
    $varLocation = $_POST['location-list']; 
    $varMake = $_POST['country-list'];
    $dateFrom = $_POST['dateFrom']; 
    $date = DateTime::createFromFormat('m/d/Y',$dateFrom);
$from_date = $date->format("Y-m-d");//start date
$dateTo = $_POST['dateTo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateTo);
$to_date = $fate->format("Y-m-d");//end date
$varClient =  $_POST['client-list'];
$varModel = $_POST['state-list'];
    $query = sprintf("SELECT date_time, count(*) 
    as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date' AND make = '$varMake' AND
    location = '$varLocation' AND model = '$varModel' AND cpmodule ='$varClient'");
 }
else{  
     
    $query1 = "SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE DATE(date_time) >= last_day(now()) +
    INTERVAL 1 DAY - INTERVAL 3 MONTH";
     

}


 $result = mysqli_query($mysqli,$query1);
 $row1 = mysqli_fetch_assoc($result);
 $data =  $row1['c']; //Here is your count
 
//close connection
$result->close();

//close connection
$mysqli->close();
print json_encode($data);

?>