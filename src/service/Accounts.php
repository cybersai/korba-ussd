<?php


namespace Korba;


class Accounts extends View
{
    public function __construct($next, $page, $iterable_list, $iterator = null, $number_per_page = 4)
    {
        $content = "Select Account";
        parent::__construct($content, $next, $page, $number_per_page, $iterable_list, $iterator);
    }
}