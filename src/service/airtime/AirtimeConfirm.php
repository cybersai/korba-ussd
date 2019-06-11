<?php


namespace Korba;


class AirtimeConfirm extends View
{
    public function __construct($content, $next)
    {
        $content = "Confirm\nProvider:Airtime\n";
        $next = "airtime_source";
        parent::__construct($content, $next, $page, $number_per_page, $iterable_list, $iterator, $end);
    }
}