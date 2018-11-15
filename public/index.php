<?php
require_once("../model/Card.php");

$card = new Card("some-id");

echo $card->getId();