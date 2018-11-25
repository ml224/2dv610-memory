<?php
use PHPUnit\Framework\TestCase;
require_once("./src/model/Card.php");

class CardTest extends TestCase
{

    public function test_GetId_shouldReturnCorrectStringId()
    {
        $id = "some id";
        $sut = new Card($id);
        $this->assertSame($sut->getId(), $id);
    }
}

