<?php


namespace Korba;


class AirtimeNumber extends View
{
    public function __construct()
    {
        $content = "Enter recipient number";
        $next = 'airtime__num_confirm';
        parent::__construct($content, $next);
    }
}