<?php
use PHPUnit\Framework\TestCase;
require_once("./src/view/iGameView.php");
require_once("./src/model/Pile.php");
require_once("./src/model/FileReader.php");
require_once("./src/controller/GameController.php");


class GameControllerTest extends TestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
    
    public function test_runGame_shouldRenderHtmlWithPileElements(){
        $cards = array("cow.png","chicken.png", "sheep.png", "fish.png");
        $duplicatedCards = array_merge($cards, $cards);
        $resultString = join($duplicatedCards);

        
        $mockView = $this->fakeGameView($resultString);
        $stubPile = $this->fakePile($duplicatedCards);
        
        $sut = new GameController();
        $actual = $sut->runGame($stubPile, $mockView);
        $expected = $resultString;

        $this->assertEquals($actual, $expected);
    }
    
    private function fakePile($cards){
        $fake = \Mockery::mock('Pile');
        $fake 
            ->shouldReceive('getPile')
            ->andReturn($cards);
        return $fake;
    }

    private function fakeGameView($resultString){
        $fake = \Mockery::mock('iGameView');
        $fake   
            ->shouldReceive('displayCards')
            ->with(\Mockery::type('array'))
            ->andReturn($resultString);

        return $fake;
    }

    public function tearDown() {
        \Mockery::close();
    }
}
