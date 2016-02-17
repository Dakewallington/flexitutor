[<?php		
			include_once('../php/connectdb.php');
				
            $q = "SELECT * FROM activityCards WHERE moduleID='" . $_GET['module'] . "' AND chapterID='" . $_GET['chapter'] . "' AND drillID='" . $_GET['drill'] ."'";
			//print($q);
			$run = mysqli_query($dbc,$q);
			
			$num = mysqli_num_rows($run);
			
			$i = 0;
			if($num > 0)
			{
				while($data = mysqli_fetch_array($run)) //this while run for each row the querry came back with.
				{
					echo '{';
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
							
							echo '"topText"' . ':' . '"' . $data['topText'] . '",';
							echo '"topAudioPathMP3"' . ':' . '"' . $data['topAudioPathMP3'] . '",';
							echo '"topAudioPathOGG"' . ':' . '"' . $data['topAudioPathOGG'] . '",';
							echo '"imagePath"' . ':' . '"' . $data['imagePath'] . '",';
							echo '"bottomText"' . ':' . '"' . $data['bottomText'] . '",';
							echo '"bottomAudioPathMP3"' . ':' . '"' . $data['bottomAudioPathMP3'] . '",';
							echo '"bottomAudioPathOGG"' . ':' . '"' . $data['bottomAudioPathOGG'] . '"';
					$i++;		
					if($i < $num) 
					{
						echo  '},';
					}
					else
					{
						echo  '}';
					}
					
				}
				
			}
			
			
			
?>]

