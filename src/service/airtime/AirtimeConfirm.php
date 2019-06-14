<?php


namespace Korba;


class AirtimeConfirm extends Confirm implements Manipulator
{
    public function __construct()
    {
        $slug = 'recipient';
        $next = 'korba_airtime_amount';
        parent::__construct($next, $slug);
    }

    public function manipulate(&$tracker, $input)
    {
        $payload = json_decode($tracker->payload, true);
        $tracker->payload = json_encode(array_merge(
            $payload,
            ['number' => Util::numberGHFormat($input)]
        ));
        $this->setAll($input);
    }

}