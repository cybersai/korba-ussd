<?php


namespace Korba;


class AirtimeNetNum extends View
{
    public function __construct($page)
    {
        $network = [
            'AirtelTigo',
            'Glo',
            'MTN',
            'Vodafone'
        ];
        $content = [
            "Enter Amount",
            "Other Number\nSelect Network\n".self::arrayToList(1, 4, $network),
        ];
        $next = [
            'airtime_source',
            'airtime_num'
        ];
        parent::__construct($content, $next, $page);
    }
}