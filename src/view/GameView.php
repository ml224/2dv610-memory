<?php

require_once('iGameView.php');

class GameView implements iGameView{
    
    public function displayCards(Array $cards) : string {
        $html = '<div class="cards">';
        foreach($cards as $card){
            $html .= '<img src="images/'. $card .'">'; 
        }
        $html .= '</div>';

        return $html;
    }
}
