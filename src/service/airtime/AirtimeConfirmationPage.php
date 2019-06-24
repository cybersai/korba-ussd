<?php


namespace Korba;


class AirtimeConfirmationPage extends View
{
    public function __construct($number, $network, $amount, $next)
    {
        $content = "Confirm\nAirtime Topup\nNumber:{$number}\nNetwork:{$network}\nAmount:{$amount}";
        parent::__construct($content, $next,1,null, null, null, "1.Ok\n#.Back\nMain Menu");
    }
}
