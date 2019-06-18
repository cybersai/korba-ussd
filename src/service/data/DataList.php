<?php


namespace Korba;


class DataList extends View
{
    public function __construct($next, $type, $page, $accounts_list, $iterator, $number_per_page = 4)
    {
        $type = ucfirst($type);
        $content = "{$type} Data \nSelect an option";
        parent::__construct($content, $next, $page, $number_per_page,$accounts_list,  $iterator);
    }
}
