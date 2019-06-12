<?php


namespace Korba;


class Amount extends View
{
    public function __construct($next)
    {
        $content = "Enter Amount";
        parent::__construct($content, $next);
    }
}