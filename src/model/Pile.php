<?php
class Pile{
    function __construct(int $amount){
        if($amount == 4 || $amount == 5 || $amount == 6){
        }else{
            throw new InvalidArgumentException();
        }
    }

}