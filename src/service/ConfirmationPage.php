<?php


namespace Korba;


class ConfirmationPage extends View
{
    public function __construct($next, $provider, $account, $amount, $fee = 0)
    {
        $content = "Confirm\nProvider:{$provider}\nAccount:{$account}\nAmount:{$amount}\nFee:{$fee}\nTotal:{($amount + $fee)}";
        parent::__construct($content, strtoupper($next));
    }
}