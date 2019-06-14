<?php


namespace Korba;


class AirtimeThanks extends Thanks
{
    public function __construct($network = "INF", $success = false)
    {
        parent::__construct($network, $success);
    }
}