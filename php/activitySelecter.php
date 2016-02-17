<div ng-controller="actvitySelector">
    <div flex="100"  ng-cloak ng-init="init()">
    	
        <md-card  >
        	<md-card-content class="cards animate-if" ng-hide="box.appSectionHidden">
            	 
                 <div layout="row" layout-align="end center">
                 	<div flex="50"><p class="md-title" id="1">Select A Unit</p></div>
                    <div flex="50" class="text-right">
                    	<md-button id="btnPrev" class="md-fab md-primary md-mini" ng-disabled="true" aria-label="prev button disabled">
                        	<i class="fa fa-angle-left fa-2x"></i>
                        </md-button>
                        <span> {{indexCounter}}/4</span>
                        <md-button id="btnNext" class="md-fab md-primary md-mini" ng-click="nextBox('module')" ng-disabled="app[0] == null"  aria-label="next button to module">
                        	<i class="fa fa-angle-right fa-2x"></i>
                        </md-button>
                     </div>
                 </div>
                 
            	 <div class="list-group">
                 	<div ng-repeat="app in apps track by $index">
                    	<a class="list-group-item" id="'1-{{$index}}'" ng-click="SelctedData('app',app.name)" focus-if="focusIndex == '1-{{$index}}'">{{app.name}}</a>
                    </div>
                 </div>
            </md-card-content>
        </md-card>
		<md-card class="" ng-hide="box.moduleSectionHidden">
        		<md-card-content class="cards" >
            		<div layout="row" layout-align="end center">
                 	<div flex="50"><p class="md-title" id="2">Select A Module</p></div>
                    <div flex="50" class="text-right">
                    	<md-button id="btnPrev" class="md-fab md-primary md-mini" ng-click="nextBox('app')" aria-label="prev button to unit">
                        	<i class="fa fa-angle-left fa-2x"></i>
                        </md-button>
                        <span> {{indexCounter}}/4</span>
                        <md-button id="btnNext" class="md-fab md-primary md-mini" ng-click="nextBox('chapter')" ng-disabled="module[0] == null" aria-label="next button to chapter">
                        	<i class="fa fa-angle-right fa-2x"></i>
                        </md-button>
                     </div>
                 </div>
            	  <div class="list-group">
                 	<div ng-repeat="module in modules track by $index">
                    	<a class="list-group-item" id="'2-{{$index}}'" ng-click="SelctedData('module',module.name)" focus-if="focusIndex == '2-{{$index}}'">{{module.name}}</a>
                    </div>
                 </div> 
            </md-card-content>
        </md-card>
        <md-card  class="" ng-hide="box.chapterSectionHidden">
        	<md-card-content class="cards" >
            		<div layout="row" layout-align="end center">
                 	<div flex="50"><p class="md-title" id="3">Select A Chapter</p></div>
                    <div flex="50" class="text-right">
                    	<md-button id="btnPrev" class="md-fab md-primary md-mini" ng-click="nextBox('module')" aria-label="prev button to module">
                        	<i class="fa fa-angle-left fa-2x"></i>
                        </md-button>
                        <span> {{indexCounter}}/4</span>
                        <md-button id="btnNext" class="md-fab md-primary md-mini" ng-click="nextBox('drill')" ng-disabled="chapter[0] == null" aria-label="next button practice drills">
                        	<i class="fa fa-angle-right fa-2x"></i>
                        </md-button>
                     </div>
                 </div>
            	 <div class="list-group">
                 	<div ng-repeat="chapter in chapters track by $index">
                    	<a class="list-group-item" id="3-{{$index}}" ng-click="SelctedData('chapter',chapter.name)"  focus-if="focusIndex == '3-{{$index}}'">{{chapter.name}}</a>
                    </div>
                 </div>   
            </md-card-content>
        </md-card>
        <md-card  class="" ng-hide="box.drillSectionHidden">
        		<md-card-content class="cards" >
            		<div layout="row" layout-align="end center">
                 	<div flex="50"><p class="md-title" id="4">Select A Practice Drill</p></div>
                    <div flex="50" class="text-right">
                    	<md-button id="btnPrev" class="md-fab md-primary md-mini" ng-click="nextBox('chapter')" aria-label="prev button to chapter">
                        	<i class="fa fa-angle-left fa-2x"></i>
                        </md-button>
                        <span> {{indexCounter}}/4</span>
                        <md-button id="btnNext" class="md-fab md-primary md-mini" ng-disabled="true" aria-label="next button disabled">
                        	<i class="fa fa-angle-right fa-2x"></i>
                        </md-button>
                     </div>
                 </div>
            	   <div class="list-group">
                 	<div ng-repeat="drill in drills track by $index">
                    	<a class="list-group-item" id="4-{{$index}}" ng-click="SelctedData('drill',drill.name)"  focus-if="focusIndex == '4-{{$index}}'">{{drill.name}}</a>
                    </div>
                 </div> 
            </md-card-content>
        </md-card>       
    </div><!-- end of flex 100-->
    
</div>