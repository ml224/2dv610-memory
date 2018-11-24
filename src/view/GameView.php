<?php

class GameView{
    function __construct(){

    }
    public function displayPile($cards){
        $html = '<div class="cards">';
        foreach($cards as $card){
            $html .= '<img src="images/'. $card .'">'; 
        }
        $html .= '</div>';

        return $html;
    }
}
