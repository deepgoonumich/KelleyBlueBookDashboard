<?php

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

  //selects top 5 makes in the past 2 months
  // can be changed to dynamically take in a date but would get more complicated with other filter criteria
  //ex) if make toyota was picked how would you show top 5 makes within one make
  // could show top 5 models but that is not implemented right now
  
    $query = sprintf("SELECT make, count(*) as c from ibb_cardetails_tracker WHERE DATE(date_time)
    >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH GROUP BY make ORDER BY c DESC limit 5" );
     


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