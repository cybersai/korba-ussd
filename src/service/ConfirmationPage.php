<?php


namespace Korba;


class ConfirmationPage extends View
{
    public function __construct($next, $provider, $account, $amount, $fee = 0)
    {
        $total = $amount + $fee;
        $content = "Confirm\nProvider:{$provider}\nAccount:{$account}\nAmount:{$amount}\nFee:{$fee}\nTotal:{$total}";
        parent::__construct($content, $next,1,null,null,null,"1.Ok\n#.Back");
    }
}
