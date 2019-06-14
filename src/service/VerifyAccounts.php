<?php


namespace Korba;


abstract class VerifyAccounts extends Worker implements UserAccount
{
    protected $views;
    public function __construct($next)
    {
        $views = [new Accounts($next), new Error('Could not get accounts')];
        $this->views = $views;
        parent::__construct($views);
    }
}