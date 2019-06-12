<?php


namespace Korba;


class AirtimeNumber extends View
{
    public function __construct()
    {
        $content = "Enter recipient number";
        $next = 'korba_airtime_num_confirm';
        parent::__construct($content, $next);
    }
}