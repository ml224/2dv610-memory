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

    public function test_displayGame_shouldReturnHtmlTemplateWithValidDocumentTags(){
        $regexArray = array('/!DOCTYPE html/', '/head/', '/\/head/', '/body/', '/\/body/', '/title/', '/\/title/');
        $this->displayGame_matchRegex($regexArray);
    }
    
    public function test_displayGame_shouldReturnForm(){
        $regexArray = array('/form method="post"/', '/\/form/');
        $this->displayGame_matchRegex($regexArray);
    }
    
    public function test_displayGame_imageInputShouldContainValidImagePath(){
        $regexArray = array();
        foreach($this->cards as $c){
            array_push($regexArray, '/input type="image" src="public\/images\/' . $c ."/");
        }

        $this->displayGame_matchRegex($regexArray);
    }

    public function test_getClickedImageName_shouldReturnStringOnPost(){
        $sut = new GameView($this->cards);
        $_POST['clicked_image'] = 'cow.png';
        $this->assertSame('cow.png', $sut->getClickedImageName());

    }

    private function displayGame_matchRegex(Array $regexArray){
        $sut = new GameView($this->cards);
        $html = $sut->displayGame();
        
        foreach($regexArray as $regex){
            $this->assertRegexp($regex, $html);
        }
    }



}


