<?php

class GameView{
    private $cards;

    function __construct(Array $cards){
        $this->cards = $cards;
    }
    
    public function displayPile() : string {
        $html = '<div class="cards">';
        foreach($this->cards as $card){
            $html .= '<img src="images/'. $card .'">'; 
        }
        $html .= '</div>';

        return $html;
    }
}
