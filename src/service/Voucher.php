<?php


namespace Korba;


class Voucher extends View
{
    public function __construct($next)
    {
        $content = "Please enter your voucher code";
        parent::__construct($content, strtoupper($next));
    }
}