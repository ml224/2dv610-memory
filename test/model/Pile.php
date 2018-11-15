<?php
use PHPUnit\Framework\TestCase;
require_once("../src/model/Pile.php");

class PileTest extends TestCase
{

    public function getSut(int $amount){
        return new Pile($amount);
    }

    public function test_construct_instanceOfPile(){
        $sut = $this->getSut(4);
        $this->assertInstanceOf(Pile::class, $sut);
    }

    public function test_construct_invalidArgument(){
        $this->expectException(InvalidArgumentException::class);
        $sut = $this->getSut(77);        
    }

    public function test_getRowSize_returnCorrectSize(){
        $sut = $this->getSut(4);
        $this->assertSame($sut->getRowSize(), 4);
    }
}

