<?php


namespace Korba;


class AirtimeAccMomo extends ViewGroup
{

    /**
     * AirtimeAccMomo constructor.
     * @param UserAccount $verify_accounts
     */
    public function __construct()
    {
        $next = 'korba_airtime_pin';
        $views = [ new Accounts($next), new AirtimeThanks()];
        parent::__construct($views);
    }
}