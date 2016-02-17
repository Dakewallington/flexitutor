[<?php

	include_once('../php/connectdb.php');
	$q = "SELECT topTextSetting, topAudioSetting, imageSetting, bottomTextSetting, bottomAudioSetting,xSpeedSetting, ySpeedSetting, topAudioTypeSetting, 
	bottomAudioTypeSetting, meSpeakVoiceSpeed, meSpeakVoiceVariant, meSpeakAmplitude, meSpeakPitch 
	FROM accounts WHERE accountID='" . $_GET["accountID"] . "'" /* remove this before going live $_SESSION['accountID']*/ . "'";
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

?>]