<?php


namespace Korba;


class SubMenu extends ViewGroup
{
    /**
     * SubMenu constructor.
     * @param bool $ft
     * @param bool $airtime
     * @param bool $data
     * @param bool $tv
     * @param bool $util
     */
    public function __construct($ft, $airtime, $data, $tv, $util)
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