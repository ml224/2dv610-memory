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

    public function test_getPile_shouldReturnArrayWithDoubleCount(){
        $sut = $this->getSut(4);
        $fileReaderStub = $this->fakeFileReader();
        
        $expectedArrayCount = 8;
        $actualArrayCount = count($sut->getPile($fileReaderStub));

        $this->assertSame($expectedArrayCount, $actualArrayCount);
    }

    private function fakeFileReader(){
        $images = array("chicken.png", "cow.png", "fish.png", "sheep.png");    
        $fakeFileReader = $this->createMock(FileReader::class);
        $fakeFileReader->method('getImages')
            ->willReturn($images);
        
        return $fakeFileReader;
    }

}


