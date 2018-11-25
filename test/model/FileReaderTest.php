<?php
use PHPUnit\Framework\TestCase;
require_once("./src/model/FileReader.php");
require_once("./src/model/Pile.php");


class FileReaderTest extends TestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    public function test_getImages_shouldReturnFourElements(){
        $sut = new FileReader();
        $expectedCount = 4;
        $actualCount = count($sut->getImages(4));

        $this->assertEquals($expectedCount, $actualCount);
    }
}


