<script>
	flexApp.controller('app', function($scope, $mdSidenav, $cookies, $http)
	{
		
		$scope.user =
		{
			name : ''
		};
				
		
		$scope.LoadPage = function(page)
		{
			location.href = page + '.php';	
		}
		
		
		$scope.getUserName = function()
		{
			$http
			(
				{
					method: 'GET',
					url: '../scripts/getUserData.php?accountID=' + $cookies.get('accountID')
				}
			).then
			(
				function successCallback(response)
				{
					//console.log(response.data);
					$scope.user.name = response.data[0].name;
				},
				function errorCallback(response)
				{
					
				}
			);
		}
		$scope.toggleSidenav = function()
		{
			$mdSidenav('left').toggle();
		}
		
		$scope.getUserName();
		
	});

</script>