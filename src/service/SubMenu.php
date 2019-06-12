<?php


namespace Korba;


class SubMenu extends ViewGroup
{
    public function __construct($ft = true, $airtime = true, $data = true, $tv = true, $util = true)
    {
        $views = [

        ];
        if ($ft) {
            array_push($content, $funds_content);
        }
        if ($airtime) {
            array_push($content, $airtime_content);
        }
        if ($data) {
            array_push($content, $data_content);
        }
        if ($tv) {
            array_push($content, $tv_content);
        }
        if ($util) {
            array_push($content, $util_content);
        }
        parent::__construct($views);
    }
}