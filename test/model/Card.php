<?php
use PHPUnit\Framework\TestCase;
require_once("../src/model/Card.php");

class CardTest extends TestCase
{
    private $id = "123";
    

    public function test_GetId_shouldReturnCorrectStringId()
    {
        $card = new Card($this->id);
        $this->assertSame($card->getId(), $this->id);
    }
}

