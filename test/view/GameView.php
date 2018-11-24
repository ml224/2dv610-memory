<?php
use PHPUnit\Framework\TestCase;
require_once("../src/view/GameView.php");
require_once("../src/model/Pile.php");



class GameViewTest extends TestCase
{
    public function test_displayPile_shouldReturnString(){
        $view = new GameView();
        $this->assertInternalType($view->displayPile(), "string");
    }

    public function test_displayPile_shoulReturnStringWithArrayElements(){
        $sut = new GameView();
        $pile = $this->pileStub();
        $cards = $pile->getPile();

        $html = $sut->displayPile($cards);

        foreach($cards as $c){
            $this->assertRegexp('/'.$c.'/', $html);
        }

    }

    private function pileStub(){
        $stub = $this->createMock(Pile::class);
        $stub->method('getPile')
        ->willReturn(array("test1","test1", "test2", "test2","test4","test4", "test3", "test3"));

        return $stub;
    }

}


