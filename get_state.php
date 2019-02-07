<?php
//indexes models of a certain make from the database and populates the model dropdown
require_once("DBController.php");
$db_handle = new DBController();
if(!empty($_GET['country_id'])) {
	$coun_id = $_GET["country_id"];    
	     
	$query ="SELECT DISTINCT model FROM ibb_cardetails_tracker WHERE make = '$coun_id'" ;
	$results = $db_handle->runQuery($query);
?>
	<option value="">Select Model</option>
<?php
	foreach($results as $state) {
?>
	<option value="<?php echo $state["model"]; ?>"><?php echo $state["model"]; ?></option>
<?php
	}
}
?>