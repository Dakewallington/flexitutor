<script>
	<?php
		//were going generate 3 set of hex random number from 0-15 then another 0-15	
	?>
	
	(function(angular)
	{
		flexApp.controller('app', function($scope)
		{
			$scope.hex1 = 
			{
				x: <?php echo rand(0,15); ?>,
				y: <?php echo rand(0,15); ?>	
			};
			
			$scope.hex2 = 
			{
					x: <?php echo rand(0,15); ?>,
					y: <?php echo rand(0,15); ?>	
			};
			
			$scope.hex3 = 
			{
					x: <?php echo rand(0,15); ?>,
					y: <?php echo rand(0,15); ?>	
			};
			
			$scope.hexQ1;
			$scope.hexQ2;
			$scope.hexQ3;
			
			$scope.DecodeHex = function(x,y)
			{
				alert(x);
				alert(y);
				
				
				
				alert();
				
				return 0;
				
			};
			//$scope.DecodeHex(1,1);
			$scope.hexQ1 = $scope.DecodeHex($scope.hex1.x,$scope.hex1.y);
			//alert($scope.hexQ1);
			
			
		});
	})(window.angular);
</script>