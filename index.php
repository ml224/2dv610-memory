<?php

require_once('src/view/GameView.php');
require_once('src/model/Pile.php');
require_once('src/model/FileReader.php');
require_once('src/controller/GameController.php');

$reader = new FileReader(); 
$pile = new Pile($reader->getImages(4));
$gameView = new GameView();
$controller = new GameController();
echo $controller->runGame($gameView, $pile);