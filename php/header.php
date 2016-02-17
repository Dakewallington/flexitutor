
<!--
	/*
	* @Author Sean O'Brien
	* @Version 1.0.5
	* @Copyright : © Copyright 2008 openlanguages.net
	* @Desicription: Header were all the main links & scripts for all the page.
	*/
-->

<head>
<title>Flexitutor</title>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"  />
<link rel="stylesheet" type="text/css" href="../css/bootflat.css" />
<link rel="stylesheet" type="text/css" href="../css/styles.css"  />
<link href="../css/font-awesome.css" rel="stylesheet"><!-- "Font Awesome by Dave Gandy - http://fontawesome.io".-->
<link rel="stylesheet" href="../css/angular-material.css">
<link rel="stylesheet" href="../angularLib/ngProgress/ngProgress.css">


<script src="../scripts/jquery-2.1.1.min.js"></script>
<script src="../json/textFile.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-cookies.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.js"></script>
<script src="../scripts/ui-bootstrap-tpls-0.14.3.js"></script>
<script src="../scripts/angular-material.js"></script>
<script src="../mespeak/mespeak.full.js"></script>
<script src="../angularLib/ngHotkeys/hotkeys.js"></script>
<script src="../angularLib/ngAudio/app/angular.audio.js"></script>
<script src="../angularLib/ngProgress/ngprogress.js"></script>

<script>
	meSpeak.loadConfig("../mespeak/mespeak_config.json");
	meSpeak.loadVoice("../mespeak/voices/en/en.json");
	var flexApp = angular.module('flexApp',['ui.bootstrap', 'ngMaterial','ngCookies','cfp.hotkeys','ngRoute','ngAnimate','ngAudio','ngProgress']);
	
	
	flexApp.service('meSpeakService', function() //this is a global function to any other angular service, controller, and factory.
	{
		this.Talk = function(json)
		{
			meSpeak.stop();
			meSpeak.speakMultipart(json);	
		}
		this.ReloadVoice = function()
		{
			meSpeak.loadVoice("../mespeak/voices/en/en.json");	
		}
		this.StopSpeak = function()
		{
			meSpeak.stop();	
		}
	});
	
	flexApp.service('activityMode', function() //this hold the code from activity Slection to transfer to actvity Cards
	{
		this.data =
		{
			unit: '',
			module: '',
			chapter:  '',
			drill: '' 
		};
	});
	
	flexApp.service('activityModeCall', function() //this toggle between both activity cards and selector
	{
		this.startSelector = true;
		this.startCards = false;
		
		this.SwitchMode = function()
		{
			this.startSelector = !this.startSelector;
			this.startCards = !this.startCards;
		}
	});
		
	flexApp.directive('focusIf', function($cookies, $parse, $timeout, meSpeakService) //this allow the user to hightlight selected menu item in a list. 
	{																				  //if they have meSpeak actve then meSpeakService will get trigger.
		return {
			restrict: 'A',
			link: function (scope, element, attrs)
			{
				var model = $parse(attrs.focusIf);
            	scope.$watch(model, function(value) 
				{
					if (value === true) 
					{ 
						$timeout(function() 
						{
							
							element[0].focus();
							if($cookies.get('audioModeCookie'))
							{
								meSpeakService.Talk([{text: element.html()}]);	
							}
						});
					}
				});
            }
			
		};
		
	});

	flexApp.directive('focusInput', function($cookies, $parse, $timeout)
	{
		return {
			restrict: 'A',
			link: function (scope, element, attrs)
			{
				var model = $parse(attrs.focusInput);
            	scope.$watch(model, function(value) 
				{
					if (value === true) 
					{ 
						$timeout(function() 
						{
							
							element[0].focus();
							
						});
					}
				});
            }
			
		};
		
	});

	<?php 
		include_once('../scripts/matteral.js');
		
		
	?>
	
</script>

</head>