<?php


namespace Korba;


class TvMenu extends View
{

    public static $tv = [
        'dstv',
        'kwesetv',
        'gotv'
    ];


    public static $tv_human = [
        'dstv' => 'DSTV',
        'kwesetv' => 'KWESE TV',
        'gotv' => 'GOTV'
    ];

    public function __construct()
    {
        $content = "Tv Bills\n";
        $next = 'korba_tv_num';
        $tv_list = ['DSTV', 'KweseTv', 'GoTV'];
        parent::__construct($content, $next, 1, 3, $tv_list);
    }
}
