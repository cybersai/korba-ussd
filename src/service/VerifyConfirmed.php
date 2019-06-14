<?php


namespace Korba;


class VerifyConfirmed extends Worker
{

    public function __construct($views)
    {
        parent::__construct($views);
    }

    public function process(&$tracker, $input)
    {
        if ($input == '1') {
            $this->setView($this->getView(1));
        } else {
            $this->setView($this->getView(2));
        }
    }
}