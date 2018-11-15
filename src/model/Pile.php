<?php
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

}