<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Record Form</title>
</head>
<body>
    
      <!-- javascript-->
	  <script src="node_modules/moment/moment.js"></script>
<!-- <script type="text/javascript" src="js/jquery.min.js"></script> -->
<script type="text/javascript" src="js/Chart.min.js"></script>
<script href="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"> </script> 
<!-- labels on doughnut -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.0/angular.min.js"></script> -->
<style>
	/*this style block is to put the 3 pie charts side by side*/
.column {
    float: left;
	width: 33.33%;
	padding: 10px;
}

/* Clear floats after the columns */
.rowNew:after {
    content: "";
    display: table;
    clear: both;
}

	</style>


<div class="rowNew">
  <div class="column" >
	  <!-- renders client pie chart -->
  <canvas id="myClientPie" height="300"></canvas>
  </div>
  <div class="column">
	  <!-- renders location pie chart -->
  <canvas id="myLocationPie" height="300"></canvas>
  </div>
  <div class="column">
	  <!-- renders make pie chart -->
    <canvas id="myMakePie" height="300"></canvas>
  </div>
</div>
<div id="chart-container"> 
<!-- renders line chart -->
            <canvas id="mycanvas"></canvas>
            
</div>
	
<center> 
	<!-- renders the total price checks text from ajax call -->
			 <h2><div id="myText"></div></h2> </center>


			 <script> //TOTAL price checks ajax call
  $("#result_button").click(function(e) { //result_button is the first submit button's id
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "http://localhost/prax/totalCount.php", //this is the php file with the sql query to create total count of price checks
        data: $('#result_form').serialize(),
       success: function(data) {
		console.log(data);
		data = data.slice(1, -1); //data needed to be sliced because extra numbers were being appended
		data = "Total Price Checks: " + data;
		 document.getElementById("myText").innerHTML = data; 
		
		},
		error: function(data) {
			console.log("error");
		}
    });
});

  </script>
  


  <script> //LOCATION PIE CHART ajax call
  $("#result_button").click(function(e) { //first submit buttn
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "http://localhost/prax/locationPie.php",
        data: $('#result_form').serialize(),
       success: function(data) {
			console.log(data);
			var location = [];
            var c =  [];
          

			for(var i in data) {
				location.push(data[i].location);
               c.push(data[i].c);
                
			}
			
			var chartdata = {
				labels: location,
				datasets : [
					{
						label: "Location ", //make this change dynamically 
						backgroundColor: ['#fcc628','#f69020','#1f5792','#c0c0c0','#5198d5'],
						borderColor: 'darkblue',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 0, 0.75)',
						data: c
					}
				]
			}
			
// 			$('#myLocationPie').remove();
// $('#chart-container').append('<canvas id="myLocationPie"></canvas>');

			var ctx = $("#myLocationPie");
			 var pieGraph = new Chart(ctx, {
				type: 'doughnut', //change to pie if you prefer over doughnut
                data: chartdata,
				
               options:{
				scales: {
					yAxes: [{
						scaleLabel: {
							display: false,
							labelString: 'Price Check Distribution By Location',
							fontSize: 10
						},
						ticks: {
							beginAtZero : true,
							display: false
						},
						gridLines: {
                    display:false,
					drawBorder: false
                       }
					}]
					
				},
		title: {
            display: true,
            text: 'Top 5 Locations',
			fontSize: 25
        },
		legend: {
			display: false, //make true if you want a legend for pie chart
			position: 'bottom'
		}		
   } 
});
			
		},
		error: function(data) {
			console.log(data);
		}
    });
});

  </script>


  <script> //CLIENT pie graph
  $("#result_button").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "http://localhost/prax/clientPie.php",
        data: $('#result_form').serialize(),
       success: function(data) {
			console.log(data);
			var cpmodule = [];
            var c =  [];
          

			for(var i in data) {
				cpmodule.push(data[i].cpmodule);
               c.push(data[i].c);
                
			}
			
			var chartdata = {
				labels: cpmodule,
				datasets : [
					{
						label: "Location ", //make this change dynamically 
						backgroundColor:  ['#fcc628','#f69020','#1f5792','#c0c0c0','#5198d5'],
						borderColor: 'darkblue',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 0, 0.75)',
						data: c
					}
				]
			}
			
