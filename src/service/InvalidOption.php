<?php


namespace Korba;


class InvalidOption extends View
{
    public function __construct()
    {
        $content = "The input entered is invalid";
        $next = 'invalid';
        parent::__construct($content, $next);
    }
}
