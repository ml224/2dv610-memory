<?php

require_once("./src/view/GameView.php");
require_once("./src/model/Pile.php");
require_once("./src/model/FileReader.php");

class GameController{

    function runGame(iGameView $gameView){
        return $gameView->displayGame();
    }
}