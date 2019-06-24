<?php


namespace Korba;


class UtilMenu extends View
{

    public static $util = [
        'ecg',
        'gwcl'
    ];


    public static $util_human = [
        'ecg' => 'ECG',
        'gwcl' => 'Ghana Water'
    ];

    public function __construct()
    {
        $content = "Utilities\n";
        $next = 'korba_util_num';
        $util_list = ['ECG', 'GWCL'];
        parent::__construct($content, $next, 1, 2, $util_list);
    }
}
