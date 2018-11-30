<?php
session_start();

require_once("./src/view/GameView.php");
require_once("./src/model/Pile.php");
require_once("./src/model/FileReader.php");

class GameController{

    private $lastCard = 'last_card';
    private $gameView;
    private $pile;

    function runGame(GameView $gameView, Pile $pile){
        $this->gameView = $gameView;
        $this->pile = $pile;

        if($gameView->newGameRequest()){
            return $gameView->displayOptions();    
        } else {
            if($this->sessionAndPostSet() && $this->cardsSame()){
                $pile->removeFromPile($_SESSION[$this->lastCard]);
            }

            $cards = $pile->getPile();
            return $gameView->displayGame($cards);
        }
    }

    private function sessionAndPostSet(){
        return isset($_SESSION[$this->lastCard]) && $this->gameView->cardClicked();
    }

    private function cardsSame(){
        return $_SESSION[$this->lastCard] === $this->getClickedCard();
    }

    private function getClickedCard(){
        return $this->gameView->getClickedImageName();
    }
}