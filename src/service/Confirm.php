<?php


namespace Korba;


class Confirm extends View
{
    public function __construct($next, $number,  $slug = "account")
    {
        $content = "Confirm {$slug} Number\n".$number;
        parent::__construct($content, $next, 1, null, null,null,"1.Ok\n#.Back");
    }
}
