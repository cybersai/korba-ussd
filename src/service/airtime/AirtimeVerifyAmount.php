<?php


namespace Korba;


class AirtimeVerifyAmount extends Worker
{
    public function __construct($accounts_worker)
    {
        $confirmation_page =  $accounts_worker ? new AirtimeConfirmationPage('korba_airtime_pay') : new AirtimeConfirmationPage();
        $views = [$confirmation_page, new AirtimeInvalidAmount()];
    }

    public function process(&$tracker, $input)
    {
        if (Util::verifyAmount($input)) {
            $this->setView($this->getView(1));
        } else {
            $this->setView($this->getView(2));
        }
    }
}