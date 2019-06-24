<?php


namespace Korba;


class UtilConfirm extends View
{
    public function __construct($next,$number,  $name)
    {
        $content = "Account Confirmation\nAcc No: {$number}\nName:{$name}";
        parent::__construct($content, $next, 1, null, null,null,"1.Ok\n#.Back");
    }
}
