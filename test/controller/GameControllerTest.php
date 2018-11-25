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

        
        $mockGameView = \Mockery::mock('iGameView');
        $mockGameView   
            ->shouldReceive('displayCards')
            ->with($duplicatedCards)
            ->andReturn($resultString);

        $mockPile = \Mockery::mock('Pile');
        $mockPile 
            ->shouldReceive('getPile')
            ->andReturn($duplicatedCards);
        
        $sut = new GameController();
        $actual = $sut->runGame($mockPile, $mockGameView);
        $expected = $resultString;

        $this->assertEquals($actual, $expected);
    }   

    public function tearDown() {
        \Mockery::close();
    }
}
