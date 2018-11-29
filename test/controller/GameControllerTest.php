<?php
use PHPUnit\Framework\TestCase;
require_once("./src/view/iGameView.php");
require_once("./src/model/Pile.php");
require_once("./src/model/FileReader.php");
require_once("./src/controller/GameController.php");


class GameControllerTest extends TestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
    
    public function test_runGame_shouldDisplayGameWhenNewGameRequestFalse(){
        $mockView = $this->fakeGameView();
        $sut = new GameController();
        
        $actual = $sut->runGame($mockView);
        $expected = $mockView->displayGame();

        $this->assertEquals($actual, $expected);
    }
    
    public function test_runGame_shouldDisplayOptionsWhenNewGameRequestTrue(){
        $mockView = $this->fakeGameView();
        $mockView->shouldReceive('newGameRequest')->andReturn(true);
        
        $sut = new GameController();
        
        $actual = $sut->runGame($mockView);
        $expected = $mockView->displayOptions();

        $this->assertEquals($actual, $expected);
    }

    private function fakeGameView(){
        $fake = \Mockery::mock('iGameView');
        $fake   
            ->shouldReceive('displayGame')
            ->andReturn("Game View");

        $fake
           ->shouldReceive('displayOptions')
           ->andReturn('Display Options');

        $fake   
            ->shouldReceive('newGameRequest')
            ->andReturn(false);

        return $fake;
    }

    public function tearDown() {
        \Mockery::close();
    }
}
