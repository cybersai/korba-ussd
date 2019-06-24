<?php


namespace Korba;


class UtilConfirmationPage extends View
{
    public function __construct($next, $number, $service, $name, $amount)
    {
        $content = "Confirm\nService:{$service}\nAcc No:{$number}\nName:{$name}\nAmount:{$amount}";
        parent::__construct($content, $next,1,null, null, null, "1.Ok\n#.Back\nMain Menu");
    }
}
