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
	include('../scripts/audioModeController.php'); 
	include('../scripts/menuController.php');
	include('../scripts/activitySettingController.php');
?>
<body layout="column" ng-controller="app">
	<md-toolbar layout="row">
    	<?php include_once 'toolbar.php'?>
    </md-toolbar>
    <div layout="row" flex="100" ng-controller="audioModeController">
    	<?php include_once 'menu.php'?>
        <div layout="column" flex id="content">
        	<md-content layout="column" flex class="md-padding">
            	<div  class="titleChecker" style="height: 27px;" >
                	<span class="md-title" id="pageID">Activity Settings</span>
                </div>
                <div layout="row" layout-wrap ng-controller="activitySettingController">
                	<md-card flex>
                    	<md-card-content class="cards">
                        	<form >
                        	<uib-accordion close-others="true">
                            	<uib-accordion-group heading="Top Text Setting">
                                	<div layout="column">
                                    	<md-radio-group ng-model="user.topText">
                                        	<md-radio-button value="0" class="md-primary">Text (default)</md-radio-button>
                                            <md-radio-button value="1" class="md-primary">Hidden</md-radio-button>
                                            <md-radio-button value="2" class="md-primary">Answer</md-radio-button>
                                        </md-radio-group>
                                    </div>
                                </uib-accordion-group>
                                <uib-accordion-group heading="Top Audio Setting">
                                	<md-radio-group ng-model="user.topAudio">
                                        	<md-radio-button value="0" class="md-primary">Show (default)</md-radio-button>
                                            <md-radio-button value="1" class="md-primary">Hidden</md-radio-button>
                                        </md-radio-group>
                                </uib-accordion-group>
                                <uib-accordion-group heading="Image Setting">
                                	<md-radio-group ng-model="user.image">
                                        	<md-radio-button value="0" class="md-primary">Show (default)</md-radio-button>
                                            <md-radio-button value="1" class="md-primary">Hidden</md-radio-button>
                                        </md-radio-group>
                                </uib-accordion-group>
                                <uib-accordion-group heading="Bottom Text Setting">
                                	<div layout="column">
                                    	<md-radio-group ng-model="user.bottomText">
                                        	<md-radio-button value="0" class="md-primary">Text (default)</md-radio-button>
                                            <md-radio-button value="1" class="md-primary">Hidden</md-radio-button>
                                            <md-radio-button value="2" class="md-primary">Answer</md-radio-button>
                                        </md-radio-group>
                                    </div>
                                </uib-accordion-group>
                                <uib-accordion-group heading="Bottom Audio Setting">
                                	<md-radio-group ng-model="user.bottomAudio">
                                        	<md-radio-button value="0" class="md-primary">Show (default)</md-radio-button>
                                            <md-radio-button value="1" class="md-primary">Hidden</md-radio-button>
                                        </md-radio-group>
                                </uib-accordion-group>
                            </uib-accordion>
                            </form>
                        </md-card-content>
                    </md-card >
                    <md-card flex class="items" id="card1" hide-sm hide-xs>
                        <md-card-content class="cards" >
                            <div layout="column" layout-align="center center" >
                                <div layout="column" layout-align="center center">
                                    <p class="noSelect" ng-hide="card1.hideTopText">{{card1.topText}}</p>
                                    <md-button ng-hide="card1.hideTopCover" class="md-primary md-hue-1" ng-click="ShowTopHidden()">
                                        <i class="fa fa-3x fa-question-circle ng-scope"></i>
                                    </md-button>
                                    <div layout="row" ng-hide="card1.hideTopAnswer">
                                        <md-input-container flex >
                                              <label>What is name of this?</label>
                                              <input ng-model="topUserAnswer">
                                        </md-input-container>
                                        <md-button ng-click="TopCheckAnswer()">enter</md-button>
                                    </div>
                                    <div layout="row" flex class="alert alert-success" layout-align="center center" ng-hide="card1.hideTopCorrect">
                                        Correct, answer was: {{card1.topText}}
                                    </div>
                                    <div layout="row" flex class="alert alert-danger" layout-align="center center" ng-hide="card1.hideTopIncorrect">
                                        Incorrect, answer was: {{card1.topText}}
                                    </div>
                                </div>
                                <div layout="row" layout-align="center center">
                                    <md-button class="md-primary md-hue-1" ng-click="PlayTopAudio()">
                                        <i class="fa fa-3x fa-play-circle ng-scope"></i>
                                    </md-button>
                                </div>
                                <img ng-src="{{card1.imageSrc}}" class=' noSelect cardImage' />
                                <div layout="row" layout-align="center center">
                                    <md-button class="md-primary md-hue-1" ng-click="PlayBottomAudio()">
                                        <i class="fa fa-3x fa-play-circle ng-scope"></i>
                                    </md-button>
                                </div>
                                <div layout="column" layout-align="center center">
                                    <p class="noSelect" ng-hide="card1.hideBottomText">{{card1.bottomText}}</p>
                                    <md-button ng-hide="card1.hideBottomCover" class="md-primary md-hue-1" ng-click="ShowBottomHidden()">
                                        <i class="fa fa-3x fa-question-circle ng-scope"></i>
                                    </md-button>
                                    <div layout="row" ng-hide="card1.hideBottomAnswer">
                                        <md-input-container flex >
                                              <label>What is name of this?</label>
                                              <input ng-model="bottomUserAnswer">
                                        </md-input-container>
                                        <md-button ng-click="BottomCheckAnswer()">enter</md-button>
                                    </div>
                                    <div layout="row" class="alert alert-success" layout-align="center center" ng-hide="card1.hideBottomCorrect">
                                        Correct, answer was: {{card1.bottomText}}
                                    </div>
                                    <div layout="row" class="alert alert-danger" layout-align="center center" ng-hide="card1.hideBottomIncorrect">
                                        Incorrect, answer was: {{card1.bottomText}}
                                    </div>
                                </div>
                            </div>
                        </md-card-content>
                   </md-card>
                </div>
            </md-content>
        </div>
    </div>
  
</body>
</html>