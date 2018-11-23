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
        return $this->rowSize;
    }

    public function getPile(){
        $fileReader = new FileReader();
        $images = $fileReader->getImages($this->rowSize);
        
        foreach($images as $image){
            array_push($images, $image);
        }

        return $images;
    }

}