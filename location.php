<?php
require_once ("DBController.php");
$db_handle = new DBController();
// change next line to match your table name and column name for location
$query = "SELECT DISTINCT `location` FROM ibb_cardetails_tracker";
$countryResult = $db_handle->runQuery($query);
?>
<html>
<head>
<TITLE>Dynamically Load Dependent Dropdown on Multi-Select using PHP and
    jQuery</TITLE>


<head>
<style>
body {
    width: 610px;
    font-family: calibri;
}
.frmDronpDown {
    border: 1px solid #7ddaff;
    background-color: #C8EEFD;
    margin: 2px 0px;
    padding: 40px;
    border-radius: 4px;
}
.demoInputBox {
    padding: 10px;
    border: #bdbdbd 1px solid;
    border-radius: 4px;
    background-color: #FFF;
    width: 50%;
}
.row {
    padding-bottom: 15px;
}
</style>
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
        <div class="row2">
            <label>Location:</label><br /> <select
                id="location-list" name="location-list"  
                class="demoInputBox"
                 multiple size=4>
                <option value="">Select Location</option>
<?php
foreach ($countryResult as $country) {
    ?>
<option value="<?php echo $country["location"]; ?>"><?php echo $country["location"]; ?></option>
<!-- dynamically populates the location drop down from the SQL database-->
<?php
}
?>
</select>
        </div>
    </div>
</body>
</html>