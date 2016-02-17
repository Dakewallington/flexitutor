[<?php 

	include('../php/connectdb.php');
						
  $q = "SELECT name FROM activity WHERE parentMenu='unit' ";
  $run = mysqli_query($dbc,$q);
  $num = mysqli_num_rows($run);
  $i=0;
  $num--; //if say there 3 menus it place 3 then were array include 0 as 1 so need remove one
  while($data = mysqli_fetch_array($run))
  {	
	  echo "{";
	  if($i < $num)
	  {
		  echo '"id":'. $i .',"name":"' . $data['name'] . '"},';	
	  }
	  else
	  {
		  echo '"id":'. $i .',"name":"' . $data['name'] . '"}';	
	  }
	  $i++;	
  }
?>]