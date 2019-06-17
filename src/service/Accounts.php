<?php


namespace Korba;


class Accounts extends View
{
    public function __construct($next, $page, $accounts_list, $iterator, $number_per_page = 4)
    {
        $content = "Select Account";
        parent::__construct($content, $next, $page, $number_per_page,$accounts_list,  $iterator);
    }
}
