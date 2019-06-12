<?php


namespace Korba;


class SubMenu extends ViewGroup
{
    public function __construct($ft = true, $airtime = true, $data = true, $tv = true, $util = true)
    {
        $views = [

        ];
        if ($ft) {
            array_push($content, new FundMenu());
        }
        if ($airtime) {
            array_push($content, new AirtimeMenu());
        }
        if ($data) {
            array_push($content, new DataMenu());
        }
        if ($tv) {
            array_push($content, new TvMenu());
        }
        if ($util) {
            array_push($content, new UtilMenu());
        }
        parent::__construct($views);
    }
}