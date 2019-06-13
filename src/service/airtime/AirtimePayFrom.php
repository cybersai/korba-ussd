<?php


namespace Korba;


class AirtimePayFrom extends PayFrom
{
    public function __construct()
    {
        $next = 'korba_airtime_acc_momo';
        parent::__construct($next);
    }
}