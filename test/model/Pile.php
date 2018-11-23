<?php
use PHPUnit\Framework\TestCase;
require_once("../src/model/Pile.php");

class PileTest extends TestCase
{

    private function getSut(int $amount){
        return new Pile($amount);
    }

    public function test_construct_invalidArgumentNegativeRange(){
        $invalidSizes = range(-200, -1);
        foreach($invalidSizes as $size){
            $this->expectException(InvalidArgumentException::class);
            $sut = $this->getSut($size);
        }
    }

    public function test_construct_invalidArgumentPositiveRage(){
        $invalidSizes = array_merge(range(0, 3), range(7, 200));
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

    public function test_getPile_shouldReturnArrayOfCardIds(){
        $sut = $this->getSut(4);
        
        $expectedArrayCount = 8;
        $actualArrayCount = count($sut->getPile());

        $this->assertSame($expectedArrayCount, $actualArrayCount);
    }

}


