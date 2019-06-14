<?php


namespace Korba;


abstract class VerifyPayment extends Worker
{
    protected $views;
    public function __construct()
    {
        $views = [new Thanks(), new Error('Payment was not successful')];
        $this->views = $views;
        parent::__construct($views);
    }
}