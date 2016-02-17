<script>

	/**********************************************
	For Actvity Cards for Activity Lession
	Author: Sean O'Brien
	Ver. 1.0.5
	Copyright 2008 openlanguages.net
	**********************************************/
	
	flexApp.controller('cards',function($scope, $http, $httpBackend, $interval, hotkeys, $animate, ngAudio, activityMode, meSpeakService, $cookies, ngProgressFactory,activityModeCall)
	{
				
		$scope.hasBeenCalled = false;
		
		$scope.backup = function()
		{
			meSpeakService.StopSpeak();
			$scope.enableToggleController();
			activityModeCall.SwitchMode();
		}
		
		
		
		$scope.CardsStart = function()
		{
			$scope.hasBeenCalled = true;
			$scope.cardMap = [];
			$scope.userMap = [];
			$scope.chapter = activityMode.data.chapter;
			$scope.drill = activityMode.data.drill;
			$http
			(
				{
					method: 'POST',
					url: '../scripts/getCardMapData.php?module=' + activityMode.data.module + "&chapter=" + activityMode.data.chapter + "&drill=" + activityMode.data.drill
				}
			)
			.then(function successCallback(response)
			{
				$scope.UpdateCards(response.data);
			
			},function errorCallback(respondse)
			{
				console.log('ERROR');
			});
			
			$http
			(
				{
					method: 'POST',
					url: '../scripts/getUserMapData.php?accountID=' + $cookies.get('accountID')
				}
			)
			.then(function successCallback(response)
			{
				$scope.UpdateUser(response.data);
				//console.log(response.data.topAudioTypeSetting);
			
			},function errorCallback(respondse)
			{
				console.log('ERROR');
			});
			$scope.currentCard = 0;
			document.getElementById("title").innerHTML = 'Activity Lessons: Activity Cards';
			if($cookies.get('audioModeCookie'))
			{
				var x = [{text: document.getElementById("title").innerHTML},menuGreatingPartTwo[0], menuGreatingPartTwo[1],{text: 'There are, ' + $scope.cardMap.length }];
		  		meSpeakService.Talk(x);
					
			}
			
			
		};
		
		$scope.backup = function()
		{
			meSpeakService.StopSpeak();
			$scope.enableToggleController();
			activityModeCall.SwitchMode();	
		}
		
		$scope.UpdateCards = function(data)
		{
			$scope.cardMap = data;
			$scope.cardMax = $scope.cardMap.length;
			$scope.SetView();
			
		};
		
		$scope.UpdateUser = function(data)
		{
			$scope.userMap = data;
			//console.log($scope.userMap[0].xSpeedSetting);
			$scope.speedToggleXAxis = $scope.userMap[0].xSpeedSetting;
			$scope.speedToggleYAxis = $scope.userMap[0].ySpeedSetting;
		};
		
		//card that is selected from the stack
		 $scope.cardSelected = 0;
		 
		 //create the 3 card template;
		 $scope.card1 = 
		 {
			'topText': '',
			'hideTopText': false,
			'hideTopCover': true,
			'topAudioMP3':'',
			'topAudioOGG':'',
			'imageSrc': '',
			'bottomText': '',
			'hideBottomText': false,
			'hideBottomCover': true,
			'bottomAudioMP3':'',
			'bottomAudioOGG':''
		 }
		 $scope.card2 = 
		 {
			'topText': '',
			'hideTopText': false,
			'hideTopCover': true,
			'hideTopAnswer': true,
			'hideTopCorrect': true,
			'hideTopIncorrect': true,
			'topAudioMP3':'',
			'topAudioOGG':'',
			'imageSrc': '',
			'bottomText': '',
			'hideBottomText': false,
			'hideBottomCover': true,
			'hideBottomAnswer': true,
			'hideBottomCorrect': true,
			'hideBottomIncorrect': true,
			'bottomAudioMP3':'',
			'bottomAudioOGG':''
		 }
		 $scope.card3 = 
		 {
			'topText': '',
			'hideTopText': false,
			'hideTopCover': true,
			'topAudioMP3':'',
			'topAudioOGG':'',
			'imageSrc': '',
			'bottomText': '',
			'hideBottomText': false,
			'hideBottomCover': true,
			'bottomAudioMP3':'',
			'bottomAudioOGG':''
		 }
		 
		
		 
		//setting up the blank template of the layout.
		$scope.cardMetaMap =		 
		{
			length : 3,
			cardIds : [$scope.cardSelected - 1, $scope.cardSelected, $scope.cardSelected + 1],
			ids: [$scope.card1, $scope.card2, $scope.card3]
		};
		
		// is auto play eneble
		$scope.toggleIsAutoPlay = false;
		  
		
		$scope.delayBetweenReadingXAxis = 3000;
		$scope.delayBetweenReadingYAxis = 3000; 
	   
	   //function for the cards
		
		
		$scope.GetCurrentSelected = function()
		 {
			// this move along the cards 
			$scope.cardMetaMap.cardIds[0] = $scope.cardSelected - 1;
			$scope.cardMetaMap.cardIds[1] = $scope.cardSelected;
			$scope.cardMetaMap.cardIds[2] = $scope.cardSelected + 1;
			
			//if $scope.cardSelection react to end we want to show X bottom card or forward card.
			if ($scope.cardSelected == 0) 
			{
				$scope.cardMetaMap.cardIds[0] = $scope.cardMap.length - 1;
			} 
			else if ($scope.cardSelected == $scope.cardMap.length - 1) 
			{
				$scope.cardMetaMap.cardIds[2] = 0;
			}
		 };
		
		$scope.SetView = function()
		{
			$scope.GetCurrentSelected();
			
			//setting the cards
			for(var iCard = 0; iCard < $scope.cardMetaMap.ids.length; iCard++)
			{
				
				var cardId = $scope.cardMetaMap.cardIds[iCard];
				//alert(cardId);
				/*
					logic code
					0 for cover
					1 for default show
					2 for answer mode
				*/
				
				if($scope.userMap[0].topTextSetting == 0) //0
				{
					if(iCard != 1)
					{
						$scope.cardMetaMap.ids[iCard].hideTopText = true;
						$scope.cardMetaMap.ids[iCard].hideTopCover = false;
					}
					else
					{
						$scope.cardMetaMap.ids[1].hideTopText = true;
						$scope.cardMetaMap.ids[1].hideTopCover = false;
						$scope.cardMetaMap.ids[1].topText = $scope.cardMap[cardId].topText; 
					}
				}
				else if ($scope.userMap[0].topTextSetting == 2) //2
				{
					if(iCard != 1)
					{
						$scope.cardMetaMap.ids[iCard].hideTopText = true;
						$scope.cardMetaMap.ids[iCard].hideTopCover = false;
					}
					else
					{
						$scope.cardMetaMap.ids[1].hideTopText = true;
						$scope.cardMetaMap.ids[1].hideTopAnswer = false;
						$scope.cardMetaMap.ids[1].hideTopCover = false;
						$scope.cardMetaMap.ids[1].topText = $scope.cardMap[cardId].topText; 
					}
				}
				else
				{
					 $scope.cardMetaMap.ids[iCard].topText = $scope.cardMap[cardId].topText; 
					 
				}
				
				
				
				if($scope.userMap[0].topAudioTypeSetting == 0)
				{
					//console.log("PLACE AUDIO");
					$scope.cardMetaMap.ids[iCard].topAudioMP3 = $scope.cardMap[cardId].topAudioPathMP3;
					$scope.cardMetaMap.ids[iCard].topAudioOGG = $scope.cardMap[cardId].topAudioPathOGG;
				}
				
				
				if($scope.userMap[0].imageSetting == 1)
				{
					if($scope.cardMap[cardId].imagePath != null || $scope.cardMap[cardId].imagePath > 1)
					{
						$scope.cardMetaMap.ids[iCard].imageSrc = $scope.cardMap[cardId].imagePath;
					}
					else
					{
						$scope.cardMetaMap.ids[iCard].imageSrc = '../images/cards/no-image.png';	
					}
				}
				else
				{
					if($scope.cardMap[cardId].imagePath != null || $scope.cardMap[cardId].imagePath > 1)
					{
						$scope.cardMetaMap.ids[iCard].imageSrc = $scope.cardMap[cardId].imagePath;
					}
					else
					{
						$scope.cardMetaMap.ids[iCard].imageSrc = '../images/cards/no-image.png';	
					}
				}
				
				
				
				/*
					logic code
					0 for cover
					1 for default show
					2 for answer mode
				*/
				if($scope.userMap[0].bottomTextSetting == 0)
				{
					
				}
				else if ($scope.userMap[0].bottomTextSetting == 2)
				{
					
				}
				else
				{
					 $scope.cardMetaMap.ids[iCard].bottomText = $scope.cardMap[cardId].bottomText; 
				}
				
				if($scope.userMap[0].bottomAudioSetting == 1)
				{
					$scope.cardMetaMap.ids[iCard].bottomAudioMP3 = $scope.cardMap[cardId].bottomAudioPathMP3;
					$scope.cardMetaMap.ids[iCard].bottomAudioOGG = $scope.cardMap[cardId].bottomAudioPathOGG;
				}
				
				
				
			}
			$scope.currentCard = $scope.cardSelected + 1;
		};
		
		
		$scope.GoBackOrForward = function(directionRightOrLeft)
		{
			switch (directionRightOrLeft)
			{
				case 'back': //if data has string back then this trigger
				{
					
					// if going backwards then we must
					if($scope.cardSelected == 0)
					{
						$scope.cardSelected = $scope.cardMap.length - 1;	
					}
					else
					{
						$scope.cardSelected--;	
					}
					directionRightOrLeft = "-";
					break;
				}
				case 'forward':
				{
					// if going backwards then we must
					if($scope.cardSelected == $scope.cardMap.length - 1)
					{
						$scope.cardSelected = 0;	
					}
					else
					{
						$scope.cardSelected++;	
					}
					directionRightOrLeft = "+";
					break;	
				}
			}
			$scope.AnimateCardsSlide(directionRightOrLeft);
		};
		
		$scope.AnimateCardsSlide = function(plusOrMinus)
		{
			var windowWidthThird = $(window).width() * 0.322;
			var startAnimationPosition = plusOrMinus + windowWidthThird;
			$scope.SetView();
			$(".items").css("left", startAnimationPosition);
			$('.items').animate
			({
				left: "0px"
			},250); //this right hard wire in replace with userJson.animationSpeed
			
		};
		
		$scope.GetJsonVoice = function(i)
		{
			
			var moduleIdCombo = [];
			//console.log("GETJSON");
			moduleIdCombo = activityMode.data.module.split("-");	
			//console.log(moduleIdCombo);
			
			//console.log(moduleIdCombo.length);
			switch(moduleIdCombo[i])
			{
				case 'Afrikaans':
				{
					return('nl');
					break;
				}
				default:
				{
					return('en/en');
					break;
				}
			}
		};
		
		$scope.PlayTopAudio = function()
		{
			console.log($scope.card2.topText);
			if($scope.userMap[0].topAudioTypeSetting == 0)
			{
				meSpeak.loadVoice("../mespeak/voices/" + $scope.GetJsonVoice(0) + ".json",isLoad());
				function isLoad()
				{
					meSpeakService.Talk([{'text': $scope.card2.topText}]);
				}
			}
			else
			{
				
				//console.log($scope.card2.topAudioMP3);
				$scope.audio = ngAudio.load($scope.card2.topAudioMP3);
				$scope.audio.play();
			}
			meSpeakService.ReloadVoice();
		}
		
		$scope.PlayBottomAudio = function()
		{
			if($scope.userMap[0].bottomAudioTypeSetting == 0)
			{
				meSpeak.stop();
				meSpeak.loadVoice("../mespeak/voices/" + $scope.GetJsonVoice(1) + ".json",isLoad());
				function isLoad()
				{
					meSpeakService.Talk([{'text': $scope.card2.bottomText}]);
				}
			}
			else
			{
				//console.log("other mode");
				//console.log($scope.card2.bottomAudioMP3);
				$scope.audio = ngAudio.load($scope.card2.bottomAudioMP3);
				$scope.audio.play();
			}
			meSpeakService.ReloadVoice();
		}
		
		//this allow the user to remove 1 card from the deck
		$scope.DeleteCard = function()
		{
			//is the cards index highter then 2
			if($scope.cardMap.length != 2)
			{
				//this show card disaper from list
				$("#card2").fadeOut(300,function(){});
				
				// while the card hiding remove card from the array 
					$scope.cardMap.splice($scope.cardSelected,1);
				
				// this reappear the card
			    $("#card2").fadeIn(10,function(){});	
			}
			
			// if card index length equal to length
			if($scope.cardMap.length == $scope.cardSelected)
			{
				//update the current card number
				$scope.cardSelected--;

			}
			$scope.audio = ngAudio.load("../sounds/cards/Woosh-Mark_DiAngelo.mp3");
			$scope.audio.play();
			//update the Max number
			$("#maxCards").html($scope.cardMap.length);
			//reset the cards
			$scope.SetView();
		}
		
		//if user click top answer mode this check the answer given by user
		$scope.TopCheckAnswer = function()
		{ 
			var userAnswer = $scope.topUserAnswer;
			if($scope.card2.topText == userAnswer || userAnswer.toLowerCase() == $scope.card2.topText.toLowerCase())
			{
				$scope.card2.hideTopAnswer = true;
				$scope.card2.hideTopCorrect = false;
				$scope.card2.hideTopCover = true;
			}
			else
			{
				$scope.card2.hideTopAnswer = true;
				$scope.card2.hideTopCover = true;
				$scope.card2.hideTopIncorrect = false;
			}
		}
		//if user click top answer mode this check the answer given by user
		$scope.BottomCheckAnswer = function()
		{ 
			var userAnswer = $scope.bottomUserAnswer;
			if($scope.card2.bottomText == userAnswer || userAnswer.toLowerCase() == $scope.card2.bottomText.toLowerCase())
			{
				$scope.card2.hideBottomAnswer = true;
				$scope.card2.hideBottomCorrect = false;
				$scope.card2.hideBottomCover = true;
			}
			else
			{
				$scope.card2.hideBottomAnswer = true;
				$scope.card2.hideBottomCover = true;
				$scope.card2.hideBottomIncorrect = false;
			}
		}
		
		$interval(function()
		{
			if(activityModeCall.startCards && $scope.hasBeenCalled != true)
			{
				$scope.CardsStart();
				$scope.SetView();
				
			}
		},1000);
		
		/////////////////////////////////////////////////////
				//Keybinding
		/////////////////////////////////////////////////////
		$interval(function() //were going keep asking if the controller is true or not
		{
			if($scope.enable.activityCardsControllerKeyBinding) //this verable is in the activityController this controller inheractes the partent controller aka activityController.
			{
				//console.log("cardsController");
				hotkeys.bindTo($scope)
				.add
				(
					{
						combo: 'right',
						description: 'Next Card',
						callback: function()
						{
							event.preventDefault();
							$scope.GoBackOrForward('forward');
							$scope.card2.hideTopCorrect = true;
							$scope.card2.hideTopIncorrect = true;
							$scope.topUserAnswer = '';
							$scope.card2.hideBottomCorrect = true;
							$scope.card2.hideBottomIncorrect = true;
							$scope.bottomUserAnswer = '';
						}
					}
				);
			 
			   hotkeys.bindTo($scope)
				.add
				(
					{
						combo: 'left',
						description: 'prev. Card',
						callback: function()
						{
							event.preventDefault();
							$scope.GoBackOrForward('back');
							$scope.card2.hideTopCorrect = true;
							$scope.card2.hideTopIncorrect = true;
							$scope.topUserAnswer = '';
							$scope.card2.hideBottomCorrect = true;
							$scope.card2.hideBottomIncorrect = true;
							$scope.bottomUserAnswer = '';
						}
					}
				);
				
				hotkeys.bindTo($scope)
				.add
				(
					{
						combo: 'up',
						description: 'play top audio',
						callback: function()
						{
							event.preventDefault();
							$scope.PlayTopAudio();
						}
					}
				);
				
				hotkeys.bindTo($scope)
				.add
				(
					{
						combo: 'down',
						description: 'play bottom audio',
						callback: function()
						{
							event.preventDefault();
							$scope.PlayBottomAudio();
						}
					}
				);
				
				hotkeys.bindTo($scope)
				.add
				(
					{
						combo: 'del',
						description: 'delete a card',
						callback: function()
						{
							//console.log("YOU PRESS IT");
							event.preventDefault();
							$scope.DeleteCard();
							$scope.card2.hideTopCorrect = true;
							$scope.card2.hideTopIncorrect = true;
							$scope.topUserAnswer = '';
							$scope.card2.hideBottomCorrect = true;
							$scope.card2.hideBottomIncorrect = true;
							$scope.bottomUserAnswer = '';
						}
					}
				);
			}
		},1000);
	});
	
</script>