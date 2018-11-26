<?php
use PHPUnit\Framework\TestCase;
require_once("./src/view/GameView.php");
require_once("./src/model/Pile.php");
require_once("./src/model/FileReader.php");


class GameViewTest extends TestCase
{
    //use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
    private $cards = array("cow.png","chicken.png", "sheep.png", "fish.png");

    public function test_displayGame_shouldReturnHtmlTemplateWithValidCssTag(){
        $regexArray = array('/link rel="stylesheet" type="text\/css" href="public\/css\/stylesheet.css"/');
        $this->displayGame_matchRegex($regexArray);
    }
    
    
    public function test_displayGame_imagesShouldContainValidImagePath(){
        $regexArray = array();
        foreach($this->cards as $c){
            array_push($regexArray, '/img src="public\/images\/' . $c ."/");
        }

        $this->displayGame_matchRegex($regexArray);
    }

    private function displayGame_matchRegex(Array $regexArray){
        $sut = new GameView();
        $html = $sut->displayGame($this->cards);
        
        foreach($regexArray as $regex){
            $this->assertRegexp($regex, $html);
        }
    }


}


