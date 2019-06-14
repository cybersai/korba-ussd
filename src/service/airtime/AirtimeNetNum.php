<?php


namespace Korba;


class AirtimeNetNum extends ViewGroup
{
    public function __construct()
    {
        $views = [new Amount('korba_airtime_confirmation'), new AirtimeNetwork()];
        parent::__construct($views);
    }
}