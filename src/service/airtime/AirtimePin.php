<?php


namespace Korba;


class AirtimePin extends Pin implements Manipulator
{
    public function __construct()
    {
        $next = 'korba_airtime_auth';
        parent::__construct($next);
    }

    public function manipulate(&$tracker, $input)
    {
        // TODO: Implement manipulate() method.
    }


}