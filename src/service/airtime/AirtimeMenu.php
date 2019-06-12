<?php


namespace Korba;


class AirtimeMenu extends View
{
    public function __construct()
    {
        $content = "Airtime Topup\n";
        $next = 'airtime_net_num';
        $airtime_list = ["Own network", "Other network"];
        parent::__construct($content, $next, 1, 2, $airtime_list);
    }
}