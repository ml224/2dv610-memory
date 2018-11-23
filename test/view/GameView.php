<?php
use PHPUnit\Framework\TestCase;
require_once("../src/view/GameView.php");


class GameViewTest extends TestCase
{
    public function test_displayPile_shouldReturnString(){
        $view = new GameView();
        $this->assertInternalType($view->displayPile(), "string");
    }

}


