<?php
use PHPUnit\Framework\TestCase;
require_once("./src/model/Pile.php");

class PileTest extends TestCase
{
    private $images = array("cow.png", "shrimp.png", "chicken.png", "fish.png");
    
    private function sut(Array $images){  
        return new Pile($images);
    }

    public function test_construct_shouldThrowExceptionIfMoreThanSixImages(){
        $invalidArray = array_fill(0, 7, "cow.png");
        
        $this->expectException(InvalidArgumentException::class);
        $sut = $this->sut($invalidArray);
    }

    public function test_construct_shouldThrowExceptionIfLessThanFourImages(){
        $invalidArray = array_fill(0, 3, "cow.png");
         $this->expectException(InvalidArgumentException::class);
         $sut = $this->sut($invalidArray);
    }

    public function test_getPile_shouldReturnArrayWithDoubleCount(){
        $sut = $this->sut($this->images);
        
        $expectedArrayCount = 8;
        $actualArrayCount = count($sut->getPile());

        $this->assertSame($expectedArrayCount, $actualArrayCount);
    }

    public function test_getPile_shouldReturnTwoElementsOfEachCard(){
        $sut = $this->sut($this->images);
        $numberOfOccurences = array_count_values($sut->getPile());
        $sameValueMerged = array_unique($numberOfOccurences);
        $eachElementAppearsTwice = count($sameValueMerged) === 1 && count($numberOfOccurences) === 4;

        $this->assertTrue($eachElementAppearsTwice);

    }

    public function test_isEmpty_shouldReturnTrueIfEmpty(){
        $sut = $this->sut($this->images);
        foreach($sut->getPile() as $card){
            $sut->removeFromPile($card);
        }

        $this->assertTrue($sut->isEmpty());
    }

    public function test_isEmpty_shouldReturnFalseIfNotEmpty(){
        $sut = $this->sut($this->images);
        $this->assertFalse($sut->isEmpty());
    }

    public function test_removeFromPile_shouldRemoveImageFromPile(){
        $sut = $this->sut($this->images);
        $sut->removeFromPile("cow.png");
        
        $expectedPileCount = 6;
        $actualPileCount = count($sut->getPile());
        
        $this->assertSame($expectedPileCount, $actualPileCount);
    }
}


