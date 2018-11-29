<?php

require_once("./src/view/GameView.php");
require_once("./src/model/Pile.php");
require_once("./src/model/FileReader.php");

class GameController{

    function runGame(iGameView $gameView, Pile $pile){
        if($gameView->newGameRequest()){
            return $gameView->displayOptions();    
        } else {
            //check if session is same as clicked card
            //if so, remove images from pile
            //send in pile to display game
            
            $cards = $pile->getPile();
            return $gameView->displayGame($cards);
        }
    }
}