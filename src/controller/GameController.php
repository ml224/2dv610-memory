<?php
session_start();

require_once("./src/view/GameView.php");
require_once("./src/model/Pile.php");
require_once("./src/model/FileReader.php");

class GameController{

    private $lastCard = 'last_card';

    function runGame(iGameView $gameView, Pile $pile){
        if($gameView->newGameRequest()){
            return $gameView->displayOptions();    
        } else {
            //check if session is same as clicked card
            //if so, remove images from pile
            //send in pile to display game
            if($this->sessionSet() && isset($_POST['card_clicked']) 
            && $_SESSION[$this->lastCard] === $_POST['card_clicked']){
                $pile->removeFromPile('cow.png');
            }

            $cards = $pile->getPile();
            return $gameView->displayGame($cards);
        }
    }

    private function sessionSet(){
        return isset($_SESSION[$this->lastCard]);
    }
}