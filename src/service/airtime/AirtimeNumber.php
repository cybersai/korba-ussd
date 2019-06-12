<?php


namespace Korba;


class AirtimeNumber extends View implements Manipulator
{
    public function __construct()
    {
        $content = "Enter recipient number";
        $next = 'korba_airtime_num_confirm';
        parent::__construct($content, $next);
    }

    public function manipulate(&$tracker, $input)
    {
        $network = AirtimeNetwork::$network[$input - 1];
        $tracker->payload = json_encode(['network' => $network]);
    }


}