<?php


namespace Korba;


class Sub extends View
{
    public function __construct($page, $target, $ft = true, $airtime = true, $data = true, $tv = true, $util = true)
    {
        $content = [];
        $next = [];

        $funds_list = ['Bank', 'Mobile Wallet'];
        $airtime_list = ["Own network", "Other network"];
        $data_list = ['AirtelTigo', 'Busy', 'Glo', 'MTN Mobile', 'MTN Turbonet/Fibre', 'Surfline'];
        $tv_list = ['DSTV', 'KweseTv', 'GoTV'];
        $util_list = ['ECG', 'GWCL'];

        $funds_content = "Funds Transfer\nSelect Destination".self::arrayToList($target, 2, $funds_list);
        $airtime_content = "Airtime Topup\n".self::arrayToList($target, 2, $airtime_list);
        $data_content = "Data Bundles\n".self::arrayToList($target, 6, $data_list);
        $tv_content = "Tv Bills\n".self::arrayToList($target, 3, $tv_list);
        $util_content = "Utilities\n".self::arrayToList($target, 2, $util_list);
        if ($ft) {
            array_push($content, $funds_content);
            array_push($next, '');
        }
        if ($airtime) {
            array_push($content, $airtime_content);
            array_push($next, 'airtime_net_num');
        }
        if ($data) {
            array_push($content, $data_content);
            array_push($next, '');
        }
        if ($tv) {
            array_push($content, $tv_content);
            array_push($next, '');
        }
        if ($util) {
            array_push($content, $util_content);
            array_push($next, '');
        }
        parent::__construct($content, $next, $page);
    }
}