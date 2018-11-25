<?php

require_once('src/view/GameView.php');
require_once('src/model/Pile.php');
require_once('src/model/FileReader.php');

$fr = new FileReader();
$pile = new Pile(4);
$gameView = new GameView($pile->getPile($fr));

echo $gameView->displayPile();