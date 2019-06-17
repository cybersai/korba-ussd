<?php


namespace Korba;


class AirtimeConfirmationPage extends ConfirmationPage
{
    public function __construct($next = 'korba_airtime_auth', $provider = '', $account = '', $amount = 0, $fee = 0)
    {
        parent::__construct($next, $provider, $account, $amount, $fee);
    }
}
