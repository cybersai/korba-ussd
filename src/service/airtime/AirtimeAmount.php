<?php


namespace Korba;


class AirtimeAmount extends Amount
{
    public function __construct()
    {
        $next = 'korba_airtime_confirmation';
        parent::__construct($next);
    }
}