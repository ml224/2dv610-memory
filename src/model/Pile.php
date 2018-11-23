<?php

require_once("FileReader.php");

class Pile{
    private $rowSize;
    private $images;
    
    function __construct(int $amount){
        if($amount == 4 || $amount == 5 || $amount == 6){
            $this->rowSize = $amount;
        }else{
            throw new InvalidArgumentException();
        }
    }

    public function getRowSize(){
        return $this->rowSize;
    }

    public function getPile(){
        $cards = $this->getCards();

        foreach($cards as $card){
            array_push($cards, $card);
        }

        return $cards;
    }

    //not sure how to test this
    private function getCards(){
        $fileReader = new FileReader();
        return $fileReader->getImages($this->rowSize);
    }

}