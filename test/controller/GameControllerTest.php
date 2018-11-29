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
        $view = $this->fakeGameView($newGameRequest);
        $pile = $this->fakePile();

        $sut = new GameController();
        
        $actual = $sut->runGame($view, $pile);
        $expected = $view->displayGame($this->cards);

        $this->assertEquals($actual, $expected);
    }
    
    public function test_runGame_shouldDisplayOptionsWhenNewGameRequestTrue(){
        $newGameRequest = true;
        $view = $this->fakeGameView($newGameRequest);
        $pile = $this->fakePile();
        
        $sut = new GameController();
        
        $actual = $sut->runGame($view, $pile);
        $expected = $view->displayOptions();

        $this->assertEquals($actual, $expected);
    }

    public function test_runGame_shouldNotDisplayCow(){
        //prepare condition for removing cow.png
        $_SESSION['last_card'] = 'cow.png';
        $_POST['clicked_image'] = 'cow.png';
        $newGameRequest = false;

        $view = $this->fakeGameView($newGameRequest);
        $pile = $this->fakePile();

        $sut = new GameController($this->fakePile(), $this->fakeGameView($newGameRequest));
        $actual = $sut->runGame($view, $pile);
        $expected = join(array('fish.png', 'fish.png'));
        $this->assertEquals($actual, $expected);

    }

    private function fakeGameView($newGameRequest){

        $fake = \Mockery::mock('iGameView');
        $fake   
            ->shouldReceive('displayGame')
            ->with(\Mockery::type('array'))
            ->andReturnUsing(function(array $cards){
                return join($cards);
            });

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
