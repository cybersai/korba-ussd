<?php


namespace Korba;


class ConfirmationPage extends View
{
    public function __construct($next, $provider, $account, $amount, $fee = 0)
    {
        $total = $amount + $fee;
        $content = "Confirm\nProvider:{$provider}\nAccount:{$account}\nAmount:{$amount}\nFee:{$fee}\nTotal:{$total}";
        parent::__construct($content, strtoupper($next));
    }

    public function setAll($provider, $account, $amount, $fee = 0) {
        $total = $amount + $fee;
        $this->setContent("Confirm\nProvider:{$provider}\nAccount:{$account}\nAmount:{$amount}\nFee:{$fee}\nTotal:{$total}");
    }
}