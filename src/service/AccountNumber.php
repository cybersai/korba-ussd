<?php


namespace Korba;


class AccountNumber extends View
{
    public function __construct($next, $slug = 'account')
    {
        $content = "Enter {$slug} number";
        parent::__construct($content, $next);
    }
}
