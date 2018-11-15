<?php
use PHPUnit\Framework\TestCase;
require_once("../src/model/FileReader.php");
require_once("../src/model/Pile.php");


class FileReaderTest extends TestCase
{
    private function getFileReader(){
        return new FileReader();
    }

    public function test_getImages_shouldReturnFourElements(){
        $sut = $this->getFileReader();
        
        $stub = $this->createMock(Pile::class);
        $stub->getRowSize()->willReturn(4);

        $this->assertCount($stub->getRowSize(), $sut->getImages(4));
    }

}


