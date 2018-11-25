<?php

require_once("./src/view/GameView.php");
require_once("./src/model/Pile.php");
require_once("./src/model/FileReader.php");

class GameController{

    function runGame(Pile $pile, iGameView $gameView){
        $cards = $pile->getPile(new FileReader());
        return $gameView->displayCards($cards);
    }
}