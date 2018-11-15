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
        $invalidSizes = array_merge(range(-200, 3), range(7, 200));
        foreach($invalidSizes as $size){
            $this->expectException(InvalidArgumentException::class);
            $sut = $this->getSut($size);
        }
    }

    public function test_getRowSize_returnCorrectSize(){
        $allowedSizes = array(4, 5, 6);
        foreach($allowedSizes as $size){
            $sut = $this->getSut($size);
            $this->assertSame($sut->getRowSize(), $size);
        }
    }
}

