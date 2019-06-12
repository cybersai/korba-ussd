<?php


namespace Korba;


class AirtimeAmount extends Amount implements Manipulator
{
    public function __construct()
    {
        $next = 'korba_airtime_confirmation';
        parent::__construct($next);
    }

    public function manipulate(&$tracker, $input)
    {
        if ($tracker->type = 'own') {
            if ($this->getNext() != $input) {
                $this->setNext('end');
            }
        }
    }


}