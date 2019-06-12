<?php


namespace Korba;


class TvMenu extends View
{
    public function __construct()
    {
        $content = "Tv Bills\n";
        $next = 'korba_tv_num';
        $tv_list = ['DSTV', 'KweseTv', 'GoTV'];
        parent::__construct($content, $next, 1, 3, $tv_list);
    }
}