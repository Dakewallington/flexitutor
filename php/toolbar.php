<div class="md-toolbar-tools  ">
    <md-button ng-click="toggleSidenav()" aria-label="Navigation" class="md-icon-button-medium" hide-gt-lg >
        <i class="fa fa-2x fa-navicon"></i>
    </md-button>
    <h1 class="md-display-1"><b>FLEXITUTOR</b></h1>
    <span flex></span>
    <p class="pull-right" hide-gt-sm>Welcome, {{user.name}}</p>
    <md-button class="md-icon-button-medium" aria-label="Sign Out" hide-gt-sm><i class="fa fa-2x fa-ellipsis-v"></i></md-button>
    <md-button class="md-warn md-raised md-hue-2" aria-label="Sign Out" ng-click="checkSignOut($event)" hide-sm> Sign Out</md-button>
    
</div>
        