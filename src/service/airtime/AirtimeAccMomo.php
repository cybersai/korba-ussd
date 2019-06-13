<?php


namespace Korba;


class AirtimeAccMomo extends ViewGroup
{

    public function __construct($verify_accounts, $next)
    {
        $views = [ $verify_accounts($next), new AirtimeThanks()];
        parent::__construct($views);
    }
}