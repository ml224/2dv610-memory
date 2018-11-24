<?php
use PHPUnit\Framework\TestCase;
require_once("../src/view/GameView.php");
require_once("../src/model/Pile.php");



class GameViewTest extends TestCase
{

    public function test_displayPile_shoulReturnHtmlWithArrayElements(){
        $pile = $this->pileStub();
        $cards = $pile->getPile();

        $sut = $this->sut();         
        $html = $sut->displayPile();

        foreach($cards as $c){
            $this->assertRegexp('/'.$c.'/', $html);
        }
    }

    private function sut(){
        $pile = $this->pileStub();
        $cards = $pile->getPile();

        return new GameView($cards);
    }

    private function pileStub(){
        $cardsForStub = array("test1","test1", "test2", "test2","test4","test4", "test3", "test3");

        $stub = $this->createMock(Pile::class);
        $stub->method('getPile')
        ->willReturn($cardsForStub);

        return $stub;
    }

}


