<?php
	
	/*
	* @Author Sean O'Brien
	* @Version 1.0.5
	* @Copyright : © Copyright 2008 openlanguages.net
	* @Desicription: Signin is were the user Sign in or Sign up
	*/
		
	//turn on the output buffering
	ob_start();
	
	//start SESSION()
	session_start(); 
	
	
	/*if($_SESSION['name'] == NULL)
	{
		header('Location: log.php?lastLocation=' . $_SERVER['REQUEST_URI']);
		exit;	
	}*/
?>
<!DOCTYPE html>

<html lang="en" ng-app="flexApp">
<title>flexitutor</title>
<?php 
	include('header.php');
	 
?>
<body layout="column" ng-controller="app">
	<md-toolbar layout="row">
    	<?php include_once 'toolbarLog.php'?>
    </md-toolbar>
    <div layout="row" flex="100">
    	
        <div layout="column" flex id="content">
        	<md-content layout="column" flex class="md-padding">
                <md-card>
                	<md-card-content class="cards">
                    	<?php echo $message; ?>
                        <?php include_once('antibot.php');?>
                		<div class="panel panel-flex-menuTitle">
                        	<div class="panel-body">
                            	<h3><i class="fa fa-pencil"></i> Creating Account</h3>
                            </div>
                        </div>
                        
                        <br/>
                        <form class="form" id="logForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        	<div class="form-group-lg">
                        		<div id="emailGroup" class="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $emailError){ echo 'has-error has-feedback';} ?>"><input type="email" class="form-control input-lg" placeholder="EMAIL ADDRESS" id="email" name="email" value="<?php echo $_POST['email'] ?>" /></div>
                                <br/>
                                <div id="fNameGroup" class="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $fNameError){ echo 'has-error has-feedback';} ?>"><input type="text" class="form-control input-lg" placeholder="FIRST NAME" id="fName" name="fName" /></div>
                                <br/>
                                <div id="lNameGroup" class="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $lNameError){ echo 'has-error has-feedback';} ?>"><input type="text" class="form-control input-lg" placeholder="LAST NAME" id="lName" name="lName" /></div>
                                <br/>
                                <div id="passGroup" class="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $passwordError){ echo 'has-error has-feedback';} ?>"><input type="password" class="form-control input-lg" placeholder="PASSWORD" id="password" name="password" /></div>
                                <br/>
                                <div id="passGroup2" class="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $passwordError2){ echo 'has-error has-feedback';} ?>"><input type="password" class="form-control input-lg" placeholder="COMFIRM PASSWORD" id="comfirmPassword" name="comfirmPassword" /></div>
                                <br/>
                                
                                <div>
                                	
                                	<div>{{$scope.botTestQuestion}}</div>
                                	<div class="botTest" class="<?php if($_SERVER['REQUEST_METHOD'] == 'POST' && $botTestError){ echo 'has-error has-feedback';} ?>"><input type="text" class="form-control input-lg" placeholder="" id="botTest" name="botTest" /></div>
                                </div>
                                <button class="btn btn-danger input-lg pull-right" id="submit"  type="submit">SIGN UP</button>
                                <button class="btn btn-default input-lg pull-right" type="button">Cancel</button>
                            </div>
                        </form>
                       
                        
                    </md-card-content>
                </md-card>
                
            </md-content>
        </div>
    </div>
  
</body>
</html>