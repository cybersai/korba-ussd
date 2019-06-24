<?php


namespace Korba;


class DataConfirmationPage extends View
{
    public function __construct($next, $number, $provider, $amount, $description)
    {
        $content = "Confirm\nProvider:{$provider}\nNumber:{$number}\nDescription:{$description}\nAmount:{$amount}";
        parent::__construct($content, $next,1,null, null, null, "1.Ok\n#.Back\nMain Menu");
    }
}
