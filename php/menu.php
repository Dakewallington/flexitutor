<?php
	/* have the menu relfleck back see what page is on. */
	$searchText = '/fileadmin/site/alpha1.0.5/php/';
	$phpSelfString = $_SERVER['PHP_SELF'];
	$phpSelfString = str_replace($searchText,'',$phpSelfString);
	$phpSelfString = str_replace('.php','',$phpSelfString);
?>

<md-sidenav layout="column"  class="md-sidenav-left " md-component-id="left" md-is-locked-open="$mdMedia('gt-md')">
    <div class="iconSpacer" hide-gt-sm>
    </div>
    <div class="menu">
        <table class="menuItem" hide-sm>
            <tr>
                <td><i class="fa fa-3x fa-user userIcon"></i></td>
                <td><span class="md-title ">Welcome, <br/><b class="textColorWhite">{{user.name}}</b></span></td>
            </tr>
        </table>
        <div class="menuSpacer" hide-sm></div>
        <table class="menuItem">  
            <tr class="<?php if($phpSelfString == 'dashboard'){echo 'active';} ?>">
                <td><md-button class=" md-icon-button-medium" ng-click="LoadPage('dashboard')" aria-label="Dashboard"><i class="fa fa-2x fa-home "></i></md-button></td>
                <td><span class="md-title ">Dashboard</span></td>
            </tr>
        </table>
        <table class="menuItem">
            <tr class="<?php if($phpSelfString == 'manageusers'){echo 'active';} ?>">
                <td><md-button class=" md-icon-button-medium" ng-click="LoadPage('manageusers')" aria-label="Manage Users"><i class="fa fa-2x fa-group "></i></md-button></td>
                <td><span class="md-title">Manage Users</span></td>
            </tr>
        </table>
        <table class="menuItem">
            <tr class="<?php if($phpSelfString == 'activity'){echo 'active';} ?>">
                <td><md-button class=" md-icon-button-medium" aria-label="Activity Lession" ng-click="LoadPage('activity')" ><i class="fa fa-2x fa-comments "></i></md-button></td>
                <td><span class="md-title">Activity Lessons</span></td>
            </tr>
        </table>
        <table class="menuItem">
            <tr class="<?php if($phpSelfString == 'indivanalytics'){echo 'active';} ?>">
                <td><md-button class=" md-icon-button-medium" ng-click="LoadPage('indivanalytics')" aria-label="Your Analytics"><i class="fa fa-2x fa-area-chart "></i></md-button></td>
                <td><span class="md-title">Your Analytics</span></td>
            </tr>
        </table>
        <table class="menuItem">
            <tr class="<?php if($phpSelfString == 'globalanalytics'){echo 'active';} ?>">
                <td><md-button class=" md-icon-button-medium" ng-click="LoadPage('globalanalytics')" aria-label="Member Analytics"><i class="fa fa-2x fa-pie-chart "></i></md-button></td>
                <td><span class="md-title">Member Analytics</span></td>
            </tr>
        </table>
        <tr />
        <table class="menuItem">
            <tr class="<?php if($phpSelfString == 'account'){echo 'active';} ?>">
                <td><md-button class=" md-icon-button-medium" ng-click="LoadPage('account')" aria-label="Account Settings"><i class="fa fa-2x fa-gear "></i></md-button></td>
                <td><span class="md-title">Account Settings</span></td>
            </tr>
        </table>
        <table class="menuItem">
            <tr class="<?php if($phpSelfString == 'activitysetting'){echo 'active';} ?>">
                <td><md-button class=" md-icon-button-medium" ng-click="LoadPage('activitysetting')" aria-label="Activity Settings"><i class="fa fa-2x fa-pencil-square-o"></i></md-button></td>
                <td><span class="md-title">Activity Settings</span></td>
            </tr>
        </table>
        <table class="menuItem">
            <tr class="<?php if($phpSelfString == 'mespeak'){echo 'active';} ?>">
                <td><md-button class=" md-icon-button-medium" ng-click="LoadPage('mespeak')" aria-label="Me Speak Settings"><i class="fa fa-2x fa-volume-up"></i></md-button></td>
                <td><span class="md-title">Me Speak Settings</span></td>
            </tr>
        </table>
        <table  class="menuItem" hide-sm>
            <tr>
                <td ><md-button class=" md-icon-button-medium" aria-label="Minimize Menu" ng-click="menuShrink()" id="mini"><i class="fa fa-2x fa-angle-double-left"></i></md-button></td>
                <td><span class="md-title">Minimize Menu</span></td>
            </tr>
        </table>
        <table  class="menuItem" hide-gt-sm>
            <tr>
                <td ><md-button class=" md-icon-button-medium" aria-label="Minimize Menu" ng-click="menuMax()" id="max"><i class="fa fa-2x fa-angle-double-right"></i></md-button></td>
                <td><span class="md-title">Minimize Menu</span></td>
            </tr>
        </table>
        <table class="menuItem">
        	<tr>
            	<td><md-switch class="md-primary" md-no-ink aria-label="Switch No Ink" ng-model="audioModeKey" ng-change="ToggleAudioMode()" ></md-switch>
                </td>
                <td>Audio Mode</td>
            </tr>
        </table>
    </div>
</md-sidenav>
