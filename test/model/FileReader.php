<?php
use PHPUnit\Framework\TestCase;
require_once("../src/model/FileReader.php");
require_once("../src/model/Pile.php");


class FileReaderTest extends TestCase
{
    public function test_getImages_shouldReturnFourElements(){
        $amount = 4;
        $sut = $this->getFileReader();
        $stub = $this->fakePile($amount);
        
        $this->assertEquals($stub->getRowSize(), count($sut->getImages($amount)));
    }

    private function getFileReader(){
        return new FileReader();
    }

    private function fakePile(int $amount){
        $stub = $this->createMock(Pile::class);
        $stub->method('getRowSize')
             ->willReturn($amount);
        
        return $stub;
    }
}


