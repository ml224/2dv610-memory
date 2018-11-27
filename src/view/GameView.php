<?php
require_once('iGameView.php');

class GameView implements iGameView{
    
    private $cards;
    private $clickedCard = 'clicked_image';

    function __construct(Array $cards) {
        $this->cards = $cards;
    } 

    public function displayGameOptions(){
        return '
        <input type="hidden" name="game_option" value="4">
        <input type="hidden" name="game_option" value="5"> 
        <input type="hidden" name="game_option" value="6">
        ';
    }

    public function displayGame() : string {
        if(isset($_POST[$this->clickedCard])){
            echo $this->getClickedImageName();
        }
        return 
        '
        <!DOCTYPE html>
        <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">         
        </head>
        <body>
        <div class="cards">
        '. $this->displayCards() .'
        </div>
        </body>
        '; 
    }
    
    private function displaycards() : string {
        $html = '';
        foreach($this->cards as $card){
            $html .= '
            <form method="post">
            <input type="hidden" name="'.$this->clickedCard.'" value="'.$card.'">
            <input type="image" src="public/images/'. $card .'">
            </form>
            '; 
        }

        return $html;
    }

    public function getClickedImageName(){
        return $_POST[$this->clickedCard];
    }

    public function cardClicked(){
        return isset($_POST[$this->clickedCard]);
    }
}
