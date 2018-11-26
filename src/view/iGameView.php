<?php

interface iGameView
{
    public function __construct(Array $cards);
    public function displayGame();
}