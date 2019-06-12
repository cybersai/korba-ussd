<?php


namespace Korba;


class AirtimeNetNum extends ViewGroup
{
    public function __construct()
    {
        $views = [new AirtimeNetwork(), new Amount('korba_airtime_confirmation')];
        parent::__construct($views);
    }
}