// 			$('#myClientPie').remove();
// $('#chart-container').append('<canvas id="myClientPie"></canvas>');

			var ctx = $("#myClientPie");
			 var pieGraph = new Chart(ctx, {
				type: 'doughnut',
                data: chartdata,
               options:{
				scales: {
					yAxes: [{
						scaleLabel: {
							display: false,
							labelString: 'Price Check Distribution By Client',
							fontSize: 10
						},
						ticks: {
							beginAtZero : true,
							display: false
						},
						gridLines: {
                    display:false,
					drawBorder: false
                }
					}]
					
				}
				,
				title: {
            display: true,
            text: 'Top 5 Clients',
			fontSize: 25
        },
		legend: {
			display: false,
			position: 'bottom'		
		}
			   } 
			});
			
		},
		error: function(data) {
			console.log(data);
		}
    });
});

  </script>

<script> //MAKE PIE CHART
  $("#result_button").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "http://localhost/prax/makePie.php",
        data: $('#result_form').serialize(),
       success: function(data) {
			console.log(data);
			var make = [];
            var c =  [];
          

			for(var i in data) {
				make.push(data[i].make);
               c.push(data[i].c);
                
			}
			
			var chartdata = {
				labels: make,
				datasets : [
					{
						label: "Location ", //make this change dynamically 
						backgroundColor:  ['#fcc628','#f69020','#1f5792','#c0c0c0','#5198d5'],
						borderColor: 'darkblue',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 0, 0.75)',
						data: c
					}
				]
			}
			
// 			$('#myMakePie').remove();
// $('#chart-container').append('<canvas id="myMakePie"></canvas>');

			var ctx = $("#myMakePie");
			 var pieGraph = new Chart(ctx, {
				type: 'doughnut',
                data: chartdata,
               options:{
				scales: {
					yAxes: [{
						scaleLabel: {
							display: false,
							labelString: 'Price Check Distribution By Make',
							fontSize: 10
						},
						ticks: {
							beginAtZero : true,
							display:false
						},
						gridLines: {
                    display:false,
					drawBorder:false
                }
					}]
					
				},
				title: {
            display: true,
            text: 'Top 5 Makes',
			fontSize: 25
        },
		legend: {
			position: 'bottom',
			display: false
		}
			   } 
			});
			
		},
		error: function(data) {
			console.log(data);
		}
    });
});

  </script>
   


   <script> //line graph ajax call
  $("#result_button").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "http://localhost/prax/insert.php",
        data: $('#result_form').serialize(),
       success: function(data) {
			console.log(data);
			var date_time = [];
            var c =  [];
            var barGraph; //ignore the name, it represents a line graph

			for(var i in data) {
				date_time.push(data[i].date_time);
               c.push(data[i].c); 
			}
			
			var chartdata = {
				labels: date_time,
				datasets : [
					{
						label: "Filter Criteria 1 ", //make this change dynamically 
						backgroundColor: 'rgba(255,140,0,0)',
						borderColor: 'darkblue',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 0, 0.75)',
						data: c
					}
				]
			}
			
			$('#mycanvas').remove(); //these two lines exist to fix the hover over problem where the graph would flicker back and forth
$('#chart-container').append('<canvas id="mycanvas"></canvas>');

			var ctx = $("#mycanvas");
			barGraph = new Chart(ctx, {
				type: 'line',
                data: chartdata,
               options:{
				scales: {
					yAxes: [{
						scaleLabel: {
							display: true,
							labelString: 'Number of Price Checks',
							fontSize: 20
						},
						ticks: {
							beginAtZero : true
						}
					}],
					xAxes: [{
						type: 'time',
						time :{
							unit: 'week' //makes the labels go by week, can be changed to any other date unit
						}
					}]
					
				}
			   } 
			});
			$("#result_button_two").click(function(e) { //nested ajax call within the first one makes sure that the second one goes chronologically second.
    e.preventDefault(); //on click of second submit button
    $.ajax({ //ajax call to add a comparison line to the graph
        type: "POST",
        url: "http://localhost/prax/insert_two.php",
        data: $('#result_form_two').serialize(),
       success: function(data) {
		
			console.log(data);
			var date_time = [];
            var c =  [];
         

			for(var i in data) {
				date_time.push(data[i].date_time);
               c.push(data[i].c);
                
			}
			
			
				barGraph.data.datasets.push( //pushes a dataset into the prexisting graph
					{
						label: "Filter Criteria 2 ", //make this change dynamically 
						backgroundColor: 'rgba(0,0,139,0)',
						borderColor: 'orange',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 0, 0.75)',
						data: c
					});
					barGraph.update();
		
			
		},
		error: function(data) {
			console.log(data);
		}
    });
});
			
		},
		error: function(data) {
			console.log(data);
		}
    });
});

  </script>



</body>
</html>