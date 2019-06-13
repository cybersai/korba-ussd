<?php


namespace Korba;


class Error extends View
{
    public function __construct($content = "Invalid input selected")
    {
        $next = 'end';
        parent::__construct($content, $next);
    }
}