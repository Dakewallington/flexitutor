<div >
    <div flex="100" ng-controller="cards" ng-cloak> 
    	
        <!--<div id="loader" class="container" ng-class="{'visible' : !vm.activated}">
            <md-progress-linear md-mode="{{vm.modes[1]}}"></md-progress-linear>
            <div class="bottom-block">
              <span>Loading application data...</span>
            </div>
        </div>-->
        
        
        <div layout=="column" ng-hide="hideCards === true">
            <md-card>
                <md-card-content class="cards" >
                    <md-button class="md-fab md-mini md-primary" ng-click="backup()" ><i class="fa fa-chevron-left"></i></md-button>
                </md-card-content>
            </md-card>
            <md-card flex>
                <md-card-content class="cards" >
                    <h3 id="cardTitle" class="text-center colorTextWhite">
                       {{chapter}}: {{drill}}
                    </h3>
                </md-card-content>
            </md-card>
            <md-card flex="15">
                <md-card-content class="cards" >
                    <h4 id="counter" class="colorTextWhite text-right">card <span id="currentCard">{{currentCard}}</span>/<span id="maxCards">{{cardMax}}</span></h4>
                </md-card-content>
            </md-card>
        </div>
        
        <div  layout="row" ng-hide="hideCards === true">
                <md-card flex class="items" id="card1" md-swipe-right="GoBackOrForward('back')" ng-click="GoBackOrForward('back')">
                    <md-card-content class="cards" >
                    	<div layout="column" layout-align="center center" >
                            <div layout="column" layout-align="center center">
                            	<p class="noSelect" ng-hide="card1.hideTopText">{{card1.topText}}</p>
                                <md-button ng-hide="card1.hideTopCover" class="md-primary md-hue-1" ng-disabled="true">
                                	<i class="fa fa-3x fa-question-circle ng-scope"></i>
                                </md-button>
                                
                            </div>
                            <div><md-button class="md-primary md-hue-1" ng-disabled="true"><i class="fa fa-3x fa-play-circle ng-scope"></i></md-button></div>
                            <img ng-src="{{card1.imageSrc}}" class=' noSelect cardImage' />
                            <div><md-button class="md-primary md-hue-1" ng-disabled="true"><i class="fa fa-3x fa-play-circle ng-scope"></i></md-button></div>
                            <p class="noSelect" >{{card1.bottomText}}</p>
                       	</div>
                      
                    </md-card-content>
                </md-card>
                <md-card flex md-swipe-right="GoBackOrForward('back')" id="card2"  md-swipe-left="GoBackOrForward('forward')">
                    <md-card-content class="cards" >
                       	<div layout="column" layout-align="center center" >
                            <div layout="column" layout-align="center center">
                            	<p class="noSelect" ng-hide="card2.hideTopText">{{card2.topText}}</p>
                                <md-button ng-hide="card2.hideTopCover" class="md-primary md-hue-1" ng-click="ShowTopHidden()">
                                	<i class="fa fa-3x fa-question-circle ng-scope"></i>
                                </md-button>
                                <div layout="row" ng-hide="card2.hideTopAnswer">
                                    <md-input-container flex >
                                          <label>What is name of this?</label>
                                          <input ng-model="topUserAnswer">
                                    </md-input-container>
                                    <md-button ng-click="TopCheckAnswer()">enter</md-button>
                                </div>
                                <div layout="row" flex class="alert alert-success" layout-align="center center" ng-hide="card2.hideTopCorrect">
                                	Correct, answer was: {{card2.topText}}
                                </div>
                                <div layout="row" flex class="alert alert-danger" layout-align="center center" ng-hide="card2.hideTopIncorrect">
                                	Incorrect, answer was: {{card2.topText}}
                                </div>
                            </div>
                            <div layout="row" layout-align="center center">
                            	<md-button class="md-primary md-hue-1" ng-click="PlayTopAudio()">
                                	<i class="fa fa-3x fa-play-circle ng-scope"></i>
                                </md-button>
                            </div>
                            <img ng-src="{{card2.imageSrc}}" class=' noSelect cardImage' />
                            <div layout="row" layout-align="center center">
                            	<md-button class="md-primary md-hue-1" ng-click="PlayBottomAudio()">
                                	<i class="fa fa-3x fa-play-circle ng-scope"></i>
                                </md-button>
                            </div>
                            <div layout="column" layout-align="center center">
                            	<p class="noSelect" ng-hide="card2.hideBottomText">{{card2.bottomText}}</p>
                                <md-button ng-hide="card2.hideBottomCover" class="md-primary md-hue-1" ng-click="ShowBottomHidden()">
                                	<i class="fa fa-3x fa-question-circle ng-scope"></i>
                                </md-button>
                                <div layout="row" ng-hide="card2.hideBottomAnswer">
                                    <md-input-container flex >
                                          <label>What is name of this?</label>
                                          <input ng-model="bottomUserAnswer">
                                    </md-input-container>
                                    <md-button ng-click="BottomCheckAnswer()">enter</md-button>
                                </div>
                                <div layout="row" class="alert alert-success" layout-align="center center" ng-hide="card2.hideBottomCorrect">
                                	Correct, answer was: {{card2.bottomText}}
                                </div>
                                <div layout="row" class="alert alert-danger" layout-align="center center" ng-hide="card2.hideBottomIncorrect">
                                	Incorrect, answer was: {{card2.bottomText}}
                                </div>
                            </div>
                       	</div>
                    </md-card-content>
                </md-card>
                <md-card flex class="items" id="card3" md-swipe-left="GoBackOrForward('forward')" ng-click="GoBackOrForward('forward')">
                    <md-card-content class="cards">
                         <div layout="column" layout-align="center center" >
                            <div layout="column" layout-align="center center">
                            	<p class="noSelect" ng-hide="card3.hideTopText">{{card3.topText}}</p>
                                <md-button ng-hide="card3.hideTopCover" class="md-primary md-hue-1" ng-disabled="true">
                                	<i class="fa fa-3x fa-question-circle ng-scope"></i>
                                </md-button>
                            </div>
                            <div><md-button class="md-primary md-hue-1" ng-disabled="true"><i class="fa fa-3x fa-play-circle ng-scope"></i></md-button></div>
                            <img ng-src="{{card3.imageSrc}}" class=' noSelect cardImage' />
                            <div><md-button class="md-primary md-hue-1" ng-disabled="true"><i class="fa fa-3x fa-play-circle ng-scope"></i></md-button></div>
                            <p class="noSelect" >{{card3.bottomText}}</p>
                       	</div>
                    </md-card-content>
                </md-card>
            </div>
        
    </div>
</div>