<?php


namespace Korba;


class Confirm extends View
{
    public function __construct($next, $slug = "account")
    {
        $content = "Confirm {$slug} Number";
        parent::__construct($content, $next);
    }
}