<?php
require_once('iGameView.php');

class GameView implements iGameView{
    
    private $cards;

    function __construct(Array $cards) {
        $this->cards = $cards;
    } 

    public function displayGame() : string {
        return 
        '
        <!DOCTYPE html>
        <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">         
        </head>
        <body>'.$this->displayCards() .'</body>
        '; 
    }
    
    private function displaycards() : string {
        $html = '<div class="cards">';
        foreach($this->cards as $card){
            $html .= '<img src="public/images/'. $card .'">'; 
        }
        $html .= '</div>';

        return $html;
    }
}
