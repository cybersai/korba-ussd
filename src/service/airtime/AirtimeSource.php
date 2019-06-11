<?php


namespace Korba;


class AirtimeSource extends View
{
    public function __construct()
    {
        $list = [
            'Account',
            'Mobile Wallet'
        ];
        $content = "Pay From\n".self::arrayToList(1, 2, $list);
        $next = 'airtime_confirm';
        parent::__construct($content, $next);
    }
}