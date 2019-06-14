<?php


namespace Korba;


class AirtimeAccMomoError extends ViewGroup
{

    /**
     * AirtimeAccMomo constructor.
     * @param UserAccount $verify_accounts
     */
    public function __construct()
    {
        $views = [ new Error('Accounts not found'), new AirtimeThanks()];
        parent::__construct($views);
    }
}