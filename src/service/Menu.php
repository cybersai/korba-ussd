<?php


namespace Korba;


class Menu extends View
{
    public function __construct($ft = true, $airtime = true, $data = true, $tv = true, $util = true)
    {
        $list = [];
        if ($ft) {
            array_push($list, "Funds Transfer");
        }
        if ($airtime) {
            array_push($list, "Airtime Topup");
        }
        if ($data) {
            array_push($list, "Data Bundles");
        }
        if ($tv) {
            array_push($list, "TV Bills");
        }
        if ($util) {
            array_push($list, "Utilities");
        }
        $content = "Services\nPlease select";
        $next = "sub_menu";
        parent::__construct($content, $next, 1, 6, $list);
    }
}