<?php
use PHPUnit\Framework\TestCase;
require_once("./src/view/GameView.php");
require_once("./src/model/Pile.php");
require_once("./src/model/FileReader.php");


class GameViewTest extends TestCase
{
    //use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
    
    public function test_displayCards_shoulReturnHtmlWithArrayElements(){
        $cards = array("cow.png","chicken.png", "sheep.png", "fish.png");
        
        $sut = new GameView();         
        $html = $sut->displayCards($cards);

        foreach($cards as $c){
            $this->assertRegexp('/'.$c.'/', $html);
        }
    }

    public function test_displayCards_shouldReturnValidImagePath(){
        $cards = array("cow.png","chicken.png", "sheep.png", "fish.png");

        $sut = new GameView();
        $html = $sut->displayCards($cards);

        foreach($cards as $c){
            $this->assertRegexp('/src="public\/images\/'. $c .'/', $html);
        }
    }
}


