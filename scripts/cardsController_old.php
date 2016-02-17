<script>

	/**********************************************
	For Actvity Cards for Activity Lession
	Author: Sean O'Brien
	Ver. 1.0.5
	Copyright 2008 openlanguages.net
	**********************************************/
	
	flexApp.controller('cards',['$scope',function($scope)
	{
		$scope.cardMap = 
		<?php
			$q = "SELECT * FROM activityCards WHERE subjectID='" . $_GET['chapter'] . "' AND exerciseSubjectID='" . $_GET['exerciseSubject'] . "' AND exerciseTopicID='" . $_GET['exerciseTopic'] ."'";
			//print($q);
			$run = mysqli_query($dbc,$q);
			
			$num = mysqli_num_rows($run);
			
			// this create the Muti array holder
			$cardArray = array();
			
			$i = 0;
			
			if($num > 0)
			{
				while($data = mysqli_fetch_array($run)) //this while run for each row the querry came back with.
				{
					//check the Image is non file on the server
					if(!is_file($data['imagePath']))
					{
						$data['imagePath'] = '../images/cards/no-image.png';
					}
					// checking if not audio path or not complete sound pack for the top audio
					if(!is_file($data['topAudioPathMP3']) && !is_file($data['topAudioPathOGG']))
					{
						$data['topAudioPathMP3'] = NULL;
						$data['topAudioPathOGG'] = NULL;
					}
					// checking if not audio path or not complete sound pack for the top audio
					if(!is_file($data['bottomAudioPathMP3']) && !is_file($data['bottomAudioPathOGG']))
					{
						$data['bottomAudioPathMP3'] = NULL;
						$data['bottomAudioPathOGG'] = NULL;
					}
					
					
					//we call the muti array and set the i as placement and create a small array hold the data
					$cardArray[$i] = array("topText" => $data['topText'],"topAudioPathMP3" => $data['topAudioPathMP3'],"topAudioPathOGG" => $data['topAudioPathOGG'],
					"imagePath" => $data['imagePath'],"bottomText" => $data['bottomText'],"bottomAudioPathMP3" => $data['bottomAudioPathMP3'],
					"bottomAudioPathOGG" => $data['bottomAudioPathOGG']);
					
					 
					//this increass the muti array placement  i to 1..2...so on
					$i++;	
				}
				//this endcode also clean up the json code a bit by remove \/
				$jsonCards = str_replace('\/','/',json_encode($cardArray));
				
				//echo $json;
				$jsonCards = str_replace('[{','{"cards":[{',$jsonCards) . "}";
				
				echo $jsonCards;	
			}
			else
			{
				echo 'null';	
			}
			
			
		?>;
		$scope.userMap = 
		<?php
			$q = "SELECT topTextSetting, topAudioSetting, imageSetting, bottomTextSetting, bottomAudioSetting,xSpeedSetting, ySpeedSetting, topAudioTypeSetting, 
			bottomAudioTypeSetting, meSpeakVoiceSpeed, meSpeakVoiceVariant, meSpeakAmplitude, meSpeakPitch 
			FROM accounts WHERE accountID='" . '00001' /* remove this before going live $_SESSION['accountID']*/ . "'";
			//echo $q;
			$run = mysqli_query($dbc,$q);
			
			// this create the Muti array holder
			$userArray = array();
			$data = mysqli_fetch_array($run);
			$userArray[0] = array("topTextSetting" => $data['topTextSetting'],"topAudioSetting" => $data['topAudioSetting'], "imageSetting" => $data['imageSetting'],
			 "bottomTextSetting" => $data['bottomTextSetting'], "bottomAudioSetting" => $data['bottomAudioSetting'], "xSpeedSetting" => $data['xSpeedSetting'], 
			 "ySpeedSetting" => $data['ySpeedSetting'], "topAudioTypeSetting" => $data['topAudioTypeSetting'], "bottomAudioTypeSetting" => $data['bottomAudioTypeSetting'],
			 "meSpeakVoiceSpeed" => $data['meSpeakVoiceSpeed'], "meSpeakVoiceVariant" => $data['meSpeakVoiceVariant'], "meSpeakAmplitude" => $data['meSpeakAmplitude'],
			 "meSpeakPitch" => $data['meSpeakPitch']);
			 
			echo json_encode($userArray[0]);
                                
		?>;
		
		 
		 
		 //card that is selected from the stack
		 $scope.cardSelected = 0;
		 
		 //set the X number cards inside of the stack
		 $("#maxCards").html($scope.cardMap.cards.length);
		 
		 //setting up the blank template of the layout.
		 $scope.cardMetaMap =		 
		  {
			  length : 3,
			  cardIds : [$scope.cardSelected - 1, $scope.cardSelected, $scope.cardSelected + 1],
			  ids: ["card1", "card2", "card3"]
		  };
		  
		  // is auto play eneble
		  $scope.toggleIsAutoPlay =false;
			
		  $scope.speedToggleXAxis = $scope.userMap.top2BottomSpeed;
		  $scope.speedToggleYAxis = $scope.userMap.top2BottomSpeed;
		  $scope.delayBetweenReadingXAxis = 3000;
		  $scope.delayBetweenReadingYAxis = 3000; 
		 
		 //function for the cards
		 
		 //this set the view of the cards inside of our 3 card boxs
		 $scope.SetView = function()
		 {
			 $scope.GetCurrentSelected();
			 
			 //setting the cards
			 for(var iCard = 0; iCard < $scope.cardMetaMap.length; iCard++)
			 {
				var cardId = $scope.cardMetaMap.cardIds[iCard];
				
				/*
					logic code
					0 for cover
					1 for default show
					2 for answer
				*/ 
				if($scope.userMap.topTexSetting == 0)
				{
					if(iCard == 1)
					{
						$('#' + cardMetaMap.ids[iCard] + 'TopText').html
						(
							'<a id="'+ $scope.cardMetaMap.ids[iCard] + 'TopIcon' +'" onclick="CardDisplay().ToggleTopText()"><i id="BottomTextIcon" class="fa fa-question-circle fa-2x"></i></a>' + 
							'<a id="'+ $scope.cardMetaMap.ids[iCard] + 'TopHiddenText' +'" class="InfoHidden" onclick="CardDisplay().ToggleTopText()">' + $scope.cardMap.cards[cardId].topText + '</a>'
						);
					}
					else
					{
						$('#' + $scope.cardMetaMap.ids[iCard] + 'TopText').html
						(
							'<span id="'+ $scope.cardMetaMap.ids[iCard] + 'TopIcon' +'"><i id="BottomTextIcon" class="fa fa-question-circle fa-2x"></i></span>'
						);
					}
				}
				else if ($scope.userMap.topTexSetting == 2)
				{
					if(iCard == 1)
					{
						$('#' + cardMetaMap.ids[iCard] + 'TopText').html
						(
							'<a id="'+ $scope.cardMetaMap.ids[iCard] + 'TopIcon' +'" ng-click="ToggleTopText()"><i id="BottomTextIcon" class="fa fa-question-circle fa-2x"></i></a>' + 
							'<a id="'+ $scope.cardMetaMap.ids[iCard] + 'TopHiddenText' +'" class="InfoHidden" ng-click="ToggleTopText()">' + $scope.cardMap.cards[cardId].topText + '</a>' + 
							'<div id="topAnswerMode" class="form-group "><input class="form-control" type="text" name="topAnswerBox" id="topAnswerBox"><md-button ng-click"TopCheckAnswer()" class="btn btn-default" id="topCheckAnswer">Answer</button></div>'
						);
						
					}
					else
					{
						$('#' + $scope.cardMetaMap.ids[iCard] + 'TopText').html
						(
							'<span id="'+ $scope.cardMetaMap.ids[iCard] + 'TopIcon' +'"><i id="BottomTextIcon" class="fa fa-question-circle fa-2x"></i></span>'
						);
					}	
				}
				else
				{
					//if this true if on default for text then its place text on the top slot
					document.getElementById($scope.cardMetaMap.ids[iCard] +"TopText").innerHTML = $scope.cardMap.cards[cardId].topText;
				}
				//End top text 
				
				// Start of Top audio 
				/*********************
					0 for show audio
					1 for toggle hide audio
					*	0 is for Record audio
					*	1 is for meSpeak
				**********************/
				
				if($scope.userMap.topAudioSetting == 1)
				{
					
					if($scope.userMap.topAudioTypeSetting == 0) //0
					{
						if(iCard == 1) // if iCard is on card #2 we want trigger this
						{
							//we need check make sure there audio even if user want recode audio
							if($scope.cardMap.cards[cardId].topAudioPathMP3 != null && $scope.cardMap.cards[cardId].topAudioPathOGG != null)
							{
								$("#card2TopAudio").html
								(
									'<audio controls id="topAudio">' +
									'<source id ="bottomAudioPathMP3" src="' + $scope.cardMap.cards[cardId].topAudioPathMP3 + '" type="audio/mpeg">' +
									'<source id ="bottomAudioPathOGG" src="' + $scope.cardMap.cards[cardId].topAudioPathOGG + '" type="audio/ogg">'+							
									'</audio>'
								);
							}
						}
						else
						{
							$("#" + $scope.cardMetaMap.ids[iCard] + "TopAudio").html
							(
								'<button class=" md-button" aria-disabled="true" disabled="disabled"><i class="fa fa-3x fa-play-circle ng-scope"></i></button>'
							);
						}
					}
					else
					{
						if(iCard != 1) // if iCard is on card #2 we want trigger this
						{
							$("#" + $scope.cardMetaMap.ids[iCard] + "TopAudio").html
							(
								'<button class=" md-button" aria-disabled="true" disabled="disabled"><i class="fa fa-3x fa-play-circle ng-scope"></i></button>'
							);
							
						}
						
					}
				}
				else
				{
					$("#" + $scope.cardMetaMap.ids[iCard] + "TopAudio").html
					(
						'<button class=" md-button" aria-disabled="true" disabled="disabled"><i class="fa fa-3x fa-play-circle ng-scope"></i></button>'
					);
				}
				// end of Top audio 
				
				//start of the image
					if($scope.userMap.imageSetting == 1)
					{
						if($scope.cardMap.cards[cardId].imagePath != null || $scope.cardMap.cards[cardId].imagePath > 1)
						{
							//alert("#" + $scope.cardMetaMap.ids[iCard]  + 'ImageHolder');
							 $("#" + $scope.cardMetaMap.ids[iCard]  + 'ImageHolder').html
							 (
								 "<img src='" + $scope.cardMap.cards[cardId].imagePath + "'>"
							 );
						}
						else
						{
							$("#" + $scope.cardMetaMap.ids[iCard]  + 'ImageHolder').html
							 (
								 "<img src='../images/cards/no-image.png'>"
							 );
						}
					}
					else
					{
						//we still need check for non existing images files json data
						if($scope.cardMap.cards[cardId].imagePath != null || $scope.cardMap.cards[cardId].imagePath > 1)
						{
							$("#" + $scope.cardMetaMap.ids[iCard]  + 'ImageHolder').html
							 (
							 	 "<a id="+ $scope.cardMetaMap.ids[iCard] + "ImageIcon" + "><img src='../images/cards/hidden.png'></a>'"+
 								 "<img src='" + $scope.cardMap.cards[cardId].imagePath + "'class='hidden'>"
							 );
						}
						else
						{
							 $("#" + $scope.cardMetaMap.ids[iCard]  + 'ImageHolder').html
							 (
								 "<img src='../images/cards/no-image.png'>"
							 );	
						}
					}
				
				//end of the image
				
				//start of the bottom text
				
				/*
					logic code
					0 for cover
					1 for default show
					2 for answer
				*/ 
				if($scope.userMap.bottomTextSetting == 0)
				{
					if(iCard == 1)
					{
						$('#' + cardMetaMap.ids[iCard] + 'BottomText').html
						(
							'<a id="'+ $scope.cardMetaMap.ids[iCard] + 'BottomIcon' +'" onclick="CardDisplay().ToggleTopText()"><i id="BottomTextIcon" class="fa fa-question-circle fa-2x"></i></a>' + 
							'<a id="'+ $scope.cardMetaMap.ids[iCard] + 'BottomHiddenText' +'" class="InfoHidden" onclick="CardDisplay().ToggleTopText()">' + $scope.cardMap.cards[cardId].topText + '</a>'
						);
					}
					else
					{
						$('#' + $scope.cardMetaMap.ids[iCard] + 'BottomText').html
						(
							'<span id="'+ $scope.cardMetaMap.ids[iCard] + 'BottomIcon' +'"><i id="BottomTextIcon" class="fa fa-question-circle fa-2x"></i></span>'
						);
					}
				}
				else if ($scope.userMap.bottomTextSetting == 2)
				{
					if(iCard == 1)
					{
						$('#' + $scope.cardMetaMap.ids[iCard] + 'BottomText').html
						(
							'<a id="'+ $scope.cardMetaMap.ids[iCard] + 'BottomIcon' +'" ng-click="ToggleTopText()"><i id="BottomTextIcon" class="fa fa-question-circle fa-2x"></i></a>' + 
							'<a id="'+ $scope.cardMetaMap.ids[iCard] + 'BottomHiddenText' +'" class="hidden" ng-click="ToggleBottomText()">' + $scope.cardMap.cards[cardId].bottomText + '</a>' + 
							'<div id="bottomAnswerMode" class="form-group "><input class="form-control" type="text" name="bottomAnswerBox" id="bottomAnswerBox"><md-button ng-click"BottomCheckAnswer()" class="btn btn-default" id="bottomCheckAnswer">Answer</button></div>'
						);
						
					}
					else
					{
						$('#' + $scope.cardMetaMap.ids[iCard] + 'BottomText').html
						(
							'<span id="'+ $scope.cardMetaMap.ids[iCard] + 'BottomIcon' +'"><i id="BottomTextIcon" class="fa fa-question-circle fa-2x"></i></span>'
						);
					}	
				}
				else
				{
					//if this true if on default for text then its place text on the top slot
					document.getElementById($scope.cardMetaMap.ids[iCard] +"BottomText").innerHTML = $scope.cardMap.cards[cardId].bottomText;
				}	
				
				// end of the bottom text
				
				//start of the bottom audio
				
				/*********************
					0 for show audio
					1 for toggle hide audio
					*	0 is for Record audio
					*	1 is for meSpeak
				**********************/
				
				if($scope.userMap.topAudioSetting == 1)
				{
					
					if($scope.userMap.bottomAudioTypeSetting == 0) //0
					{
						if(iCard == 1) // if iCard is on card #2 we want trigger this
						{
							//we need check make sure there audio even if user want recode audio
							if($scope.cardMap.cards[cardId].bottomAudioPathMP3 != null && $scope.cardMap.cards[cardId].bottomAudioPathOGG != null)
							{
								'<audio controls id="bottomAudio">' +
								'<source id ="bottomAudioPathMP3" src="' + cardMap.cards[cardId].bottomAudioPathMP3 + '" type="audio/mpeg">' +
								'<source id ="bottomAudioPathOGG" src="' + cardMap.cards[cardId].bottomAudioPathOGG + '" type="audio/ogg">'+							
								'</audio>'
							}
						}
						else
						{
							$("#" + $scope.cardMetaMap.ids[iCard] + "BottomAudio").html
							(
								'<button class=" md-button" aria-disabled="true" disabled="disabled"><i class="fa fa-3x fa-play-circle ng-scope"></i></button>'
							);
						}
					}
					else
					{
						if(iCard != 1) // if iCard is on card #2 we want trigger this
						{
							$("#" + $scope.cardMetaMap.ids[iCard] + "BottomAudio").html
							(
								'<button class=" md-button" aria-disabled="true" disabled="disabled"><i class="fa fa-3x fa-play-circle ng-scope"></i></button>'
							);
						}
						
					}
				}
				else
				{
					$("#" + $scope.cardMetaMap.ids[iCard] + "BottomAudio").html
					(
						'<button class=" md-button" aria-disabled="true" disabled="disabled"><i class="fa fa-3x fa-play-circle ng-scope"></i></button>'
					);
				}
				
				//end of the bottom audio
				
			 }
			 $("#currentCard").html($scope.cardSelected + 1);
		 }; //end of SetView
		 
		 $scope.GetCurrentSelected = function()
		 {
			// this move along the cards 
			$scope.cardMetaMap.cardIds[0] = $scope.cardSelected - 1;
			$scope.cardMetaMap.cardIds[1] = $scope.cardSelected;
			$scope.cardMetaMap.cardIds[2] = $scope.cardSelected + 1;
			
			//if $scope.cardSelection react to end we want to show X bottom card or forward card.
			if ($scope.cardSelected == 0) 
			{
				$scope.cardMetaMap.cardIds[0] = $scope.cardMap.cards.length - 1;
			} 
			else if ($scope.cardSelected == $scope.cardMap.cards.length - 1) 
			{
				$scope.cardMetaMap.cardIds[2] = 0;
			}
		 };
		 
		 $scope.SetHooks = function()
		 {
			//set up the keyboard for PC keyboard and mouse functions then defalut settings.
			$('#card1').click(function () { $scope.GoBackOrForward('back') });
			$('#card3').click(function () { $scope.GoBackOrForward('forward') }); 
			
			jwerty.key('arrow-right', function(e)
			{
				e.preventDefault();
				$scope.GoBackOrForward('forward');
				
			});
			
			jwerty.key('arrow-left', function(e)
			{
				e.preventDefault();
								$scope.GoBackOrForward('back');

			});
			jwerty.key('arrow-up', function(e)
			{
				e.preventDefault();
				meSpeak.stop();
				$scope.PlayTopAudio();
				
			});
			jwerty.key('arrow-down', function(e)
			{
				e.preventDefault();
				$scope.PlayBottomAudio();
				
			});
			jwerty.key('enter', function(e)
			{
				e.preventDefault();
				$scope.toggleIsAutoPlay = !$scope.toggleIsAutoPlay;
				$scope.AudioAutoPlay();
				
			});
			jwerty.key('delete',function(e)
			{
				e.preventDefault();
				$scope.DeleteCard();
			});
			jwerty.key('ctrl++', function(e)
			{
				e.preventDefault();
				$scope.GoDecelerateOrAcceleratedXAxis('+');
			});
			jwerty.key('ctrl+-', function(e)
			{
				e.preventDefault();
				$scope.GoDecelerateOrAcceleratedXAxis('-');
			});
			
			jwerty.key('+', function(e)
			{
				e.preventDefault();
				$scope.GoDecelerateOrAcceleratedYAxis('+');
			});
			jwerty.key('-', function(e)
			{
				e.preventDefault();
				$scope.GoDecelerateOrAcceleratedYAxis('-');
			});/*
			jwerty.key('1', function(e)
			{
				e.preventDefault();
				MeSpeakCardDisplay().PlayMeSpeakNumbers('left');
			});
			jwerty.key('2', function(e)
			{
				e.preventDefault();
				MeSpeakCardDisplay().PlayMeSpeakNumbers('right');
			});*/
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
						$scope.cardSelected = $scope.cardMap.cards.length - 1;	
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
					if($scope.cardSelected == $scope.cardMap.cards.length - 1)
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
			var startAnimationPosition = plusOrMinus + windowWidthThird + 'px';
			$scope.SetView();
			$(".items").css("left", startAnimationPosition);
			$('.items').animate
			({
				left: "0px"
			},250); //this right hard wire in replace with userJson.animationSpeed
		}
		
		$scope.PlayTopAudio = function()
		{
			if($scope.userMap.topAudioTypeSetting != 0)
			{
				meSpeak.stop();
				meSpeak.loadVoice("../mespeak/voices/" + $scope.GetJsonVoice(0) + ".json",isLoad);
				function isLoad()
				{
					meSpeak.speak($("#card2TopText").text());
				}
			}
			else
			{
				document.getElementById("topAudio").play();	
			}
		}
		$scope.PlayBottomAudio = function()
		{
			if($scope.userMap.bottomAudioTypeSetting != 0)
			{
				meSpeak.stop();
				meSpeak.loadVoice("../mespeak/voices/" + $scope.GetJsonVoice(1) + ".json",isLoad);
				function isLoad()
				{
					meSpeak.speak($("#card2BottomText").text());
				}
			}
			else
			{
				document.getElementById("bottomAudio").play();	
			}
		}
		
		$scope.GetJsonVoice = function(i)
		{
			var activityIdCombo = 
			[
			<?php
			
				$combo = $_GET['subjectID'];
				$combo = explode("-",$combo);
				echo "'" .$combo[0] . "','" . $combo[1] . "'";
			?>
			];
			switch(activityIdCombo[i])
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
				
		}
		
		//this allow the user to remove 1 card from the deck
		$scope.DeleteCard = function()
		{
			//is the cards index highter then 2
			if($scope.cardMap.cards.length != 2)
			{
				//this show card disaper from list
				$("#card2").fadeOut(300,function(){});
				
				// while the card hiding remove card from the array 
					$scope.cardMap.cards.splice($scope.cardSelected,1);
				
				// this reappear the card
			    $("#card2").fadeIn(10,function(){});	
			}
			
			// if card index length equal to length
			if($scope.cardMap.cards.length == $scope.cardSelected)
			{
				//update the current card number
				$scope.cardSelected--;

			}
			
			//update the Max number
			$("#maxCards").html($scope.cardMap.cards.length);
			//reset the cards
			$scope.SetView();
		}
		
		$scope.GoDecelerateOrAcceleratedXAxis = function(decelerateOrAccelerated)
		{
			//is the value "+" or a "-"
			switch(decelerateOrAccelerated)
			{
				case("+"):
				{
					if($scope.speedToggleXAxis == 6)
					{
						//if speed at 6 the speed set to MAX speed
						$scope.speedToggleXAxis = 6;	
					}
					else
					{
						$scope.speedToggleXAxis++;	
					}
					break;	
				}
				case("-"):
				{
					if($scope.speedToggleXAxis == 1)
					{
						//if speed at 1 the speed set to slowest speed
						$scope.speedToggleXAxis = 1;	
					}
					else
					{
						$scope.speedToggleXAxis--;	
					}
					break;	
				}
			}
			$scope.UpdateDelaySpeedXAxis();
		}
		
		$scope.GoDecelerateOrAcceleratedYAxis = function(decelerateOrAccelerated)
		{
			//is the value "+" or a "-"
			switch(decelerateOrAccelerated)
			{
				case("+"):
				{
					if($scope.speedToggleYAxis == 6)
					{
						//if speed at 6 the speed set to MAX speed
						$scope.speedToggleYAxis = 6;	
					}
					else
					{
						$scope.speedToggleYAxis++;	
					}
					break;	
				}
				case("-"):
				{
					if($scope.speedToggleYAxis == 1)
					{
						//if speed at 1 the speed set to slowest speed
						$scope.speedToggleYAxis = 1;	
					}
					else
					{
						$scope.speedToggleYAxis--;	
					}
					break;	
				}
			}
			$scope.UpdateDelaySpeedYAxis();
		}
		 
		$scope.UpdateDelaySpeedXAxis = function()
		{
			switch(	$scope.speedToggleXAxis) //what number is speedToggle set as?
			{
				case 1:
					$scope.delayBetweenReadingXAxis = 4000; //if they set as 1 in speedToggleYAxis which slowest speed of 4 seconds delay
					break;
				case 2:
					$scope.delayBetweenReadingXAxis = 3000; //if they set as 2 in speedToggleYAxis which default speed of 3 seconds delay
					break;
				case 3:
					$scope.delayBetweenReadingXAxis = 2000; //if they set as 3 in speedToggleYAxis which is 2 seconds delay
					break;
				case 4:
					$scope.delayBetweenReadingXAxis = 1000; //if they set as 4 in speedToggleYAxis which is 1 seconds delay
					break;
				case 5:
					$scope.delayBetweenReadingXAxis = 500; //if they set as 5 in speedToggleYAxis which is 1/2 seconds delay
					break;
				case 6:
					$scope.delayBetweenReadingXAxis = 200; //if they set as 6 in speedToggleYAxis which is highest speed of 200 milliseconds delay
			}
		}
		
		$scope.UpdateDelaySpeedYAxis = function()
		{
			switch(	$scope.speedToggleYAxis) //what number is speedToggle set as?
			{
				case 1:
					$scope.delayBetweenReadingYAxis = 4000; //if they set as 1 in speedToggleYAxis which slowest speed of 4 seconds delay
					break;
				case 2:
					$scope.delayBetweenReadingYAxis = 3000; //if they set as 2 in speedToggleYAxis which default speed of 3 seconds delay
					break;
				case 3:
					$scope.delayBetweenReadingYAxis = 2000; //if they set as 3 in speedToggleYAxis which is 2 seconds delay
					break;
				case 4:
					$scope.delayBetweenReadingYAxis = 1000; //if they set as 4 in speedToggleYAxis which is 1 seconds delay
					break;
				case 5:
					$scope.delayBetweenReadingYAxis = 500; //if they set as 5 in speedToggleYAxis which is 1/2 seconds delay
					break;
				case 6:
					$scope.delayBetweenReadingYAxis = 200; //if they set as 6 in speedToggleYAxis which is highest speed of 200 milliseconds delay
			}
		}
		
		$scope.AudioAutoPlay = function()
		{
			
			//checking if $scope.toggleIsAudioPlay is true/ still true.
			if($scope.toggleIsAutoPlay)
			{
				//lets have loop play top card.
				$scope.PlayTopAudio();
				//this wait for set sec the user has default too or change during playing of autoPlay
				setTimeout(function()
				{
					//play the bottom audio on the card
					$scope.PlayBottomAudio();
					setTimeout(function()
					{
						//check the $scope.togleIsAutoPlay is true still.
						if($scope.toggleIsAutoPlay)
						{
							//switch the next card
							$scope.GoBackOrForward('forward');
							
							//delay on it read the top audio on card
							setTimeout(function()
							{
								//again check if $scope.toggleisAudoPlay still true
								if($scope.toggleIsAutoPlay)
								{
									//were call the same function until the toggleIsAudoPlay is false
									$scope.AudioAutoPlay();	
								}
							},$scope.delayBetweenReadingXAxis);	
						}
					},$scope.delayBetweenReadingYAxis);
					
				},$scope.delayBetweenReadingYAxis);
			}
		}
		 
		angular.element(document).ready(function()
		{
			$scope.SetView();
			$scope.SetHooks();	
		});
		 
		
		 
	}]);
	
</script>