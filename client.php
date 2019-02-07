
<?php
//dynamically populates the client dropdown from database
require_once ("DBController.php");
$db_handle = new DBController();
$query = "SELECT DISTINCT `cpmodule` FROM ibb_cardetails_tracker";
$countryResult = $db_handle->runQuery($query);
?>
<html>
<head>
<TITLE>Dynamically Load Dependent Dropdown on Multi-Select using PHP and
    jQuery</TITLE>


<head>

<script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script>
<script>
</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" rel="stylesheet">

    <!-- <style>form{width:10%; margin:100px auto;}</style> -->

</head>
<body>


    <div>
        <div class="row3">
            <label>Client:</label><br /> <select
                id="client-list" name="client-list" 
                class="demoInputBox"
                 multiple size=4>
                <option value="">Select Client</option>
<?php
foreach ($countryResult as $country) {
    ?>
<option value="<?php echo $country["cpmodule"]; ?>"><?php echo $country["cpmodule"]; ?></option>
<?php
}
?>
</select>
        </div>
    </div>
</body>
</html>