<?php


namespace Korba;


class Pin extends View
{
    public function __construct($next)
    {
        $content = "Please enter pin";
        parent::__construct($content, $next);
    }
}