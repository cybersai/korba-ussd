<?php


namespace Korba;


class AirtimeNetwork extends View implements Manipulator
{
    public function __construct()
    {
        $network = [
            'AirtelTigo',
            'Glo',
            'MTN',
            'Vodafone'
        ];
        $content = "Other Number\nSelect Network";
        $next = 'korba_airtime_num';
        parent::__construct($content, $next, 1, 4, $network);
    }

    public function manipulate(&$tracker)
    {
        $tracker->type = 'own';
    }
}