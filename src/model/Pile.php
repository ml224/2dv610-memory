<?php
class Pile{
    function __construct(int $amount){
        if($amount == 77){
            throw new InvalidArgumentException();
        }
    }
}