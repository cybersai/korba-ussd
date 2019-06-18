<?php


namespace Korba;


class DataMenu extends View
{
    public static $data = [
        'airteltigo',
        'busy',
        'glo',
        'mtn',
        'mtn_fibre',
        'surfline'
    ];

    public static $data_human = [
        'airteltigo' => 'AirtelTigo',
        'busy' => 'Busy',
        'glo' => 'Glo',
        'mtn' => 'MTN',
        'mtn_fibre' => 'MTN turbonet/fibre',
        'surfline' => 'Surfline'
    ];

    public function __construct()
    {
        $content = "Data Bundles\n";
        $next = 'korba_data_num';
        $data_list = ['AirtelTigo', 'Busy', 'Glo', 'MTN Mobile', 'MTN Turbonet/Fibre', 'Surfline'];
        parent::__construct($content, $next, 1, 6, $data_list);
    }
}
