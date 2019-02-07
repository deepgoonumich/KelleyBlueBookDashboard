<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <title>IBB Price Check Dashboard</title>
 
  <!-- Bootstrap core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="css/bootstrap-select.min.css"> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script> -->
 
    <link href="css/custom.css" rel="stylesheet">
  </head>

  <body class="nav-md">
  
    <div class="container body">
      <div class="main_container" width="1280px">
         <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><img src="images/logo.png" alt="ibb logo" class="img-responsive logo"></a>
            </div>
            <div class="clearfix"></div>
            
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <!-- all the below includes are for the dynamic dropdowns(make/model ,location, client respectively) -->
              <form method="post" id="result_form">
                  <?php include 'index.php';?> 
                  <?php include 'location.php';?>
                  <?php include 'client.php';?>

    <input type="submit" value="Submit" id="result_button">
    <style type="text/css">
        #chart-container {
            width: 1000px;
            height: auto;
        }
        /* sets size of line graph canvas */
        </style>
</form> 
<style>
  /* all of this stuff in the style block is to reveal the second form 
  when checkbox is checked */
.reveal-if-active {
  opacity: 0;
  max-height: 0;
  overflow: hidden;
}
input[type="radio"]:checked ~ .reveal-if-active,
input[type="checkbox"]:checked ~ .reveal-if-active {
  opacity: 1;
  max-height: 100px; 
  overflow: visible;
}
  </style>

<input type="checkbox" name="choice-animals" id="choice-animals-dogs">
<label for="choice-animals-dogs">Compare</label> 

    
<div class="reveal-if-active">
<form method="post" id="result_form_two">
  <!-- these are the set of second drop downs that get revealed on checkbox -->
                  <?php include 'indexTwo.php';?>
                  <?php include 'location_two.php';?>
                  <?php include 'client_two.php';?>

    <input type="submit" value="Submit" id="result_button_two">
</form>
</div>




              </div>
            </div>
            <!-- /sidebar menu -->

          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.png" alt="">Super Admin
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;">Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i>Log Out</a></li>
                  </ul>
                </li>
                
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge bg-green">2</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
                
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-red">2</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        <!-- page content -->
        
        <div class="right_col" role="main">
          <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">Dashboard</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="#">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="hidden"><a href="#">Dashboard</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Dashboard</li>
                    </ol>
                    <div class="clearfix">
                    </div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
          
              
              <div>
                
                  <script src="node_modules/moment/moment.js"></script>
                  <!-- <script type="text/javascript" src="js/jquery.min.js"></script> -->
                  <!-- <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.4.min.js"></script> -->
                  <script type="text/javascript" src="js/Chart.min.js"></script>
                  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.0/angular.min.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
                     <!-- <script type="text/javascript" src="js/jquery.min.js"></script> -->
                <!-- <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.2.4.min.js"></script> -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
                  <!-- only other important part of this file is including prax.php -->
                        <?php include 'prax.php' ?>
              </div>
          
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="text-center">
           Copyright &copy; 2018 All rights reserved. <img src="images/logo.png">
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <!-- <script src="js/jquery.min.js"></script> -->
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- <script type="text/javascript" src="js/bootstrap-select.js"></script> -->
    <script type="text/javascript" src="js/bootstrap-select.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="js/custom.js"></script>
  </body>
  <style>
body {
     width: 1280px; 
    font-family: calibri;
}
</html>
