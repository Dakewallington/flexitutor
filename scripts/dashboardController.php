<script>
	flexApp.controller('dashboardController', function($scope, $cookies, meSpeakService)
	{
		$scope.$on = function()
		 {	 
			if($cookies.get('audioModeCookie'))
			{
				var x = [{text: menuGreetings[0].text},menuGreatingPartTwo[0], menuGreatingPartTwo[1]];
				meSpeakService.Talk(x);
				
			}
			
		 };
	});
</script>