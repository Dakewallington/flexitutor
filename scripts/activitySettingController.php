<script>
	
	flexApp.controller('activitySettingController', function($scope, $http) 
	{
		$scope.user = 
		{
			topText : 0,
			topAudio : 0,
			image : 0,
			bottomText : 0,
			bottomAudio: 0 
		};
		
		$scope.card1 = 
		{
			'topText': 'Blue',
			'hideTopText': false,
			'hideTopCover': true,
			'hideTopAnswer': true,
			'hideTopCorrect': true,
			'hideTopIncorrect': true,
			'topAudioMP3':'../sounds/cards/basics/color/blue_af.mp3',
			'topAudioOGG':'../sounds/cards/basics/color/blue_af.ogg',
			'imageSrc': '../images/cards/basics/color/blue.jpg',
			'bottomText': 'Blou',
			'hideBottomText': false,
			'hideBottomCover': true,
			'hideBottomAnswer': true,
			'hideBottomCorrect': true,
			'hideBottomIncorrect': true,
			'bottomAudioMP3':null,
			'bottomAudioOGG':null	
		}
		
		$scope.$on = function()
		{
			$http
			(
				{
					method: 'POST',
					  url: '../scripts/getUserMapData.php?accountID=' + $cookies.get('accountID')
				}
			)
			.then(function successCallback(response)
			{
				$scope.user.topText = response.data[0].topTextSetting;
				$scope.user.topAudio = response.data[0].topAudioSetting;
				$scope.user.image = response.data[0].imageSetting;
				$scope.user.bottomText = response.data[0].bottomTextSetting;
				$scope.user.bottomAudio = response.data[0].bottomAudioSetting;
				
			},function errorCallback(respondse)
			{
				console.log('ERROR');
			});
		}
	});

</script>