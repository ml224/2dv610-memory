<?php
use PHPUnit\Framework\TestCase;
require_once("../src/model/Pile.php");

class PileTest extends TestCase
{

    public function getSut(int $amount){
        return new Pile($amount);
    }

    public function test_sutInstanceOfPile(){
        $sut = $this->getSut(4);
        $this->assertInstanceOf(Pile::class, $sut);
    }

    public function test_invalidArgument(){
        $sut = $this->getSut(77);
        $this->expectException(InvalidArgumentException::class);

    }
}

