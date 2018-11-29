<?php
use PHPUnit\Framework\TestCase;
require_once("./src/view/iGameView.php");
require_once("./src/model/Pile.php");
require_once("./src/model/FileReader.php");
require_once("./src/controller/GameController.php");


class GameControllerTest extends TestCase
{
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
    
    private $cards = array('cow.png', 'cow.png', 'fish.png', 'fish.png');
    
    public function test_runGame_shouldDisplayGameWhenNewGameRequestFalse(){
        $newGameRequest = false;
        $mockView = $this->fakeGameView($newGameRequest);

        $sut = new GameController();
        
        $actual = $sut->runGame($mockView);
        $expected = $mockView->displayGame();

        $this->assertEquals($actual, $expected);
    }
    
    public function test_runGame_shouldDisplayOptionsWhenNewGameRequestTrue(){
        $newGameRequest = true;
        $mockView = $this->fakeGameView($newGameRequest);
        
        $sut = new GameController();
        
        $actual = $sut->runGame($mockView);
        $expected = $mockView->displayOptions();

        $this->assertEquals($actual, $expected);
    }

    public function test_runGame_shouldNotDisplayCow(){
        $_SESSION['last_card'] = 'cow.png';
        $_POST['clicked_image'] = 'cow.png';
        $newGameRequest = false;

        $sut = new GameController($this->fakePile(), $this->fakeGameView());
        $actual = $sut->displayGame($newGameRequest);
        $expected = join(array('fish.png', 'fish.png'));
        $this->assertEquals($actual, $expected);

    }

    private function fakeGameView($newGameRequest){

        $fake = \Mockery::mock('iGameView');
        $fake   
            ->shouldReceive('displayGame')
            ->with($this->cards)
            ->andReturn(join($this->cards));

        $fake
           ->shouldReceive('displayOptions')
           ->andReturn('Display Options');

        $fake   
            ->shouldReceive('newGameRequest')
            ->andReturn($newGameRequest);
        
        return $fake;
    }

    private function fakePile(){
        $fake = \Mockery::mock('Pile');
        $fake   
            ->shouldReceive('removeFromPile')
            ->with('cow.png')
            ->andReturn($this->cards = array_diff($this->cards, array('cow.png')));

        $fake  
            ->shouldReceive('getPile')
            ->andReturn($this->cards);

        return $fake;
    }

    public function tearDown() {
        \Mockery::close();
    }
}
