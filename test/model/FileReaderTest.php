<?php
use PHPUnit\Framework\TestCase;
require_once("./src/model/FileReader.php");


class FileReaderTest extends TestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    public function test_getImages_shouldReturnFourElements(){
        $this->getImages(4);
    }
    
    public function test_getImages_shouldReturnSixElements(){
        $this->getImages(6);
    }

    private function getImages($expectedCount){
        $sut = new FileReader();
        $actualCount = count($sut->getImages($expectedCount));
        $this->assertEquals($expectedCount, $actualCount);
    }
}


