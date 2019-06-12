<?php


namespace Korba;


class FundMenu extends View
{
    public function __construct()
    {
        $content = "Funds Transfer\n";
        $next = 'korba_fund_num';
        $funds_list = ['Bank', 'Mobile Wallet'];
        parent::__construct($content, $next, 1, 2, $funds_list);
    }
}