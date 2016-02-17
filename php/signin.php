<?php
	
	/*
	* @Author Sean O'Brien
	* @Version 1.0.5
	* @Copyright : © Copyright 2008 openlanguages.net
	* @Desicription: Signin is were the user Sign in or Sign up
	*/
	
	session_start();
	
	if($_GET['sign'])
	{
		$_SESSION['sessionToken'] = true;
		if($_GET['lastLocation'] != NULL)
		{
			header("LOCATION: " . $_GET['lastLocation']);	
		}
		else
		{
			header("LOCATION: dashboard.php");		
		}

	}
?>
<!DOCTYPE html>

<html lang="en" ng-app="flexApp">
<title>flexitutor</title>
<?php 
	include('header.php');
	include('../scripts/audioModeController.php');
	include('../scripts/logController.php');
	include('../scripts/menuController.php');
?>

<body layout="column" ng-controller="app">
	<md-toolbar layout="row">
    	<?php include_once 'toolbarLog.php'?>
    </md-toolbar>
    <div layout="row" flex="100">
    	
        <div layout="column" flex id="content" ng-controller="audioModeController">
        	<md-content layout="column" flex class="md-padding">
                <md-card ng-controller="logController" data-ng-init="init()">
                	<md-card-content class="cards">
                    	<div class="alert alert-danger" ng-show="error">{{errorVisualMesssage}}</div>
                		<h3>Welcome, Please Sign In</h3>
                        <br/>
                        
                        
                        <form class="form" id="logForm" ng-submit="submit()">
                        	<md-input-container>
                            	<label>Email Address</label>
                                <input type="email" ng-model="user.email" focus-input="'email' == focusInputID" id="email" name="email">
                            </md-input-container>
                            <md-input-container>
                            	<label>Password</label>
                                <input type="password" ng-model="user.password" id="password" focus-input="'password' == focusInputID" name="password">
                            </md-input-container>
                            
                            <md-button class="md-raised md-primary">Sign In</md-button>
                        </form>
                       <br/>
                        <hr />
                        <br/>
                        <div flex="100" layout="row" layout-align="center center">
                        	<md-button class="md-primary" aria-label="loss password"><md-tooltip>Lost Password</md-tooltip><span class="fa-stack fa-2x"><i class="fa fa-unlock-alt"></i><i class="fa fa-question fa-stack-2x text-danger"></i>
</span></md-button>
                            <md-button class="md-primary" aria-label="Create Account" ng-href="create.php"><md-tooltip>Create Account</md-tooltip> <i class="fa fa-2x fa-user-plus" ></i></md-button>
                            <b>Audio Mode</b><md-switch ng-model="audioModeKey" ng-true="audioModeToggle()" ng-false="audioModeToggle()" class="md-primary" md-no-ink aria-label="Switch No Ink" ></md-switch>
                        </div>
                    </md-card-content>
                </md-card>
                
            </md-content>
        </div>
    </div>
  
</body>
</html>