<?php

class GameView{
    
    private $clickedCard = 'clicked_image';
    private $newGameRequest = 'new_game_request';

    public function displayGameOptions(){
        return '
        <form method="post">
        <input type="hidden" name="game_option" value="4">
        <input type="button" name="game_option" value="8 brickor">
        </form>

        <form>
        <input type="hidden" name="game_option" value="5"> 
        <input type="button" name="game_option" value="10 brickor"> 
        </form>

        <form>
        <input type="hidden" name="game_option" value="6">
        <input type="button" name="game_option" value="12 brickor">
        </form>
        ';
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
