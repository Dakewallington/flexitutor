<script>
	/**********************************************
	For AudioMode which can help blind and visual to naviage and hear the page.
	Author: Sean O'Brien
	Ver. 1.0.5
	Copyright 2008 openlanguages.net
	**********************************************/

	flexApp.controller ('audioModeController', function($scope,$mdDialog,$rootScope, hotkeys, $cookies, $timeout, meSpeakService)
	{
		$scope.timeOut = false
		$scope.audioMode = false;
		
		$scope.pageName = '<?php echo str_replace('/fileadmin/site/alpha1.0.5/php/','',$_SERVER['PHP_SELF']);?>';
		
		if($cookies.get('audioModeCookie'))
		{
			$scope.audioMode = true;
			$scope.audioModeKey = $scope.audioMode;	
		}
		else
		{
			$scope.audioMode = false;
			$scope.audioModeKey = $scope.audioMode;		
		}
		
		$scope.ToggleAudioMode = function()
		{
			$scope.audioMode = !$scope.audioMode;
			$scope.audioModeKey = $scope.audioMode;
			if($scope.audioMode)
			{
				$cookies.put('audioModeCookie',true);
				$scope.pageIntroJSON();
				
			}
			else
			{
				$cookies.remove('audioModeCookie');
			}
			
		}
		
		$scope.pageIntroJSON = function()
		{
			
			for(var i = 0; i < menuGreetings.length; i++)
			{
				//console.log(menuGreetings[i].id);
				if($scope.pageName == menuGreetings[i].id)
				{
					
					meSpeakService.Talk([{text: "audioMode"},{text: menuGreetings[i].text},menuGreatingPartTwo[0], menuGreatingPartTwo[1] ]);	
				}
			}
		}
		
		$scope.PageHelp = function()
		{
			//console.log("P");
			for(var i = 0; i < pageHelp.length; i++)
			{
				//console.log(pageHelp[i].id);
				if($scope.pageName == pageHelp[i].id)
				{
					meSpeakService.Talk(pageHelp[i].menuOptions);	
				}
			}	
		}
		
		$scope.NavHelp = function()
		{
			
			meSpeakService.Talk(navigationHelp);	
				
			
		}
		
		/////////////////////////////////////////////////////
				//Keybinding
		/////////////////////////////////////////////////////
		hotkeys.bindTo($scope)
		.add
		(
			{
				
				combo: 'ctrl+a',
				description: 'toggle audioMode boolen',
				callback: function()
				{
					event.preventDefault();
					$scope.ToggleAudioMode();
				}
			}
		);
		hotkeys.bindTo($scope)
		.add
		(
			{
				combo: 'alt+1',
				description: 'load dashboard',
				callback: function()
				{
					event.preventDefault();
					$scope.LoadPage('dashboard');
				}
			}
		);
		hotkeys.bindTo($scope)
		.add
		(
			{
				combo: 'alt+2',
				description: 'load manageusers',
				callback: function()
				{
					event.preventDefault();
					$scope.LoadPage('manageusers');
				}
			}
		);
		hotkeys.bindTo($scope)
		.add
		(
			{
				combo: 'alt+3',
				description: 'load activity',
				callback: function()
				{
					event.preventDefault();
					$scope.LoadPage('activity');
				}
			}
		);
		hotkeys.bindTo($scope)
		.add
		(
			{
				combo: 'alt+4',
				description: 'load indivan alytics',
				callback: function()
				{
					event.preventDefault();
					$scope.LoadPage('indivanalytics');
				}
			}
		);
		hotkeys.bindTo($scope)
		.add
		(
			{
				combo: 'alt+5',
				description: 'load global analytics',
				callback: function()
				{
					event.preventDefault();
					$scope.LoadPage('globalanalytics');
				}
			}
		);
		hotkeys.bindTo($scope)
		.add
		(
			{
				combo: 'alt+6',
				description: 'load account',
				callback: function()
				{
					event.preventDefault();
					$scope.LoadPage('account');
				}
			}
		);
		hotkeys.bindTo($scope)
		.add
		(
			{
				combo: 'alt+7',
				description: 'load Activity Settings',
				callback: function()
				{
					event.preventDefault();
					$scope.LoadPage('activitysetting');
				}
			}
		);
		hotkeys.bindTo($scope)
		.add
		(
			{
				combo: 'alt+8',
				description: 'load mespeak',
				callback: function()
				{
					event.preventDefault();
					$scope.LoadPage('mespeak');
				}
			}
		);
		
		hotkeys.bindTo($scope)
		.add
		(
			{
				combo: 'f1',
				description: 'options help',
				callback: function()
				{
					event.preventDefault();
					$scope.PageHelp();
				}
			}
		);
		hotkeys.bindTo($scope)
		.add
		(
			{
				combo: 'f2',
				description: 'Navagtion help',
				callback: function()
				{
					event.preventDefault();
					$scope.NavHelp();
				}
			}
		);
	});
</script>