<?php
	
	/*
	* @Author Sean O'Brien
	* @Version 1.0.5
	* @Copyright : © Copyright 2008 openlanguages.net
	* @Desicription: Dashboard -where user can click view there Anglaytics, Create or Remove Users, and Global access other account Angalytics
	*/
	session_start();
	
	if(!$_SESSION['sessionToken'])
	{
		header("LOCATION: signin.php?lastLocation=dashboard.php");	
	}
?>
<!DOCTYPE html>

<html lang="en" ng-app="flexApp">
<title>flexitutor</title>
<?php 
	include('header.php');
	include('../scripts/audioModeController.php');
	include('../scripts/menuController.php');
	include('../scripts/dashboardController.php');
?>

<body layout="column" ng-controller="app">
	<md-toolbar layout="row">
    	<?php include_once 'toolbar.php'?>
    </md-toolbar>
    <div layout="row" flex="100" ng-controller="audioModeController">
    	<?php include_once 'menu.php'?>
        <div layout="column" flex id="content" ng-controller="dashboardController">
        	<md-content layout="column" flex class="md-padding">
            	<div  class="titleChecker" style="height: 27px;" >
                	<span class="md-title">Dashboard</span>
                </div>
                <div layout="row" layout-wrap>
                	
                </div>
            </md-content>
        </div>
    </div>
  
</body>
</html>