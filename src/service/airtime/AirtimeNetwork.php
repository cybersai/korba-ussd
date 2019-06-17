<?php


namespace Korba;


class AirtimeNetwork extends View
{
    public static $network = [
        'AIR',
        'GLO',
        'MTN',
        'VOD'
    ];

    public static $human_network = [
        'AIR' => 'AirtelTigo',
        'GLO' => 'Glo',
        'MTN' => 'MTN',
        'TIG' => 'AirtelTigo',
        'VOD' => 'Vodafone'
    ];

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
}
