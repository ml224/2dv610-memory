<?php
session_start();

require_once("./src/view/GameView.php");
require_once("./src/model/Pile.php");
require_once("./src/model/FileReader.php");

class GameController{

    private $lastCard = 'last_card';
    private $clickedCard = 'card_clicked'; 

    function runGame(iGameView $gameView, Pile $pile){
        if($gameView->newGameRequest()){
            return $gameView->displayOptions();    
        } else {
            //check if session is same as clicked card
            //if so, remove images from pile
            //send in pile to display game
            if($this->sessionAndPostSet() && $this->cardsSame()){
                $pile->removeFromPile($_POST[$this->clickedCard]);
            }

            $cards = $pile->getPile();
            return $gameView->displayGame($cards);
        }
    }

    private function sessionAndPostSet(){
        return isset($_SESSION[$this->lastCard]) && isset($_POST[$this->clickedCard]);
    }

    private function cardsSame(){
        return $_SESSION[$this->lastCard] === $_POST[$this->clickedCard];
    }
}