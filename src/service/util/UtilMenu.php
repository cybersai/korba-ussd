<?php


namespace Korba;


class UtilMenu extends View
{
    public function __construct()
    {
        $content = "Utilities\n";
        $next = 'util_num';
        $util_list = ['ECG', 'GWCL'];
        parent::__construct($content, $next, 1, 2, $util_list);
    }
}