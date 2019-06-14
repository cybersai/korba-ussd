<?php


namespace Korba;


class AirtimePin extends Pin implements Manipulator
{
    private $accounts_worker;

    public function __construct($accounts_worker)
    {
        $next = 'korba_airtime_auth';
        $this->accounts_worker = $accounts_worker;
        parent::__construct($next);
    }

    public function manipulate(&$tracker, $input)
    {
        $tracker->account_number = json_encode(call_user_func(array($this->accounts_worker, 'getAccount'), array($tracker->phone_number, $input)));
    }
}