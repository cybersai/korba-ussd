<?php


namespace Korba;


abstract class VerifyAccounts extends Worker implements UserAccount
{
    public function __construct($next)
    {
        $views = [new Accounts($next), new Error('Could not get accounts')];
        parent::__construct($views);
    }
}