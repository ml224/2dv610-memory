<?php
require_once('iGameView.php');

class GameView implements iGameView{
    
    private $cards;
    private $clickedCard = 'clicked_image';

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
        <body>
        <div class="cards">
        '. $this->displayCards() .'
        </div>
        </body>
        '; 
    }
    
    private function displaycards() : string {
        $html = '<form method="post">';
        foreach($this->cards as $card){
            $html .= '<input type="image" value="'. $card .'" src="public/images/'. $card .'">'; 
        }
        $html .= '</form>';

        return $html;
    }

    public function getClickedImageName(){
        return $_POST[$this->clickedCard];
    }
}
