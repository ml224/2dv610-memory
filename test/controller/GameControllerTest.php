<?php
use PHPUnit\Framework\TestCase;
require_once("./src/view/iGameView.php");
require_once("./src/model/Pile.php");
require_once("./src/model/FileReader.php");
require_once("./src/controller/GameController.php");


class GameControllerTest extends TestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
    
    public function test_runGame_shouldReturnHtmlFromView(){
        $mockView = $this->fakeGameView();
        $sut = new GameController();
        
        $actual = $sut->runGame($mockView);
        $expected = $mockView->displayGame();

        $this->assertEquals($actual, $expected);
    }

    private function fakeGameView(){
        $fake = \Mockery::mock('iGameView');
        $fake   
            ->shouldReceive('displayGame')
            ->andReturn("Some HTML");

        return $fake;
    }

    public function tearDown() {
        \Mockery::close();
    }
}
