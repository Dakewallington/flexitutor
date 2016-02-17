<?php
	
	/*
	* @Author Sean O'Brien
	* @Version 1.0.5
	* @Copyright : © Copyright 2008 openlanguages.net
	* @Desicription: Activity Lesssons where display the Activty Cards and diffrent langueess Mixer
	*/
		
	//turn on the output buffering
	ob_start();
	
	//start SESSION()
	session_start(); 
	
	
	if($_SESSION['sessionToken'] == NULL)
	{
		header('Location: signin.php?lastLocation=activity');
		exit;	
	}
?>
<!DOCTYPE html>

<html lang="en" ng-app="flexApp">
<title>flexitutor</title>
<?php 
	include('header.php'); 
	include('../scripts/activityController.php');
	include('../scripts/audioModeController.php');
	include('../scripts/cardsController.php');
	include('../scripts/selectorController.php');
	
	include('../scripts/menuController.php');
	

	
?>
<body layout="column" ng-controller="app" >
	<md-toolbar layout="row">
    	<?php include_once 'toolbar.php'?>
    </md-toolbar>
    <div layout="row" flex="100" ng-controller="audioModeController">
    	<?php include_once 'menu.php'?>
        <div layout="column" flex id="content">
        	<md-content layout="column" flex class="md-padding">
            	<div  class="titleChecker" style="height: 27px;" >
                	<span class="md-title" id="title">Activity Lessons</span>
                </div>
                <div layout="column" layout-wrap ng-controller="activityController">
                        <div flex ng-show="enable.activitySelectControllerKeyBinding">
                        	<?php include('activitySelecter.php'); ?>
                        </div>
                        <div flex ng-show="enable.activityCardsControllerKeyBinding">
                        	<?php include('activityCards.php'); ?>
                        </div>
                </div>
                
            </md-content>
        </div>
    </div>
  	

</body>
</html>