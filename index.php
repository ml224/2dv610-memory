<?php

require_once('src/view/GameView.php');
require_once('src/model/Pile.php');
require_once('src/model/FileReader.php');
require_once('src/controller/GameController.php');

$pile = new Pile(4);
$gameView = new GameView();
$controller = new GameController();
echo $controller->runGame($pile, $gameView);