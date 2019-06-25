<?php


namespace Korba;


class AirtimeMenu extends View
{
    public function __construct()
    {
        $content = "Airtime Topup\n";
        $next = 'korba_airtime_net_num';
        $airtime_list = ["Own number", "Another number"];
        parent::__construct($content, $next, 1, 2, $airtime_list);
    }
}
