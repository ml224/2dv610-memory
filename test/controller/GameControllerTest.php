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
       $this->displayGame_removeFromPile('cow.png');
    }
    
    public function test_runGame_shouldRemoveFishFromPile(){
       $this->displayGame_removeFromPile('fish.png');
    }

    private function displayGame_removeFromPile($toBeRemoved){
        $returnValue = array_diff($this->cards, array($toBeRemoved));
        
        //prepping state
        $_SESSION[$this->session_card] = $toBeRemoved;
        $_POST[$this->post_card] = $toBeRemoved;
        $newGameRequest = false;
        

        $view = $this->fakeGameView($newGameRequest);
        $pile = \Mockery::mock('Pile');
        $pile->shouldReceive('removeFromPile')->once();
        $pile->shouldReceive('getPile')->andReturn($returnValue);
        $sut = new GameController();

        $actual = $sut->runGame($view, $pile);
        $expected = join($pile->getPile());
        
        $this->assertEquals($expected, $actual);
    }

    public function test_runGame_shouldNotRemoveFromPileWithIncorrectPostVariable(){
        //prepare condition for removing cow.png
        $_SESSION[$this->session_card] = 'cow.png';
        $_POST[$this->post_card] = 'donkey.png';
        $newGameRequest = false;

        $view = $this->fakeGameView($newGameRequest);
        $pile = $this->fakePile();
        
        $sut = new GameController();

        $actual = $sut->runGame($view, $pile);
        $expected = join($this->cards);
        
        $this->assertEquals($expected, $actual);
    }

    public function test_runGame_shouldDisplayAllCardsWhenNoSessionSet(){
        session_unset();
        $newGameRequest = false;
        
        $view = $this->fakeGameView($newGameRequest);
        $pile = $this->fakePile();
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
        $pile = $this->fakePile();
        $sut = new GameController();

        $actual = $sut->runGame($view, $pile);
        $expected = join($this->cards);
        
        $this->assertEquals($expected, $actual);
    }

    private function fakeGameView($newGameRequest){
        $fake = \Mockery::mock('iGameView', [
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
            
        $fake 
        ->shouldReceive('cardClicked')
            ->andReturnUsing(function(){
                isset($_POST[$this->post_card]);
            });

        if(isset($_POST[$this->post_card])){
            $fake->shouldReceive('getClickedImageName')->andReturn($_POST[$this->post_card]);
        }

        return $fake;
    }

    private function fakePile(){
        $fake = \Mockery::mock('Pile');        
        $fake->shouldReceive('getPile')->andReturn($this->cards);
        return $fake;
    }

    public function tearDown() {
        \Mockery::close();
    }
}
