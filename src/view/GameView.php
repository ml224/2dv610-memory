<?php

class GameView{
    
    private $clickedCard = 'clicked_image';
    private $newGameRequest = 'new_game_request';

    public function displayGameOptions($options = array(8, 10, 12)){
        $html = '';
        foreach($options as $amount){
        $html .= '
        <form method="post">
        <input type="hidden" name="game_option" value="'.$amount.'">
        <input type="button" name="game_option" value="'.$amount.' brickor">
        </form>
        ';
        }

        return $html;
    }

    public function displayGame(Array $cards) : string {
        return 
        '
        <!DOCTYPE html>
        <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">         
        </head>
        <body>
        <div class="cards">
        '. $this->displayCards($cards) .'
        </div>
        </body>
        '; 
    }
    
    private function displaycards(Array $cards) : string {
        $html = '';
        foreach($cards as $card){
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

    public function newGameRequest(){
        return isset($_POST[$this->newGameRequest]);
    }
}
