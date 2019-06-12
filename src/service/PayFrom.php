<?php


namespace Korba;


class PayFrom extends View
{
    public function __construct($next)
    {
        $content = "Pay From";
        $list = ['Account', 'Mobile Wallet'];
        parent::__construct($content, $next, 1, 2, $list);
    }
}