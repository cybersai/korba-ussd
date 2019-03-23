<?php

namespace Korba;


class Menu extends View
{
    public function __construct()
    {
        $content = "Korba\nOur lives simplified";
        $next = "specific_menu";
        $page = 1;
        $number_per_page = 7;
        $iterable_list = [
            'Funds Transfer',
            'Airtime',
            'Bundles',
            'Utilities'
        ];

        parent::__construct($content, $next, $page, $number_per_page, $iterable_list);
    }
}
