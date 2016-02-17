<script>
	/**********************************************
	For Actvity Selctor for Activity Lession
	Author: Sean O'Brien
	Ver. 1.0.5
	Copyright 2008 openlanguages.net
	**********************************************/
	// reason we have here so can get data back from 
	flexApp.controller('actvitySelector', function($scope, $http, $timeout, $interval, hotkeys, $rootScope, activityMode, $cookies, meSpeakService, ngProgressFactory, activityModeCall)
	{
		
		
		
		/*
		* app is what want do in flexitutor databank system
		* module is what want learn from that app
		* Chapter is what the module has for teaching
		* Drill is set cards that want study from chapter
		*/
		
		
		$scope.box =
		{
			appSectionHidden : true,
		    moduleSectionHidden : true,
			chapterSectionHidden : true,
			drillSectionHidden : true
		};
		
		$scope.keyHasPress = false;
		
		//this hold  the list data for selection.
		$scope.apps;
		$scope.modules;
		$scope.chapters;
		$scope.drills;
		
		//this hold the seleced item.
		$scope.app = ['Language'];
		$scope.module = ['Afrikaans-English_US'];
		$scope.chapter = [];
		$scope.drill = [];
		
		$scope.indexCounter = 1;
		$scope.oldIndexCounter = 0;
		
		$scope.maxLength = 0;
		$scope.currentFocusIndex = -1;
		$scope.focusIndex;
		
		$scope.selecedId = '';
		
		$scope.mainTimer = 15000; //set to 10.sec.
		$scope.secondTimer =2600; //set to 2.6sec.
		

		$scope.hasBeenCalled = false;

		
		$http
		(
			{
				method: 'GET',
				url: '../scripts/getAppsData.php'
			}
		)
		.then(function successCallback(response)
		{
			$scope.apps = response.data;
		
		},function errorCallback(respondse)
		{
			console.log('ERROR');
		});
		
		// get the list of modules 
		$scope.GetModules = function()
		{
			$scope.progressbar.start();
			$http
			(
				{	
					method: 'GET',
					url: '../scripts/getModulesData.php?app=' + $scope.app[0]
				}
			)
			 .then(function successCallback(response)
			{
				$scope.modules = response.data;
			
			},function errorCallback(respondse)
			{
				console.log('ERROR');
			});
		}
		
		// get the list of Chapters
		$scope.GetChapters = function()
		{
			$scope.progressbar.start();
			$http
			(
				{
					method: 'GET',
					url: '../scripts/getChaptersData.php'
			  	}
			 )
			 .then(function successCallback(response)
			{
				$scope.chapters = response.data;
			
			},function errorCallback(respondse)
			{
				console.log('ERROR');
			});
		}
		
		// get the list of Drills
		$scope.GetDrills = function()
		{
			$scope.progressbar.start();
			$http
			(
				{
					method: 'GET',
					url: '<?php
					$temp = $_SERVER['PHP_SELF'];
					$temp = str_replace('php/activity.php','',$temp);
					echo $temp;
			  		?>' + 'scripts/getDrillsData.php?chapter=' + $scope.chapter[0]
				}
			 )
			 .then(function successCallback(response)
			  {
				  $scope.drills = response.data;
				  $scope.progressbar.complete();
			  
			  },function errorCallback(respondse)
			  {
				  console.log('ERROR');
				  $scope.progressbar.stop();
			  });
		}
		
		$scope.nextBox = function(nextMenu)
		{
			//alert("Next Box recived " + nextMenu);
			switch(nextMenu)
			{
				case 'app':
				{
					$scope.box.appSectionHidden = false;
					$scope.box.moduleSectionHidden = true;
					$scope.box.chapterSectionHidden = true;
					$scope.box.drillSectionHidden = true;
					$scope.indexCounter = 1;
					break;
				}
				case 'module':
				{
					$scope.box.appSectionHidden = true;
					$scope.box.moduleSectionHidden = false;
					$scope.box.chapterSectionHidden = true;
					$scope.box.drillSectionHidden = true;
					$scope.indexCounter = 2;
					break;
				}
				case 'chapter':
				{
					$scope.box.appSectionHidden = true;
					$scope.box.moduleSectionHidden = true;
					$scope.box.chapterSectionHidden = false;
					$scope.box.drillSectionHidden = true;
					$scope.indexCounter = 3;
					break;
				}
				case 'drill':
				{
					$scope.box.appSectionHidden = true;
					$scope.box.moduleSectionHidden= true;
					$scope.box.chapterSectionHidden = true;
					$scope.box.drillSectionHidden = false;
					$scope.indexCounter = 4;
					break;
				}
				case 'cards':
				{
					//hide any menu that are up.
					$scope.box.appSectionHidden = true;
					$scope.box.moduleSectionHidden = true;
					$scope.box.chapterSectionHidden = true;
					$scope.box.drillSectionHidden = true;
					
					//tell activity service to update its 4 main data
					activityMode.data.app = $scope.app[0];
					activityMode.data.module = $scope.module[0];
					activityMode.data.chapter = $scope.chapter[0];
					activityMode.data.drill = $scope.drill[0];
					
					meSpeakService.StopSpeak();
					$scope.enableToggleController();
					activityModeCall.SwitchMode();
					break;
				}
			}
			$scope.currentFocusIndex = -1;
			
			
		}
		
		
		$scope.Update = function()
		{
			//each time we update we should update the other list data. 
			$scope.GetModules();
			$scope.GetChapters();
			$scope.GetDrills();
			
			
		}
		
		$interval(function()
		{
			if(activityModeCall.startSelector == true && $scope.hasBeenCalled != true)
			{
				alert();
				meSpeakService.ReloadVoice();
				if($scope.app[0] != null && $scope.module[0] != null)
				{
					$scope.nextBox('chapter');
				}
				else
				{
					$scope.nextBox('app');
				}
				
				$scope.GetModules();
				$scope.GetChapters();
				$scope.GetDrills();
				document.getElementById("title").innerHTML = 'Activity Lessons: Activity Planner';
				if($cookies.get('audioModeCookie'))
				{
					 var x = [{text: document.getElementById("title").innerHTML},menuGreatingPartTwo[0], menuGreatingPartTwo[1],{text: document.getElementById($scope.indexCounter).innerHTML}];
					 meSpeakService.Talk(x);
					$timeout(function()
					{
						//alert();
						if(!$scope.keyHasPress)
						{
							
							$scope.focusIndex = $scope.indexCounter + "-" + 0;
						}
						else
						{
							$scope.keyHasPress = !$scope.keyHasPress;	
						}
					}, $scope.mainTimer);
				}
			}
		},1000);
		
		$scope.$on = function()
		{
			$scope.hasBeenCalled = true;
			meSpeakService.ReloadVoice();
			if($scope.app[0] != null && $scope.module[0] != null)
			{
				$scope.nextBox('chapter');
			}
			else
			{
				$scope.nextBox('app');
			}
			
			$scope.GetModules();
			$scope.GetChapters();
			$scope.GetDrills();
			document.getElementById("title").innerHTML = 'Activity Lessons: Activity Planner';
			if($cookies.get('audioModeCookie'))
			{
				 var x = [{text: document.getElementById("title").innerHTML},menuGreatingPartTwo[0], menuGreatingPartTwo[1],{text: document.getElementById($scope.indexCounter).innerHTML}];
		  		 meSpeakService.Talk(x);
				$timeout(function()
				{
					//alert();
					if(!$scope.keyHasPress)
					{
						$scope.currentFocusIndex = 0;
						$scope.focusIndex = $scope.indexCounter + "-" + $scope.currentFocusIndex;
					}
					else
					{
						$scope.keyHasPress = !$scope.keyHasPress;	
					}
				}, $scope.mainTimer);
			}
			
			
		};
		
		$scope.SelctedData = function(menuName,value)
		{
			//alert("SelectData = " + menuName);
			switch(menuName)
			{
				case 'app':
					$scope.app[0] = value;
					$scope.nextBox('module');
					break;
				case 'module':
					$scope.module[0] = value;
					$scope.nextBox('chapter');
					break;
				case 'chapter':
					$scope.chapter[0] = value;
					$scope.nextBox('drill');
					break;
				case 'drill':
					$scope.drill[0] = value;
					$scope.nextBox('cards');
					break;	
			}
			$scope.Update();
		}
		
		$scope.SelectionUpDown = function(direction)
		{
			//console.log('X');
			$scope.CheckForMaxChange();
			
			switch(direction)
			{
				case 'up':
				{
					if($scope.currentFocusIndex != 0)
					{
						$scope.currentFocusIndex--;	
					}
					else
					{
						$scope.currentFocusIndex = $scope.maxLength - 1;	
					}
					break;	
				}
				case 'down':
				{
					if($scope.currentFocusIndex != $scope.maxLength - 1)
					{
						$scope.currentFocusIndex++;	
					}
					else
					{
						$scope.currentFocusIndex = 0;	
					}
					break;	
				}
			}
			$scope.focusIndex = $scope.indexCounter + "-" + $scope.currentFocusIndex;
			//console.log($scope.indexCounter + "-" + $scope.currentFocusIndex);
		};
		
		$scope.CheckForMaxChange = function()
		{
			//if were switch to new selection board we need make sure update max length
			
			var tempMax = 0;
			switch($scope.indexCounter)
			{
				case 1:
				{
					tempMax = $scope.apps.length;
					break;
				}
				case 2:
				{
					tempMax = $scope.modules.length;
					break;	
				}
				case 3:
				{
					tempMax = $scope.chapters.length;
					break;
					
				}
				case 4:
				{
					tempMax = $scope.drills.length;
					break;	
				}
			}
			//alert(tempMax);
			if(tempMax != $scope.maxLength)
			{
				$scope.maxLength = tempMax;
					
			}
		};
		
		
				
		/////////////////////////////////////////////////////
				//Keybinding
		/////////////////////////////////////////////////////
		$interval(function() //were going keep asking if the controller is true or not
		{
			if($scope.enable.activitySelectControllerKeyBinding)
			{
				//console.log("cardsSelecter");
				hotkeys.bindTo($scope)
				.add
				(
					{
						combo: 'right',
						description: 'Next Box',
						callback: function()
						{
							switch($scope.indexCounter)
							{
								case 1:
									if($scope.app[0] != null)
									{
										$scope.nextBox('module');
										$scope.Update();
									}
									
									
									break;
								case 2:
									if($scope.module[0] != null)
									{
										$scope.nextBox('chapter');
										$scope.Update();
									}
									
									break;
								case 3:
									if($scope.chapter[0] != null)
									{
										$scope.nextBox('drill');
										$scope.Update();
									}
									
									break;
								default:
									break;
							}
							if($cookies.get('audioModeCookie'))
							{
								
								
								meSpeakService.Talk([{text: document.getElementById($scope.indexCounter).innerHTML}]);	
								$timeout(function()
								{
									if(!$scope.keyHasPress)
									{
										$scope.focusIndex = $scope.indexCounter + "-" + 0;
									}
									else
									{
										$scope.keyHasPress = !$scope.keyHasPress;
									}
								},$scope.secondTimer);
							}
							
						}
					}
				);
				hotkeys.bindTo($scope)
				.add
				(
					{
						combo: 'left',
						description: 'Prev Box',
						callback: function()
						{
							switch($scope.indexCounter)
							{
								case 2:
									$scope.nextBox('app');
									$scope.Update();
									break;
								case 3:
									$scope.nextBox('module');
									$scope.Update();
									break;
								case 4:
									$scope.nextBox('chapter');
									$scope.Update();
									break;
								default:
									break;
							}
							if($cookies.get('audioModeCookie'))
							{
								
								
								meSpeakService.Talk([{text: document.getElementById($scope.indexCounter).innerHTML}]);	
								$timeout(function()
								{
									if(!$scope.keyHasPress)
									{
										$scope.focusIndex = $scope.indexCounter + "-" + 0;
									}
									else
									{
										$scope.keyHasPress = !$scope.keyHasPress;	
									}
								},$scope.secondTimer);
							}
						}
					}
				);
				hotkeys.bindTo($scope).add
				(
					{
						combo: 'up',
						callback: function()
						{
							event.preventDefault();
							$scope.SelectionUpDown('up');
							$scope.keyHasPress = !$scope.keyHasPress;
						}
					}
				);
				hotkeys.bindTo($scope).add
				(
					{
						combo: 'down',
						callback: function()
						{
							event.preventDefault();
							$scope.SelectionUpDown('down');
							$scope.keyHasPress = !$scope.keyHasPress;	
						}
					}
				);
				
				hotkeys.bindTo($scope).add
				(
					{
						combo: 'enter',
						callback: function()
						{
							event.preventDefault();
							if($scope.currentFocusIndex != -1)
							{
								switch($scope.indexCounter)
								{
									case 1:
									{
										$scope.chapter[0] = $scope.app[$scope.currentFocusIndex].name;
										$scope.nextBox('module');
										$scope.Update();
										if($cookies.get('audioModeCookie'))
										{
											
											
											meSpeakService.Talk([{text: document.getElementById($scope.indexCounter).innerHTML}]);	
										}
										break;
									}
									case 2:
									{
										$scope.chapter[0] = $scope.module[$scope.currentFocusIndex].name;
										$scope.nextBox('chapter');
										$scope.Update();
										if($cookies.get('audioModeCookie'))
										{
											
											
											meSpeakService.Talk([{text: document.getElementById($scope.indexCounter).innerHTML}]);	
											
										}
										break;
									}
									case 3:
									{
										$scope.chapter[0] = $scope.chapters[$scope.currentFocusIndex].name;
										$scope.nextBox('drill');
										$scope.Update();
										if($cookies.get('audioModeCookie'))
										{
											
											
											meSpeakService.Talk([{text: document.getElementById($scope.indexCounter).innerHTML}]);	
											
										}
										break;
									}
									case 4:
									{
										$scope.drill[0] = $scope.drills[$scope.currentFocusIndex].name;
										$scope.Update();
										$scope.nextBox('cards');
										break;
									}
									
								}
								$timeout(function()
								{
									if(!$scope.keyHasPress)
									{
										$scope.focusIndex = $scope.indexCounter + "-" + 0;
									}
									else
									{
										$scope.keyHasPress = !$scope.keyHasPress;
									}
									
								},$scope.secondTimer);
								
							}
						}
						
					}
				);
			
			}
		},1000);
		
		
	});
</script>