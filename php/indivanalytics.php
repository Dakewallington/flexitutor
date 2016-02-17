<?php
	
	/*
	* @Author Sean O'Brien
	* @Version 1.0.5
	* @Copyright : © Copyright 2008 openlanguages.net
	* @Desicription: Dashboard -where user can click view there Anglaytics, Create or Remove Users, and Global access other account Angalytics
	*/
		
	//turn on the output buffering
	ob_start();
	
	//start SESSION()
	session_start(); 
	
	
	/*if($_SESSION['name'] == NULL)
	{
		header('Location: log.php?lastLocation=' . $_SERVER['REQUEST_URI']);
		exit;	
	}*/
?>
<!DOCTYPE html>

<html lang="en" ng-app="flexApp">
<title>flexitutor</title>
<?php 
	include('header.php'); 
	include('../scripts/audioMode.php');
?>
<body layout="column" ng-controller="app">
	<md-toolbar layout="row">
    	<?php include_once 'toolbar.php'?>
    </md-toolbar>
    <div layout="row" flex="100" ng-controller="audioMode" data-ng-init="init()">
    	<?php include_once 'menu.php'?>
        <div layout="column" flex id="content" >
        	<md-content layout="column" flex class="md-padding">
            	<div  class="titleChecker" style="height: 27px;" >
                	<span class="md-title" id="pageID">Analytics</span>
                </div>
                <div layout="row" layout-wrap>
                	
                </div>
            </md-content>
        </div>
    </div>
  
</body>
</html>