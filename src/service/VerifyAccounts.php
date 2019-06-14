<?php


namespace Korba;


abstract class VerifyAccounts extends Worker implements UserAccount
{
    protected $views;
    public function __construct()
    {
        $views = [new Accounts('korba_airtime_pin'), new Error('Could not get accounts')];
        $this->views = $views;
        parent::__construct($views);
    }
}