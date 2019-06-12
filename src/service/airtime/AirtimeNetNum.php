<?php


namespace Korba;


class AirtimeNetNum extends ViewGroup
{
    public function __construct()
    {
        $views = [new AirtimeNetwork(), new AirtimeNumber()];
        parent::__construct($views);
    }
}