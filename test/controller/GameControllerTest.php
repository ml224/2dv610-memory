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
    private $session_card = 'last_card';
    private $post_card = 'card_clicked';
    
    public function test_runGame_shouldDisplayOptionsWhenNewGameRequestTrue(){
        $newGameRequest = true;
        $view = $this->fakeGameView($newGameRequest);
        $pile = $this->fakePile();

        $sut = new GameController();
        
        $actual = $sut->runGame($view, $pile);
        $expected =  $view->displayOptions();

        $this->assertEquals($actual, $expected);
    }

    public function test_runGame_shouldRemoveCowFromPile(){
        //prepare condition for removing cow.png
        $_SESSION[$this->session_card] = 'cow.png';
        $_POST[$this->post_card] = 'cow.png';
        $newGameRequest = false;

        $view = $this->fakeGameView($newGameRequest);
        $pile = $this->fakePile();
        $pile->shouldReceive('removeFromPile')->once();
        $pile->shouldReceive('getPile')->andReturn(array('fish.png', 'fish.png'));
        $sut = new GameController();

        $actual = $sut->runGame($view, $pile);
        $expected = 'fish.pngfish.png';
        
        $this->assertEquals($expected, $actual);
    }
    
    public function test_runGame_shouldRemoveFishFromPile(){
        $_SESSION[$this->session_card] = 'fish.png';
        $_POST[$this->post_card] = 'fish.png';
        $newGameRequest = false;

        $view = $this->fakeGameView($newGameRequest);
        $pile = $this->fakePile();
        $pile->shouldReceive('removeFromPile')->once();
        $pile->shouldReceive('getPile')->andReturn(array('fish.png', 'fish.png'));
        $sut = new GameController();

        $actual = $sut->runGame($view, $pile);
        $expected = 'cow.pngcow.png';
        
        $this->assertEquals($expected, $actual);
    }

    public function test_runGame_shouldNotRemoveCardFromPileWithIncorrectPostVariable(){
        //prepare condition for removing cow.png
        $_SESSION[$this->session_card] = 'cow.png';
        $_POST[$this->post_card] = 'donkey.png';
        $newGameRequest = false;

        $view = $this->fakeGameView($newGameRequest);
        $pile = $this->fakePileWithReturnValue();
        
        $sut = new GameController();

        $actual = $sut->runGame($view, $pile);
        $expected = join($this->cards);
        
        $this->assertEquals($expected, $actual);
    }

    public function test_runGame_shouldDisplayAllCards(){
        session_unset();
        $newGameRequest = false;
        
        $view = $this->fakeGameView($newGameRequest);
        $pile = $this->fakePileWithReturnValue();
        $sut = new GameController();

        $actual = $sut->runGame($view, $pile);
        $expected = join($this->cards);
        
        $this->assertEquals($expected, $actual);
    }

    public function test_runGame_shouldNotRemoveCardWithoutPostRequest(){
        $_SESSION[$this->session_card] = 'cow.png';
        $_POST = array();
        $newGameRequest = false;
        
        $view = $this->fakeGameView($newGameRequest);
        $pile = $this->fakePileWithReturnValue();
        $sut = new GameController();

        $actual = $sut->runGame($view, $pile);
        $expected = join($this->cards);
        
        $this->assertEquals($expected, $actual);
    }

    private function fakeGameView($newGameRequest){
        $fake = \Mockery::mock('iGameView', [
            'getClickedImageName' => 'cow.png',
            'displayOptions' => 'Display Options',
            'newGameRequest' => $newGameRequest,
            'cardClicked' => true
        ]);

        $fake   
            ->shouldReceive('displayGame')
            ->with(\Mockery::type('array'))
            ->andReturnUsing(function(array $cards){
                return join($cards);
            });
            /*->shouldReceive('cardClicked')
            ->andReturnUsing(function(){
                isset($_POST['clicked_image']);
            });*/

        return $fake;
    }

    private function fakePile(){
        $fake = \Mockery::mock('Pile');
        return $fake;
    }

    private function fakePileWithReturnValue(){
        $fake = $this->fakePile();
        $fake->shouldReceive('getPile')->andReturn($this->cards);
        return $fake;
    }

    public function tearDown() {
        \Mockery::close();
    }
}
