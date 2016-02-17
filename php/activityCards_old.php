	<div flex="100" ng-cloak layout="column">
        <!--<md-card ng-controller="loads as load" >
        	<md-card-content class="cards">
            	<md-progress-circular class="md-hue-1 center-block" md-mode="{{load.modes[0]}}" md-diameter="55px"></md-progress-circular>
               
            </md-card-content>
        </md-card>-->
        
        <div ng-controller="cards" >
        	
        	<div layout=="column">
            	<md-card>
                    <md-card-content class="cards" >
                        <md-button class="md-fab md-mini md-primary" ng-href="activity.php?activity=selecter&unit=<?php echo $_GET['unit']; ?>&chapter=<?php echo $_GET['chapter']; ?>"><i class="fa fa-chevron-left"></i></md-button>
                    </md-card-content>
                </md-card>
                <md-card flex>
                    <md-card-content class="cards" >
                        <h3 id="cardTitle" class="text-center colorTextWhite">
                   			<?php echo $_GET['exerciseSubject']?>: <?php echo $_GET['exerciseTopic']?>
                    	</h3>
                    </md-card-content>
                </md-card>
                <md-card flex="15">
                    <md-card-content class="cards" >
                        <h4 id="counter" class="colorTextWhite text-right">card <span id="currentCard"></span>/<span id="maxCards"></span></h4>
                    </md-card-content>
                </md-card>
            </div>
            
            <div  layout="row">
                <md-card flex class="items" id="card1" md-swipe-right="GoBackOrForward('back')">
                    <md-card-content class="cards" >
                    	
                        <div layout="column" layout-align="center center" >
                             <p id="card1TopText" class="noSelect"></p>
                             <div id="card1TopAudio"></div>
                             <div id="card1ImageHolder"  class='cardImage noSelect'></div>
                             <p id="card1BottomText" class="noSelect"> </p>
                             <div id="card1BottomAudio"></div>
                        </div>
                        
                    </md-card-content>
                </md-card>
                <md-card flex md-swipe-right="GoBackOrForward('back')" id="card2"  md-swipe-left="GoBackOrForward('forward')">
                    <md-card-content class="cards" >
                        <div layout="column" layout-align="center center" >
                             <p id="card2TopText" class="noSelect"></p>
                             <div id="card2TopAudio"><md-button class="md-primary md-hue-1  " ng-click="PlayTopAudio()"><i class="fa fa-3x fa-play-circle ng-scope"></i></md-button></div>
                             <div id="card2ImageHolder"  class=' noSelect cardImage'></div>
                             <p id="card2BottomText" class="noSelect"> </p>
                             <div id="card2BottomAudio"><md-button class="md-primary md-hue-1 " ng-click="PlayBottomAudio()"><i class="fa fa-3x fa-play-circle ng-scope"></i></md-button></div>
                        </div>
                    </md-card-content>
                </md-card>
                <md-card flex class="items" id="card3" md-swipe-left="GoBackOrForward('forward')">
                    <md-card-content class="cards"  >
                         <div layout="column" layout-align="center center" >
                                 <p id="card3TopText" class="noSelect"></p>
                                 <div id="card3TopAudio"></div>
                                 <div id="card3ImageHolder"  class=' cardImage noSelect'></div>
                                 <p id="card3BottomText" class="noSelect"> </p>
                                 <div id="card3BottomAudio"></div>
                            </div>
                    </md-card-content>
                </md-card>
            </div>
        </div>        
	</div><!-- end of flex 100-->
