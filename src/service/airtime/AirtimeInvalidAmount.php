<?php


namespace Korba;


class AirtimeInvalidAmount extends View
{
    public function __construct()
    {
        $content = "Invalid Amount Entered";
        $next = 'end';
        parent::__construct($content, $next);
    }
}