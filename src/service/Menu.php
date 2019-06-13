<?php


namespace Korba;


class Menu extends View implements Manipulator
{
    private $type;
    /**
     * Menu constructor.
     * @param string $type
     * @param bool $ft
     * @param bool $airtime
     * @param bool $data
     * @param bool $tv
     * @param bool $util
     */
    public function __construct($type, $ft, $airtime, $data, $tv, $util)
    {
        $this->type = $type;
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
        $next = "korba_sub_menu";
        parent::__construct($content, $next, 1, 6, $list);
    }

    public function manipulate(&$tracker, $input)
    {
        if ($this->type == 'registered') {
            $tracker->authorization = 'registered';
        } else {
            $tracker->authorization = 'non-registered';
        }
    }
}