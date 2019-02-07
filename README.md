# Kelley Blue Book Interactive B2B Data Analysis Dashboard

This repository containts my work during my Internship at Kelley Blue Book (Tech Mahindra) in the Summer of 2018. Find a demo of the product I built at: https://bit.ly/2BjWc6j


Documentation for all the Files: 

webPage.php is the overlying file over everything. Within webPage.php all of the dynamic drop downs are included from their own php files.4 Within webPage.php, prax.php is included. Also the html/css with all of the front-end is in webPage.php ex) the side bar, logo, footer, etc. The line graph is rendered in webPage.php.

pieCharts.php renders the pie charts and calls the file with the ajax calls which is called onclickFunctions.js.

onclickFunctions.js has all of the ajax calls used in the entire project. 3 for the pie charts, 2 for the line graphs and 1 for total price checks. They are organized based on the onClick function for the first submit button and for the second submit button.

Index.php has the dynamic dropdown of all the makes present in the database. This also contains the logic that populates the model database based on which make is selected. All of this is populated dynamically from the database, so as the database changes, the dropdowns will change accordingly, and nothing will be needed to be manually edited.

Index.php uses get_model.php in order to correctly index the models for a specific make.

Location.php and client.php are each single dynamic dropdowns for location and client.

indexTwo.php,location_two.php , and client_two.php are the identical versions of the first dropdowns for the comparison option.

Accordingly indexTwo.php uses get_model_two.php.

validateInput.php uses POST to get the options selected in the form and uses which variables were set in order to go into the correct conditional statement. This sql command creates a type of temporary table that is used to create the line graph.

clientPie.php, locationPie.php, and makePie.php all create pie charts by selecting the top 5 of each from the past 2 months and displaying it in a pie/doughnut chart.

DBController.php connects to the database and is included in the top of whatever file needs to connect. When the database changes, this file is what should be updated.
