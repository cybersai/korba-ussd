<?php


namespace Korba;


class Accounts extends View
{
    public function __construct($next)
    {
        $content = "Select Account";
        parent::__construct($content, $next, $page = 1, $number_per_page = 4);
    }

    public function setAll($page, $iterable_list, $iterator = null, $number_per_page = 4) {
        $this->setPage($page);
        $this->setIterableList($iterable_list);
        $this->setIterator($iterator);
        $this->setNumberPerPage($number_per_page);
    }
}