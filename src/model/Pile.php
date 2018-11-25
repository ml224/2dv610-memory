<?php

require_once("FileReader.php");

class Pile{
    private $rowSize;
    
    function __construct(int $amount){
        if($amount == 4 || $amount == 5 || $amount == 6){
            $this->rowSize = $amount;
        }else{
            throw new InvalidArgumentException();
        }
    }

    public function getRowSize(){
        return $rowSize;
    }

    public function getPile(FileReader $fileReader){
        $cards = $fileReader->getImages($this->rowSize);

        foreach($cards as $card){
            array_push($cards, $card);
        }

        return $cards;
    }
}