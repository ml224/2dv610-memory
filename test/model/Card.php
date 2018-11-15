<?php
use PHPUnit\Framework\TestCase;
require_once("../src/model/Card.php");

class CardTest extends TestCase
{

    public function getSut($id){
        return new Card($id);
    }

    public function test_sutInstanceOfCard(){
        $sut = $this->getSut("some id");
        $this->assertInstanceOf(Card::class, $sut);
    }

    public function test_GetId_shouldReturnCorrectStringId()
    {
        $id = "some id";
        $sut = $this->getSut($id);
        $this->assertSame($sut->getId(), $id);
    }
}

