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

  //selects the top 5 clients with the most price checks 
    $query = sprintf("SELECT cpmodule, count(*) as c from ibb_cardetails_tracker WHERE DATE(date_time)
     >= last_day(now()) + INTERVAL 1 DAY - INTERVAL 3 MONTH GROUP BY cpmodule ORDER BY c DESC limit 5" );
     


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