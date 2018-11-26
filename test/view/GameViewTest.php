<?php
use PHPUnit\Framework\TestCase;
require_once("./src/view/GameView.php");
require_once("./src/model/Pile.php");
require_once("./src/model/FileReader.php");


class GameViewTest extends TestCase
{
    //use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
    private $cards = array("cow.png","chicken.png", "sheep.png", "fish.png");

    public function test_displayCards_imagesShouldContainValidImagePath(){
        $regexArray = array();
        foreach($this->cards as $c){
            array_push($regexArray, '/img src="public\/images\/' . $c ."/");
        }

        $this->displayCards_matchRegexEachCard($regexArray);
    }

    private function displayCards_matchRegexEachCard(Array $regexArray){
        $sut = new GameView();
        $html = $sut->displayCards($this->cards);
        
        foreach($regexArray as $regex){
            $this->assertRegexp($regex, $html);
        }
    }
}


