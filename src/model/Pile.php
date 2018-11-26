<?php

class Pile{
    private $rowSize;
    private $pile;

    function __construct(int $amount){
        if($amount == 4 || $amount == 5 || $amount == 6){
            $this->rowSize = $amount;
            $this->pile = $this->getNewPile($amount);
        }else{
            throw new InvalidArgumentException();
        }
    }

    private function getNewPile($amount){
        $fr = new FileReader();
        $cards = $fr->getImages($this->rowSize);

        foreach($cards as $card){
            array_push($cards, $card);
        }

        return $cards;
    }

    public function getRowSize(){
        return $rowSize;
    }


    public function getPile(){
        return $this->pile;
    }

    public function removeFromPile($card){
        $this->pile = array_diff($this->pile, array($card));
    }
}