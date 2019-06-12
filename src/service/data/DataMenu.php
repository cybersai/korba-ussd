<?php


namespace Korba;


class DataMenu extends View
{
    public function __construct()
    {
        $content = "Data Bundles\n";
        $next = 'data_num';
        $data_list = ['AirtelTigo', 'Busy', 'Glo', 'MTN Mobile', 'MTN Turbonet/Fibre', 'Surfline'];
        parent::__construct($content, $next, 1, 6, $data_list);
    }
}