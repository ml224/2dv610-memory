<?php
use PHPUnit\Framework\TestCase;
require_once("./src/view/GameView.php");
require_once("./src/model/Pile.php");
require_once("./src/model/FileReader.php");


class GameViewTest extends TestCase
{
    //use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
    
    public function test_displayPile_shoulReturnHtmlWithArrayElements(){
        $cards = array("cow.png","chicken.png", "sheep.png", "fish.png");
        
        $sut = new GameView();         
        $html = $sut->displayCards($cards);

        foreach($cards as $c){
            $this->assertRegexp('/'.$c.'/', $html);
        }
    }

    /*public function test_displayPile_shoulReturnHtmlWithArrayElements(){
        $fileReaderStub = \Mockery::mock('FileReader');
        
        $pileMock = $this->fakePile();
        $cards = $pileMock->getPile($fileReaderStub);

        $sut = $this->sut($cards);         
        $html = $sut->displayPile();

        foreach($cards as $c){
            $this->assertRegexp('/'.$c.'/', $html);
        }
    }

    private function fakePile(){
        $cards = array("cow.png","chicken.png", "sheep.png", "fish.png");
        $duplicatedCards = array_merge($cards, $cards);
        
        $fake = \Mockery::mock('Pile');
        $fake->shouldReceive('getPile')
            ->with('FileReader')
            ->andReturn($duplicatedCards);

        return $fake;
    }   
    
    private function sut($cards){
        return new GameView($cards);
    }

    public function tearDown() {
        \Mockery::close();
    }*/
}


