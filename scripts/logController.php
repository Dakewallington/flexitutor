<script>
	flexApp.controller('logController',function($scope, $cookies, hotkeys, $http, meSpeakService)
	{
		 $scope.user = 
		 {
			email: '',
			password: '' 
		 };
		 
		 
		 $scope.error = false;
		 $scope.errorVisualMesssage ='';
		 $scope.errorAudioMessage = [];
		 
		 $scope.focusInputID = ''; //want default to none so none of the input feidds are light up.
		 
		 $scope.$on = function()
		 {	 
			if($cookies.get('audioModeCookie'))
			{
				var x = [{text: menuGreetings[7].text},menuGreatingPartTwo[0], menuGreatingPartTwo[1]];
				meSpeakService.Talk(x);
				
			}
			else
			{
				meSpeakService.Talk([visualLogIntro[0]]);
			}
		 };
		 
		 $scope.submit = function()
		 {
			  $scope.errorVisualMesssage ='';
		 	  $scope.errorAudioMessage = [];
			 
			 if($scope.user.email != '' && $scope.user.password != '')
			 {
				 $scope.error = false;
				 $scope.accountID = '';
				 	 
				 $http
				 ({
				  method: 'GET',
				  url: '../scripts/getUserKey.php?email=' + $scope.user.email + "&password=" + $scope.user.password
				 })
				 .then(function successCallback(response) 
				 {
					//console.log(response.data[0].accountID);
					if(response.data[0].accountID != 'ERROR')
					{
						$cookies.put('accountID', response.data[0].accountID);
						location.href=document.URL + "&sign=true";
					}
					else
					{
						$scope.error = true;
						$scope.errorAudioMessage.push(logErrorMessage[5]);
						$scope.errorVisualMesssage += logErrorMessage[5].text;
						if($cookies.get('audioModeCookie'))
						{
							// console.log($scope.errorAudioMessage);
							meSpeakService.Talk( $scope.errorAudioMessage);
						}
						
					}
					
				 }, function errorCallback(response) 
				 {
					$scope.error = true;
					//console.log(response.satus);
					$scope.errorAudioMessage.push(logErrorMessage[4]);
					$scope.errorVisualMesssage += logErrorMessage[4].text;
					if($cookies.get('audioModeCookie'))
					{
						// console.log($scope.errorAudioMessage);
						meSpeakService.Talk( $scope.errorAudioMessage);
					}
				 });	
				 
			 }
			 else
			 {
				 $scope.error = true; 
				 if($scope.user.email == 0)
				 {
					$scope.errorVisualMesssage += logErrorMessage[2].text  + " ";
					$scope.errorAudioMessage.push(logErrorMessage[2]);
					if($scope.user.password != '')
					{
						$scope.errorAudioMessage.push(logErrorMessage[0]);
						$scope.focusInputID = 'email';
					}
				 }
				 
				 if($scope.user.password == 0)
				 {
					$scope.errorVisualMesssage += logErrorMessage[3].text;
					$scope.errorAudioMessage.push(logErrorMessage[3]);
					
					if($scope.user.email != '')
					{
						$scope.errorAudioMessage.push(logErrorMessage[1]);
						$scope.focusInputID = 'password';
					}
				 }
				 $scope.errorAudioMessage.push(logErrorMessage[6]);
				 if($cookies.get('audioModeCookie'))
				 {
					 //console.log($scope.errorAudioMessage);
					meSpeakService.Talk( $scope.errorAudioMessage);
				 }
			 }
			 
			 
		 }
		 
		 /////////////////////////////////////////////////////
				//Keybinding
		/////////////////////////////////////////////////////
		hotkeys.bindTo($scope)
		.add
		(
			{
				
				combo: 'up',
				description: 'focus on Email Addesss',
				allowIn: ['INPUT', 'SELECT', 'TEXTAREA'],
				callback: function()
				{
					
					event.preventDefault();
					$scope.focusInputID = '';
					$scope.focusInputID = 'email';
					if($cookies.get('audioModeCookie'))
					{
						meSpeakService.Talk([{"text": logInput[0].text}]);
					}
				}
			}
		);
		/*some times anglular need some Jquery to help it along with some DOM
		* incase of a user miss click this remove true statement from focusInputID
		* so that user can reselect it again. without angular think did he lose focus and just locking up.
		*/
		$("#email").focusout(function(e) 
		{
            $scope.focusInputID = '';
        }); 
		$("#password").focusout(function(e) 
		{
            $scope.focusInputID = '';
        });
		
		hotkeys.bindTo($scope)
		.add
		(
			{
				
				combo: 'down',
				description: 'focus on password',
				allowIn: ['INPUT', 'SELECT', 'TEXTAREA'],
				callback: function()
				{
					
					event.preventDefault();
					$scope.focusInputID = '';
					$scope.focusInputID = 'password';
					if($cookies.get('audioModeCookie'))
					{
						meSpeakService.Talk([{"text": logInput[1].text}]);
					}
				}
			}
		);
		
		hotkeys.bindTo($scope)
		.add
		(
			{
				
				combo: 'enter',
				description: 'attempt to sign in',
				allowIn: ['INPUT', 'SELECT', 'TEXTAREA'],
				callback: function()
				{
					
					event.preventDefault();
					$scope.focusInputID = '';
					$scope.submit();
				}
			}
		);
		
		
	});

</script>