<?php
//identical to first insert but using the second form's id names 
// ex) instead of state-list we used state-list-two
//
header('Content-Type: application/json');
//database
define('DB_HOST', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ibb');
//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}
if (isset($_POST['state-list-two']) && !empty($_POST['state-list-two']) && isset($_POST['country-list-two']) && !empty($_POST['country-list-two'])   && 
$_POST['dateToTwo'] != "" &&  $_POST['dateFromTwo'] != "" && !isset($_POST['client-list-two']) && empty($_POST['client-list-two'])
&& !isset($_POST['location-list-two']) && empty($_POST['location-list-two'])) { //date make model
  
    $varModel = $_POST['state-list-two'];
    $varMake = $_POST['country-list-two'];
    $dateFromTwo = $_POST['dateFromTwo']; 
    $date = DateTime::createFromFormat('m/d/Y',$dateFromTwo);
$from_date = $date->format("Y-m-d");//start date
$dateToTwo = $_POST['dateToTwo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateToTwo);
$to_date = $fate->format("Y-m-d");//end date
    $query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date' AND make
    = '$varMake' AND model = '$varModel' GROUP BY CAST(date_time as DATE)");
     
}
else if(isset($_POST['state-list-two']) && !empty($_POST['state-list-two']) && isset($_POST['country-list-two']) && !empty($_POST['country-list-two']) &&  
$_POST['dateToTwo'] == "" &&  $_POST['dateFromTwo'] == "" && !isset($_POST['client-list-two']) && empty($_POST['client-list-two'])
&& !isset($_POST['location-list-two']) && empty($_POST['location-list-two'])) { //make model
    $varModel = $_POST['state-list-two'];
    $varMake = $_POST['country-list-two'];
    $query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE  make
    = '$varMake' AND model = '$varModel' AND DATE(date_time) >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH GROUP BY CAST(date_time as DATE)"); 

}
else if(!isset($_POST['state-list-two']) && empty($_POST['state-list-two']) && isset($_POST['country-list-two']) && !empty($_POST['country-list-two']) && 
$_POST['dateToTwo'] != "" &&  $_POST['dateFromTwo'] != "" && !isset($_POST['client-list-two']) && empty($_POST['client-list-two'])
&& !isset($_POST['location-list-two']) && empty($_POST['location-list-two'])) { //date make
    $varMake = $_POST['country-list-two'];
    $dateFromTwo = $_POST['dateFromTwo']; 
    $date = DateTime::createFromFormat('m/d/Y',$dateFromTwo);
$from_date = $date->format("Y-m-d");//start date
$dateToTwo = $_POST['dateToTwo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateToTwo);
$to_date = $fate->format("Y-m-d");//end date
$query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date' AND make
= '$varMake' GROUP BY CAST(date_time as DATE)"); 

}
else if(!isset($_POST['state-list-two']) && empty($_POST['state-list-two']) && isset($_POST['country-list-two']) && !empty($_POST['country-list-two']) && 
$_POST['dateToTwo'] == "" &&  $_POST['dateFromTwo'] == "" && !isset($_POST['client-list-two']) && empty($_POST['client-list-two'])
&& !isset($_POST['location-list-two']) && empty($_POST['location-list-two'])) { //make
    $varMake = $_POST['country-list-two'];
    $query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE make 
= '$varMake' AND DATE(date_time) >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH GROUP BY CAST(date_time as DATE)"); 
   
 
    

}
else if(!isset($_POST['state-list-two']) && empty($_POST['state-list-two']) && !isset($_POST['country-list-two']) && empty($_POST['country-list-two']) && 
$_POST['dateToTwo'] != "" &&  $_POST['dateFromTwo'] != "" && !isset($_POST['client-list-two']) && empty($_POST['client-list-two'])
&& !isset($_POST['location-list-two']) && empty($_POST['location-list-two'])) { //just date
  
    $dateFromTwo = $_POST['dateFromTwo']; 
    $date = DateTime::createFromFormat('m/d/Y',$dateFromTwo);
$from_date = $date->format("Y-m-d");//start date
$dateToTwo = $_POST['dateToTwo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateToTwo);
$to_date = $fate->format("Y-m-d");//end date
$query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date'  GROUP BY CAST(date_time as DATE)"); 

}
 else if(!isset($_POST['state-list-two']) && empty($_POST['state-list-two']) && !isset($_POST['country-list-two']) && empty($_POST['country-list-two']) && 
 $_POST['dateToTwo'] == "" &&  $_POST['dateFromTwo'] == "" && isset($_POST['client-list-two']) && !empty($_POST['client-list-two'])
 && !isset($_POST['location-list-two']) && empty($_POST['location-list-two'])){ //client only
    $varClient = $_POST['client-list-two'];

    $query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE DATE(date_time) >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH AND cpmodule = '$varClient' GROUP BY CAST(date_time as DATE) 
    "); 
 
 }
 else if(!isset($_POST['state-list-two']) && empty($_POST['state-list-two']) && !isset($_POST['country-list-two']) && empty($_POST['country-list-two']) && 
 $_POST['dateToTwo'] == "" &&  $_POST['dateFromTwo'] == "" && !isset($_POST['client-list-two']) && empty($_POST['client-list-two'])
 && isset($_POST['location-list-two']) && !empty($_POST['location-list-two'])) { //location only
$varLoc = $_POST['location-list-two'];

$query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE DATE(date_time) >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH AND location = '$varLoc' 
GROUP BY CAST(date_time as DATE)"); 

 }

 else if(empty($_POST['state-list-two']) && empty($_POST['country-list-two']) && 
 $_POST['dateToTwo'] != "" &&  $_POST['dateFromTwo'] != "" && !empty($_POST['client-list-two']) && empty($_POST['location-list-two'])) { //client date

    $dateFromTwo = $_POST['dateFromTwo']; 
        $date = DateTime::createFromFormat('m/d/Y',$dateFromTwo);
    $from_date = $date->format("Y-m-d");//start date
    $dateToTwo = $_POST['dateToTwo'];
    $fate = DateTime::createFromFormat('m/d/Y',$dateToTwo);
    $to_date = $fate->format("Y-m-d");//end date
    $varClient = $_POST['client-list-two'];

    $query = sprintf("SELECT date_time, count(*) 
    as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date' AND cpmodule = '$varClient'
      GROUP BY CAST(date_time as DATE)");

 }
 
 else if(!isset($_POST['state-list-two']) && empty($_POST['state-list-two']) && !isset($_POST['country-list-two']) && empty($_POST['country-list-two']) && 
 $_POST['dateToTwo'] != "" &&  $_POST['dateFromTwo'] != "" && !isset($_POST['client-list-two']) && empty($_POST['client-list-two'])
 && isset($_POST['location-list-two']) && !empty($_POST['location-list-two'])) { //location date
    $dateFromTwo = $_POST['dateFromTwo']; 
    $date = DateTime::createFromFormat('m/d/Y',$dateFromTwo);
$from_date = $date->format("Y-m-d");//start date
$dateToTwo = $_POST['dateToTwo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateToTwo);
$to_date = $fate->format("Y-m-d");//end date
$varLoc = $_POST['location-list-two'];

$query = sprintf("SELECT date_time, count(*) 
as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date' AND location = '$varLoc'
  GROUP BY CAST(date_time as DATE)");

 }

 else if(!isset($_POST['state-list-two']) && empty($_POST['state-list-two']) && isset($_POST['country-list-two']) && !empty($_POST['country-list-two']) && 
 $_POST['dateToTwo'] == "" &&  $_POST['dateFromTwo'] == "" && isset($_POST['client-list-two']) && !empty($_POST['client-list-two'])
 && !isset($_POST['location-list-two']) && empty($_POST['location-list-two'])) { //client make
    $varMake = $_POST['country-list-two'];
    $varClient = $_POST['client-list-two'];

    $query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE DATE(date_time)
     >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH AND cpmodule = '$varClient' AND make = '$varMake' 
GROUP BY CAST(date_time as DATE)"); 

 }
 else if (!isset($_POST['state-list-two']) && empty($_POST['state-list-two']) && isset($_POST['country-list-two']) && !empty($_POST['country-list-two']) && 
 $_POST['dateToTwo'] == "" &&  $_POST['dateFromTwo'] == "" && !isset($_POST['client-list-two']) && empty($_POST['client-list-two'])
 && isset($_POST['location-list-two']) && !empty($_POST['location-list-two'])) { //location make
    $varMake = $_POST['country-list-two'];
    $varLoc = $_POST['location-list-two'];

    $query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE DATE(date_time)
     >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH AND location = '$varLoc' AND make = '$varMake' 
GROUP BY CAST(date_time as DATE)"); 

 }

 else if(isset($_POST['state-list-two']) && !empty($_POST['state-list-two']) && isset($_POST['country-list-two']) && !empty($_POST['country-list-two']) &&  
 $_POST['dateToTwo'] == "" &&  $_POST['dateFromTwo'] == "" && isset($_POST['client-list-two']) && !empty($_POST['client-list-two'])
 && !isset($_POST['location-list-two']) && empty($_POST['location-list-two'])) { //client make model
    $varModel = $_POST['state-list-two'];
    $varMake = $_POST['country-list-two'];
    $varClient = $_POST['client-list-two'];

    $query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE  make
    = '$varMake' AND model = '$varModel' AND cpmodule = '$varClient' AND DATE(date_time) >= last_day(now()) +
     INTERVAL 1 DAY - INTERVAL 3 MONTH GROUP BY CAST(date_time as DATE)"); 

 }

 else if(isset($_POST['state-list-two']) && !empty($_POST['state-list-two']) && isset($_POST['country-list-two']) && !empty($_POST['country-list-two']) &&  
 $_POST['dateToTwo'] == "" &&  $_POST['dateFromTwo'] == "" && !isset($_POST['client-list-two']) && empty($_POST['client-list-two'])
 && isset($_POST['location-list-two']) && !empty($_POST['location-list-two'])) { //location make model
    $varModel = $_POST['state-list-two'];
    $varMake = $_POST['country-list-two'];
    $varLoc = $_POST['location-list-two'];

    $query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE  make
    = '$varMake' AND model = '$varModel' AND location = '$varLoc' AND DATE(date_time) >= last_day(now()) +
     INTERVAL 1 DAY - INTERVAL 3 MONTH GROUP BY CAST(date_time as DATE)"); 

 }

 else if(isset($_POST['state-list-two']) && !empty($_POST['state-list-two']) && isset($_POST['country-list-two']) && !empty($_POST['country-list-two'])   && 
 $_POST['dateToTwo'] != "" &&  $_POST['dateFromTwo'] != "" && isset($_POST['client-list-two']) && !empty($_POST['client-list-two'])
 && !isset($_POST['location-list-two']) && empty($_POST['location-list-two'])) { //client make model date

    $varModel = $_POST['state-list-two'];
    $varMake = $_POST['country-list-two'];
    $dateFromTwo = $_POST['dateFromTwo']; 
    $varClient = $_POST['client-list-two'];
    $date = DateTime::createFromFormat('m/d/Y',$dateFromTwo);
$from_date = $date->format("Y-m-d");//start date
$dateToTwo = $_POST['dateToTwo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateToTwo);
$to_date = $fate->format("Y-m-d");//end date
    $query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date' AND make
    = '$varMake' AND model = '$varModel' AND cpmodule = '$varClient' GROUP BY CAST(date_time as DATE)");
     
 }
 else if(isset($_POST['state-list-two']) && !empty($_POST['state-list-two']) && isset($_POST['country-list-two']) && !empty($_POST['country-list-two'])   && 
 $_POST['dateToTwo'] != "" &&  $_POST['dateFromTwo'] != "" && !isset($_POST['client-list-two']) && empty($_POST['client-list-two'])
 && isset($_POST['location-list-two']) && !empty($_POST['location-list-two'])) { //location make model date
    $varModel = $_POST['state-list-two'];
    $varMake = $_POST['country-list-two'];
    $dateFromTwo = $_POST['dateFromTwo']; 
    $varLoc = $_POST['location-list-two'];
    $date = DateTime::createFromFormat('m/d/Y',$dateFromTwo);
$from_date = $date->format("Y-m-d");//start date
$dateToTwo = $_POST['dateToTwo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateToTwo);
$to_date = $fate->format("Y-m-d");//end date
    $query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date' AND make
    = '$varMake' AND model = '$varModel' AND location = '$varLoc' GROUP BY CAST(date_time as DATE)");
   
 }

 else if(isset($_POST['state-list-two']) && !empty($_POST['state-list-two']) && isset($_POST['country-list-two']) && !empty($_POST['country-list-two'])   && 
 $_POST['dateToTwo'] != "" &&  $_POST['dateFromTwo'] != "" && isset($_POST['client-list-two']) && !empty($_POST['client-list-two'])
 && isset($_POST['location-list-two']) && !empty($_POST['location-list-two'])) { //client location make model date
    $varModel = $_POST['state-list-two'];
    $varMake = $_POST['country-list-two'];
    $dateFromTwo = $_POST['dateFromTwo']; 
    $varLoc = $_POST['location-list-two'];
    $varClient = $_POST['client-list-two'];
    $date = DateTime::createFromFormat('m/d/Y',$dateFromTwo);
$from_date = $date->format("Y-m-d");//start date
$dateToTwo = $_POST['dateToTwo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateToTwo);
$to_date = $fate->format("Y-m-d");//end date
    $query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date' AND make
    = '$varMake' AND model = '$varModel' AND location = '$varLoc' AND cpmodule = '$varClient' GROUP BY CAST(date_time as DATE)");
    
 }
 else if(isset($_POST['state-list-two']) && !empty($_POST['state-list-two']) && isset($_POST['country-list-two']) && !empty($_POST['country-list-two'])   && 
 $_POST['dateToTwo'] == "" &&  $_POST['dateFromTwo'] == "" && isset($_POST['client-list-two']) && !empty($_POST['client-list-two'])
 && isset($_POST['location-list-two']) && !empty($_POST['location-list-two'])) { //make  model location client
    $varModel = $_POST['state-list-two'];
    $varMake = $_POST['country-list-two'];
    $varLoc = $_POST['location-list-two'];
    $varClient = $_POST['client-list-two'];
    $query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE make 
    = '$varMake' AND model = '$varModel' AND location = '$varLoc' AND cpmodule = '$varClient'
     AND DATE(date_time) >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH GROUP BY CAST(date_time as DATE)"); 
    
 }
 else if(!isset($_POST['state-list-two']) && empty($_POST['state-list-two']) && !isset($_POST['country-list-two']) && empty($_POST['country-list-two'])   && 
 $_POST['dateToTwo'] == "" &&  $_POST['dateFromTwo'] == "" && isset($_POST['client-list-two']) && !empty($_POST['client-list-two'])
 && isset($_POST['location-list-two']) && !empty($_POST['location-list-two'])){ //client location
    $varLoc = $_POST['location-list-two'];
    $varClient = $_POST['client-list-two'];
    $query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE location = '$varLoc' AND cpmodule = '$varClient'
     AND DATE(date_time) >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH GROUP BY CAST(date_time as DATE)");
 }
 else if(!isset($_POST['state-list-two']) && empty($_POST['state-list-two']) && isset($_POST['country-list-two']) && !empty($_POST['country-list-two'])   && 
 $_POST['dateToTwo'] == "" &&  $_POST['dateFromTwo'] == "" && isset($_POST['client-list-two']) && !empty($_POST['client-list-two'])
 && isset($_POST['location-list-two']) && !empty($_POST['location-list-two'])){ //client location make
    $varLoc = $_POST['location-list-two'];
    $varClient = $_POST['client-list-two'];
    $varMake = $_POST['country-list-two'];
    $query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE location = '$varLoc' AND cpmodule = '$varClient'and 
    make = '$varMake'
    AND DATE(date_time) >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH GROUP BY CAST(date_time as DATE)");
 }
 else if(!isset($_POST['state-list-two']) && empty($_POST['state-list-two']) && !isset($_POST['country-list-two']) && empty($_POST['country-list-two'])   && 
 $_POST['dateToTwo'] != "" &&  $_POST['dateFromTwo'] != "" && isset($_POST['client-list-two']) && !empty($_POST['client-list-two'])
 && isset($_POST['location-list-two']) && !empty($_POST['location-list-two'])) { //client location date
    $varClient = $_POST['client-list-two']; 
    $varLoc = $_POST['location-list-two'];
    $dateFromTwo = $_POST['dateFromTwo']; 
    $date = DateTime::createFromFormat('m/d/Y',$dateFromTwo);
$from_date = $date->format("Y-m-d");//start date
$dateToTwo = $_POST['dateToTwo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateToTwo);
$to_date = $fate->format("Y-m-d");//end date

    $query = sprintf("SELECT date_time, count(*) 
    as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date' AND location = '$varLoc' AND
    cpmodule = '$varClient' GROUP BY CAST(date_time as DATE)");
 }

 else if(!isset($_POST['state-list-two']) && empty($_POST['state-list-two']) && isset($_POST['country-list-two']) && !empty($_POST['country-list-two'])   && 
 $_POST['dateToTwo'] != "" &&  $_POST['dateFromTwo'] != "" && isset($_POST['client-list-two']) && !empty($_POST['client-list-two'])
 && !isset($_POST['location-list-two']) && empty($_POST['location-list-two'])) { //client make date
    $varClient = $_POST['client-list-two']; 
    $varMake = $_POST['country-list-two'];
    $dateFromTwo = $_POST['dateFromTwo']; 
    $date = DateTime::createFromFormat('m/d/Y',$dateFromTwo);
$from_date = $date->format("Y-m-d");//start date
$dateToTwo = $_POST['dateToTwo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateToTwo);
$to_date = $fate->format("Y-m-d");//end date

    $query = sprintf("SELECT date_time, count(*) 
    as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date' AND make = '$varMake' AND
    cpmodule = '$varClient' GROUP BY CAST(date_time as DATE)");
 }
 else if(!isset($_POST['state-list-two']) && empty($_POST['state-list-two']) && isset($_POST['country-list-two']) && !empty($_POST['country-list-two'])   && 
 $_POST['dateToTwo'] != "" &&  $_POST['dateFromTwo'] != "" && !isset($_POST['client-list-two']) && empty($_POST['client-list-two'])
 && isset($_POST['location-list-two']) && !empty($_POST['location-list-two'])) {  //location make date
    $varLocation = $_POST['location-list-two']; 
    $varMake = $_POST['country-list-two'];
    $dateFromTwo = $_POST['dateFromTwo']; 
    $date = DateTime::createFromFormat('m/d/Y',$dateFromTwo);
$from_date = $date->format("Y-m-d");//start date
$dateToTwo = $_POST['dateToTwo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateToTwo);
$to_date = $fate->format("Y-m-d");//end date

    $query = sprintf("SELECT date_time, count(*) 
    as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date' AND make = '$varMake' AND
    location = '$varLocation' GROUP BY CAST(date_time as DATE)");
 }
 else if(isset($_POST['state-list-two']) && !empty($_POST['state-list-two']) && isset($_POST['country-list-two']) && !empty($_POST['country-list-twp'])   && 
 $_POST['dateToTwo'] != "" &&  $_POST['dateFromTwo'] != "" && isset($_POST['client-list-two']) && !empty($_POST['client-list-two'])
 && isset($_POST['location-list-two']) && !empty($_POST['location-list-two'])) {  //location make date model client
    $varLocation = $_POST['location-list-two']; 
    $varMake = $_POST['country-list-two'];
    $dateFrom = $_POST['dateFromTwo']; 
    $date = DateTime::createFromFormat('m/d/Y',$dateFromTwo);
$from_date = $date->format("Y-m-d");//start date
$dateTo = $_POST['dateToTwo'];
$fate = DateTime::createFromFormat('m/d/Y',$dateToTwo);
$to_date = $fate->format("Y-m-d");//end date
$varClient =  $_POST['client-list-two'];
$varModel = $_POST['state-list-two'];
    $query = sprintf("SELECT date_time, count(*) 
    as c FROM ibb_cardetails_tracker WHERE date_time BETWEEN DATE '$from_date' AND '$to_date' AND make = '$varMake' AND
    location = '$varLocation' AND model = '$varModel' AND cpmodule ='$varClient' and GROUP BY CAST(date_time as DATE)");
 }
else{  
     
    $query = sprintf("SELECT date_time, count(*) as c FROM ibb_cardetails_tracker WHERE DATE(date_time) >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH GROUP BY CAST(date_time as DATE)"); 
//echo('last else');
}
 $result = $mysqli->query($query);
 $data = array();
foreach ($result as $row) {
	$data[] = $row;
}
// close connection
$result->close();

//close connection
$mysqli->close();
print json_encode($data);
?>