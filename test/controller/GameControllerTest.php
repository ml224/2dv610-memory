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
        $newGameRequest = false;
        $this->runGame_display($newGameRequest);
    }

    
    public function test_runGame_shouldDisplayOptionsWhenNewGameRequestTrue(){
        $newGameRequest = true;
        $this->runGame_display($newGameRequest);
    }

    private function runGame_display($newGameRequest){
        $cards = array('chicken.png', 'chicken.png', 'fish.png', 'fish.png');

        $view = $this->fakeGameView($newGameRequest);
        $pile = $this->fakePile($cards);

        $sut = new GameController();
        
        $actual = $sut->runGame($view, $pile);
        $expected = $newGameRequest ? 
        $view->displayOptions()
        : $view->displayGame($this->cards);

        $this->assertEquals($actual, $expected);
    }
    

    public function test_runGame_shouldNotDisplayCow(){
        $cards = array('cow.png', 'cow.png', 'fish.png', 'fish.png');

        //prepare condition for removing cow.png
        $_SESSION['last_card'] = 'cow.png';
        $_POST['clicked_image'] = 'cow.png';
        $newGameRequest = false;

        $view = $this->fakeGameView($newGameRequest);
        $pile = $this->fakePile($cards);

        $sut = new GameController();
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

        $fake->shouldReceive('displayOptions')->andReturn('Display Options');
        $fake->shouldReceive('newGameRequest')->andReturn($newGameRequest);   
        
        return $fake;
    }

    private function fakePile($cards){
        $fake = \Mockery::mock('Pile');

        $fake  
            ->shouldReceive('getPile')
            ->andReturn($cards);

        $fake   
            ->shouldReceive('removeFromPile')
            ->with('cow.png')
            ->andReturn($cards = array_diff($cards, array('cow.png')));


        return $fake;
    }

    public function tearDown() {
        \Mockery::close();
    }
}
