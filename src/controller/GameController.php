<?php

require_once("./src/view/GameView.php");
require_once("./src/model/Pile.php");
require_once("./src/model/FileReader.php");

class GameController{

    function runGame(iGameView $gameView){
        if($gameView->newGameRequest()){
            return $gameView->displayOptions();    
        } else {
            return $gameView->displayGame();
        }
    }
}