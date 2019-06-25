<?php


namespace Korba;


class TvConfirmationPage extends View
{
    public function __construct($next, $number, $service, $name, $amount)
    {
        $fee = $amount * .01;
        $content = "Confirm\nService:{$service}\nAcc No:{$number}\nName:{$name}\nAmount:{$amount}\nNetwork Fee: {$fee}\nTotal Debit: {$fee}";
        parent::__construct($content, $next,1,null, null, null, "1.Ok\n#.Back\nMain Menu");
    }
}
