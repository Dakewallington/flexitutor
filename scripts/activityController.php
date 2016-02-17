<script>

flexApp.controller('activityController', function($scope, activityMode, meSpeakService, $cookies, ngProgressFactory)
{
	$scope.progressbar = ngProgressFactory.createInstance();
	$scope.enable =
	{
		activityCardsControllerKeyBinding : false,	
		activitySelectControllerKeyBinding : true
		
	};
	
	
	$scope.enableToggleController = function()
	{
		$scope.enable.activityCardsControllerKeyBinding = !$scope.enable.activityCardsControllerKeyBinding;
		$scope.enable.activitySelectControllerKeyBinding = !$scope.enable.activitySelectControllerKeyBinding;
		console.log("activityCards: " + $scope.enable.activityCardsControllerKeyBinding);
		console.log("activitySelect: " + $scope.enable.activitySelectControllerKeyBinding);
	}
});
	
</script>