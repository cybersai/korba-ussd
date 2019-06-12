<?php


namespace Korba;


class AirtimeNetwork extends View
{
    public function __construct($page)
    {
        $network = [
            'AirtelTigo',
            'Glo',
            'MTN',
            'Vodafone'
        ];
        $content = "Other Number\nSelect Network";
        $next = 'airtime_num';
        parent::__construct($content, $next, 1, 4, $network);
    }
}