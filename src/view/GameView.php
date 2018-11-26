<?php
require_once('iGameView.php');

class GameView implements iGameView{

    private $cards;
    
    public function displaycards(Array $cards) : string {
        $html = '<div class="cards">';
        foreach($cards as $card){
            $html .= '<img src="public/images/'. $card .'">'; 
        }
        $html .= '</div>';

        return $html;
    }
}
