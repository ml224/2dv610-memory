<?php

class Pile{
    private $rowSize;
    private $pile;

    function __construct(Array $images){
        if($this->invalidSize($images)){
            throw new InvalidArgumentException();
        } 
        
        $this->pile = array_merge($images, $images);
    }

    private function invalidSize(Array $images) : bool {
        $allowedSizes = [4, 5, 6];
        foreach($allowedSizes as $size){
            if(count($images) === $size){
                return false;
            }
        }

        return true;
    }

    public function getPile(){
        return $this->pile;
    }

    

    public function removeFromPile($card){
        $this->pile = array_diff($this->pile, array($card));
    }
}