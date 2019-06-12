<?php


namespace Korba;


class Amount extends View
{

    /**
     * Amount constructor.
     */
    public function __construct($next)
    {
        $content = "Enter Amount";
        parent::__construct($content, $next);
    }
}