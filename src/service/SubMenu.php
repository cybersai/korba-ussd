<?php


namespace Korba;


class SubMenu extends ViewGroup
{
    public function __construct($ft = true, $airtime = true, $data = true, $tv = true, $util = true)
    {
        $views = [

        ];
        if ($ft) {
            array_push($views, new FundMenu());
        }
        if ($airtime) {
            array_push($views, new AirtimeMenu());
        }
        if ($data) {
            array_push($views, new DataMenu());
        }
        if ($tv) {
            array_push($views, new TvMenu());
        }
        if ($util) {
            array_push($views, new UtilMenu());
        }
        parent::__construct($views);
    }
}