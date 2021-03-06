<?php
use PHPUnit\Framework\TestCase;
require_once("./src/view/GameView.php");
require_once("./src/model/Pile.php");
require_once("./src/model/FileReader.php");


class GameViewTest extends TestCase
{
    //use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
    private $cards = array("cow.png","chicken.png", "sheep.png", "fish.png");
    private $cardClicked = 'clicked_image';
    private $newGameRequest = 'new_game_request';
    
    private function sut(){
        return new GameView($this->cards);
    }
    
    public function test_displayGameOptions_shouldReturnHiddenElementsWithOptions(){
        $regexArray = array('#<input type="hidden" name="game_option" value="8">#', '#<input type="hidden" name="game_option" value="10">#', '#<input type="hidden" name="game_option" value="12">#');
        $this->displayGameOptions_matchRegex($regexArray);
    } 

    public function test_displayGameOptions_shouldReturnButtonElementsWithOptions(){
        $regexArray = array('#<input type="button" name="game_option" value="8 brickor">#', '#<input type="button" name="game_option" value="10 brickor">#', '#<input type="button" name="game_option" value="12 brickor">#');
        $this->displayGameOptions_matchRegex($regexArray);
    } 

    public function test_displayGameOptions_shouldReturnFormElements(){
        $regexArray = array('#<form method="post">#', '#</form>#');
        $this->displaygameOptions_matchRegex($regexArray);
    }

    public function test_displayGame_shouldReturnHtmlTemplateWithValidCssTag(){
        $regexArray = array('#<link rel="stylesheet" type="text/css" href="public/css/stylesheet.css">#');
        $this->displayGame_matchRegex($regexArray);
    }

    public function test_displayGame_shouldReturnHtmlTemplateWithValidDocumentTags(){
        $regexArray = array('#<!DOCTYPE html>#', '#<head>#', '#</head>#', '#<body>#', '#</body>#', '#<title>#', '#</title>#');
        $this->displayGame_matchRegex($regexArray);
    }
    
    public function test_displayGame_shouldReturnForm(){
        $regexArray = array('#<form method="post">#', '#</form>#');
        $this->displayGame_matchRegex($regexArray);
    }
    
    public function test_displayGame_imageFormShouldContainValidImageInputTag(){
        $regexArray = array();
        foreach($this->cards as $c){
            array_push($regexArray, '#<input type="image" src="public/images/' . $c .'">#');
        }

        $this->displayGame_matchRegex($regexArray);
    }

    public function test_displayGame_imageFormShouldContainHiddenInputTag(){
        $regexArray = array();
        foreach($this->cards as $c){
            array_push($regexArray, '#<input type="hidden" name="clicked_image" value="'.$c.'">#');
        }

        $this->displayGame_matchRegex($regexArray);
    }

    public function test_displayGame_shouldContainNewGameButton(){
        $regexArray = array('#<input type="hidden" name="new_game_request" value="new_game_request">#',
        '#<button type="submit">start new game!</button>#',
        '#<form method="post">#', '#</form>#');

        $this->displayGame_matchRegex($regexArray);
    }

    public function test_getClickedImageName_shouldReturnCowPng(){
        $this->getClickedImageName_testPostValue('cow.png');
    }

    public function test_getClickedImageName_shouldReturnSheepPng(){
        $this->getClickedImageName_testPostValue('sheep.png');
    }

    private function getClickedImageName_testPostValue($value){
        $sut = new GameView();
        $this->setPost($value);
        $this->assertSame($value, $sut->getClickedImageName());
    }

    private function displayGame_matchRegex(Array $regexArray){
        $sut = new GameView();
        $html = $sut->displayGame($this->cards);
        
        foreach($regexArray as $regex){
            $this->assertRegexp($regex, $html);
        }
    }

    private function displaygameOptions_matchRegex(Array $regexArray){
        $sut = new GameView();
        $html = $sut->displayGameOptions();
        
        foreach($regexArray as $regex){
            $this->assertRegexp($regex, $html);
        }
    }

    public function test_cardClicked_shouldReturnTrue(){
        $this->setPost('cow.png');
        $sut = new GameView();
        $cardClicked = $sut->cardClicked();
        $this->assertTrue($cardClicked);
    }

    public function test_cardClicked_shouldReturnFalse(){
        if(isset($_POST[$this->cardClicked])){
            unset($_POST[$this->cardClicked]);
        }

        $sut = new GameView();
        $cardClicked = $sut->cardClicked();
        $this->assertFalse($cardClicked);
    }

    private function setPost($value){
        $_POST[$this->cardClicked] = $value;
    }

    public function test_newGameRequest_shouldReturnTrueIfNewGamePost(){
        $_POST[$this->newGameRequest] = true;

        $sut = new GameView();
        $this->assertTrue($sut->newGameRequest());
    }

    public function test_newGameRequest_shouldReturnFalseNoPost(){
        $_POST = array();
        $sut = new GameView();
        $this->assertFalse($sut->newGameRequest());
    }

}


