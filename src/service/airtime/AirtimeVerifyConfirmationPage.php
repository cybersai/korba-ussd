<?php


namespace Korba;


class AirtimeVerifyConfirmationPage extends Worker
{
    public function __construct()
    {
        $views = [new AirtimePayFrom(), ];
    }
}