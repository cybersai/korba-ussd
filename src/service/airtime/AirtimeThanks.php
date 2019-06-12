<?php


namespace Korba;


class AirtimeThanks extends Thanks implements Manipulator
{
    public function __construct($network = "INF", $success = false)
    {
        parent::__construct($network, $success);
    }

    public function manipulate(&$tracker, $input)
    {
        if ($input) { // verify pin

        }
    }


}