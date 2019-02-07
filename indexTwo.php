<?php
//makes second start and end date forms 
//makes second make/model dynamic dropdown
require_once ("DBController.php");
$db_handle = new DBController();
$query = "SELECT DISTINCT make FROM ibb_cardetails_tracker";
$countryResult = $db_handle->runQuery($query);
?>
<html>
<head>
<TITLE>Dynamically Load Dependent Dropdown on Multi-Select using PHP and
    jQuery</TITLE>


<head>
<style>
body {
    width: 1280px;
    font-family: calibri;
}
.wrapper {
  width:1000px;
  clear:both;
}
.row {
  width:400px;
  float:left;
}
.row1 {
  
  width:400px;
  float:left;
}
.row2 {
  
  width:400px;
  float:left;
}
.row3 {
    width:400px;
  float:left; 
}
</style>
<!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script> -->
<script>
function getStateTwo() {
        var str='';
        var val=document.getElementById('country-list-two');
        for (i=0;i< val.length;i++) { 
            if(val[i].selected){
                str += val[i].value + ','; 
            }
        }         
        var str=str.slice(0,str.length -1);
        
	$.ajax({          
        	type: "GET",
        	url: "get_state_two.php",
        	data:'country_id_two='+str, //make or model?
        	success: function(data){
        		$("#state-list-two").html(data);
        	}
	});
}
</script>
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css" rel="stylesheet"> -->

    <!-- <style>form{width:10%; margin:100px auto;}</style> -->

    <script type="text/javascript">
        $(document).ready(function () {
                $("#dateFromTwo").datepicker({
                    onClose: function () {
                        $("#dateToTwo").datepicker(
                            "change", {
                            minDate: new Date($('#dateFromTwo').val())
                        });
                       $("#dateFromTwo").datepicker({dateFormat: "dd/mm/yy"});
                    }
                });
        
                $("#dateToTwo").datepicker({
                    onClose: function () {
                        $("#dateFromTwo").datepicker(
                            "change", {
                            maxDate: new Date($('#dateToTwo').val())
                        });
                        $("#dateToTwo").datepicker({dateFormat: "dd/mm/yy"});
                    }
                });
            });
        </script>
</head>
<body>

    
    <strong> Select Start Date: </strong><br>
    <!-- <input type="text" id="start" placeholder="Start Date">  -->
    <input type="text" name="dateFromTwo" id="dateFromTwo" readonly="true" value="" class="textbox" />

    <br><br>
   <strong> Select End Date: </strong><br>
    <!-- <input type="text" id="end" placeholder="End Date"> -->
    <input type="text" name="dateToTwo" id="dateToTwo" readonly="true" value="" class="textbox" />



    <div>
        <div class="row1">
            <label>Make:</label><br /> <select
                id="country-list-two" name="country-list-two" 
                class="demoInputBox"
                onChange="getStateTwo();" multiple size=4>
                <option value="">Select Make</option>
<?php
foreach ($countryResult as $country) {
    ?>
<option value="<?php echo $country["make"]; ?>"><?php echo $country["make"]; ?></option>
<?php
}
?>
</select>
        </div>
        <div class="row">
            <label>....Model:</label><br /> <select name="state-list-two"
                id="state-list-two" class="demoInputBox" multiple size=5>
                <option value="">Select Model</option>
            </select>
        </div>
    </div>
</body>
</html>